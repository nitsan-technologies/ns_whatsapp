<?php

namespace Nitsan\NsWhatsapp\Controller;

use TYPO3\CMS\Core\Resource\Exception;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Information\Typo3Version;
use Nitsan\NsWhatsapp\Domain\Model\Whatsappstyle;
use TYPO3\CMS\Core\Utility\File\ExtendedFileUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use Nitsan\NsWhatsapp\Domain\Repository\WhatsappstyleRepository;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;

/***
 *
 * This file is part of the "Whatsapp" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020
 *
 ***/

/**
 * WhatsappController
 */
class WhatsappController extends ActionController
{
    public function __construct(
        protected WhatsappstyleRepository $whatsappstyleRepository
    ) {
    }

    protected $constants;

    protected $contentObject = null;

    /**
     * Initializes this object
     *
     * @return void
     */
    public function initializeObject(): void
    {
        $this->contentObject = GeneralUtility::makeInstance(ContentObjectRenderer::class);
        $ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
        $this->settings['mobile'] = is_numeric(strpos($ua, "mobile"));
    }

    /**
     * Initialize Action
     *
     * @return void
     */
    public function initializeAction(): void
    {
        $configurationManager = GeneralUtility::makeInstance(ConfigurationManagerInterface::class);
        $typoScriptSetup = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        $this->constants = $typoScriptSetup['plugin.']['tx_nswhasapp_whatsapp.']['settings.']??[];
    }

    /**
     * action list
     *
     * @return ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
        //@extensionScannerIgnoreLine
        $currentPid = $GLOBALS['TSFE']->id;

         // set js value for slider
        $configurationManager = GeneralUtility::makeInstance(ConfigurationManagerInterface::class);
        $typoScriptSetup = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        $constant = $typoScriptSetup['plugin.']['tx_nswhasapp_whatsapp.']['settings.'];


        $chat_showpage = GeneralUtility::trimExplode(
            ',',
            rtrim($constant['show_pages'], ', ')
        );
        $share_showpage = GeneralUtility::trimExplode(
            ',',
            rtrim($constant['share_show_pages'], ', ')
        );
        $group_showpage = GeneralUtility::trimExplode(
            ',',
            rtrim($constant['group_show_pages'], ', ')
        );
        if(($constant['show_all']) || ($chat_showpage && (in_array($currentPid, $chat_showpage)))) {
            $chatFlag = 1;
        }

        if($constant['share_show_all'] || ($share_showpage && in_array($currentPid, $share_showpage))) {
            $shareFlag = 1;
        }

        if($constant['group_show_all'] || ($group_showpage && in_array($currentPid, $group_showpage))) {
            $groupFlag = 1;
        }

        $whatsappstyle = $this->whatsappstyleRepository->findAllstyle();
        $urlConnection = GeneralUtility::getIndpEnv('TYPO3_SSL') ? 'https://' : 'http://';
        $this->view->assignMultiple(
            [
                'urlConnection' => $urlConnection,
                'whatsappstyle' => $whatsappstyle,
                'currentpid' => $currentPid ?? '',
                'chatFlag' => $chatFlag ?? '',
                'shareFlag' => $shareFlag ?? '',
                'groupFlag' => $groupFlag ?? '',
            ]
        );
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param Whatsappstyle $whatsappstyle
     * @return ResponseInterface
     * @throws Exception
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     */
    public function updateAction(Whatsappstyle $whatsappstyle): ResponseInterface
    {
        $namespace = key($_FILES);
        $targetFalDirectory = '1:/user_upload/';
        // Register every upload field from the form:
        $fileData = [];
        if(!empty($_FILES['image']['name'])) {
            $this->registerUploadField($fileData, $namespace, $targetFalDirectory);
        }

        $this->processImageRemove($whatsappstyle);

        // Initializing:
        /** @var ExtendedFileUtility $fileProcessor */
        $fileProcessor = GeneralUtility::makeInstance(ExtendedFileUtility::class);
        $fileProcessor->setActionPermissions(['addFile' => true]);
        if ((GeneralUtility::makeInstance(Typo3Version::class))->getMajorVersion() == 12) {
            $rename = \TYPO3\CMS\Core\Resource\DuplicationBehavior::RENAME;
        } else {
            $rename = \TYPO3\CMS\Core\Resource\Enum\DuplicationBehavior::RENAME;
        }

        $fileProcessor->setExistingFilesConflictMode( $rename);
        $fileProcessor->start($fileData);
        $fileAddedresult = $fileProcessor->processData();

        $this->whatsappstyleRepository->update($whatsappstyle);

        $fileAddedresult['upload'][0] = $fileAddedresult['upload'][0] ?? '';
        if($fileAddedresult['upload'][0]) {
            foreach ($fileAddedresult['upload'][0] as $file) {
                $this->whatsappstyleRepository->updateSysFileReferenceRecord(
                    $file->getProperties()['uid'],
                    $whatsappstyle->getUid(),
                    $whatsappstyle->getPid(),
                    'tx_nswhatsapp_domain_model_whatsappstyle',
                    'image',
                    0
                );
            }
        }

        $this->addFlashMessage(
            'Great choice! Your new WhatsApp style is now active.',
            'Style Changed',
            ContextualFeedbackSeverity::OK,
            true
        );

        return $this->redirect('styleSettings');
    }

    /**
     * @param Whatsappstyle $whatsappstyle
     * @return void
     */
    private function processImageRemove(Whatsappstyle $whatsappstyle): void
    {
        $images = $whatsappstyle->getImage();
        if (count($images) > 0 && $whatsappstyle->getDeleteImg() == 1) {
            foreach ($images as $img) {
                $whatsappstyle->removeImage($img);
            }
        }
    }
    /**
     * action styleSettings
     *
     * @return ResponseInterface
     */
    public function styleSettingsAction(): ResponseInterface
    {
        $id = (int) $this->request->getArguments();
        if ($id != 0) {
            $whatsappstyle = $this->whatsappstyleRepository->findAll();
            $this->view->assignMultiple([
                'whatsappstyle' => $whatsappstyle,
                'middleAttribute' => 'data-bs-',
                'style1' => 'show'
            ]);
        }
        return $this->htmlResponse();
    }


    /**
     * Registers an uploaded file for TYPO3 native upload handling.
     *
     * @param array &$data
     * @param string $namespace
     * @param string $targetDirectory
     * @return void
     */
    protected function registerUploadField(array &$data, string $namespace, string $targetDirectory = '1:/_temp_/')
    {
        if (!isset($data['upload'])) {
            $data['upload'] = array();
        }
        $counter = count($data['upload']) + 1;
        $_FILES[$namespace] = $_FILES[$namespace] ?? '';

        if($_FILES[$namespace]) {
            $keys = array_keys($_FILES[$namespace]);
            foreach ($keys as $key) {
                $_FILES['upload_' . $counter][$key] = $_FILES[$namespace][$key];
            }
            $data['upload'][$counter] = array(
                'data' => $counter,
                'target' => $targetDirectory,
            );
        }
    }

}
