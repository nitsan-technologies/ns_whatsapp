<?php
namespace Nitsan\NsWhatsapp\Controller;

use Nitsan\NsWhatsapp\NsConstantModule\TypoScriptTemplateConstantEditorModuleFunctionController;
use Nitsan\NsWhatsapp\Property\TypeConverter\UploadedFileReferenceConverter;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;
use TYPO3\CMS\Tstemplate\Controller\TypoScriptTemplateModuleController;
use Psr\Http\Message\ResponseInterface;

/***
 *
 * This file is part of the "[NITSAN] NS Bas" Extension for TYPO3 CMS.
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
class WhatsappController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * whatsappstyleRepository
     *
     * @var \Nitsan\NsWhatsapp\Domain\Repository\WhatsappRepository
     */
    protected $whatsappstyleRepository = null;

    public function __construct(
        \Nitsan\NsWhatsapp\Domain\Repository\WhatsappstyleRepository $whatsappstyleRepository
    ) {
        $this->whatsappstyleRepository = $whatsappstyleRepository;
    }

    protected $constantObj;

    protected $constants;

    /**
     * @var TypoScriptTemplateModuleController
     */
    protected $pObj;

    protected $contentObject = null;

    protected $pid = null;

    /**
     * Initializes this object
     *
     * @return void
     */
    public function initializeObject()
    {
        $this->contentObject = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');
        $this->constantObj = GeneralUtility::makeInstance(TypoScriptTemplateConstantEditorModuleFunctionController::class);
    }

    /**
     * Initialize Action
     *
     * @return void
     */
    public function initializeAction()
    {

        //GET CONSTANTs
        $this->constantObj->init($this->pObj);
        $this->constants = $this->constantObj->main();
    }

    /**
     * action list
     *
     * @return ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
        $currentPid = $GLOBALS['TSFE']->id;
        $constant = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_nswhasapp_whatsapp.']['settings.'];
        $cpages = $constant['hide_pages'];
        $cpage = rtrim($cpages, ', ');
        $chat_hidepage = explode(',', $cpage);

        $whatsappstyle = $this->whatsappstyleRepository->findAllstyle();
        $this->view->assignMultiple(
            [
                'whatsappstyle' => $whatsappstyle,
                'currentpid' => $currentPid,
                'chat_hidepage' => $chat_hidepage,
            ]
        );
        return $this->htmlResponse();
    }

    /**
     * action chatSettingsAction
     *
     * @return ResponseInterface
     */
    public function chatSettingsAction(): ResponseInterface
    {
        $this->view->assign('action', 'chatSettings');
        $this->view->assign('constant', $this->constants);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \Nitsan\NsWhatsapp\Domain\Model\Whatsappstyle $whatsappstyle
     * @return ResponseInterface
     */
    public function updateAction(\Nitsan\NsWhatsapp\Domain\Model\Whatsappstyle $whatsappstyle): ResponseInterface
    {
        $this->whatsappstyleRepository->update($whatsappstyle);
        return $this->redirect('styleSettings');
    }

    /**
     * action styleSettings
     *
     * @return ResponseInterface
     */
    public function styleSettingsAction(): ResponseInterface
    {
        $id= (int) $this->request->getArguments('id');
        if ($id != 0) {
            $whatsappstyle = $this->whatsappstyleRepository->findAll();
            $this->view->assign('whatsappstyle', $whatsappstyle);
        }
        return $this->htmlResponse();
    }

    /**
     * action saveConstant
     * @return ResponseInterface
     */
    public function saveConstantAction(): ResponseInterface
    {
        $this->constantObj->main();
        return $this->redirect('chatSettings');
    }

    public function addConstantsConfiguration($constantForDb, $pid)
    {
        $getConstants = $this->WhatsappRepository->fetchConstants($pid)['constants'];
        $buildAdditionalConstant = $constantForDb;
        return $getConstants . $buildAdditionalConstant;
    }

    protected function setTypeConverterConfigurationForImageUpload($argumentName)
    {
        \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\Container\Container::class)
            ->registerImplementation(
                \TYPO3\CMS\Extbase\Domain\Model\FileReference::class,
                \Nitsan\NsWhatsapp\Domain\Model\FileReference::class
            );

        $uploadConfiguration = [
            UploadedFileReferenceConverter::CONFIGURATION_ALLOWED_FILE_EXTENSIONS => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
            UploadedFileReferenceConverter::CONFIGURATION_UPLOAD_FOLDER => '1:/user_upload/',
        ];

        /** @var PropertyMappingConfiguration $newProductInquiryConfiguration */
        $newProductInquiryConfiguration = $this->arguments[$argumentName]->getPropertyMappingConfiguration();
        $newProductInquiryConfiguration->forProperty('image')
            ->setTypeConverterOptions(
                UploadedFileReferenceConverter::class,
                $uploadConfiguration
            );
    }
}
