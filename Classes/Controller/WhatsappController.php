<?php
namespace Nitsan\NsWhatsapp\Controller;

use Nitsan\NsWhatsapp\NsConstantModule\TypoScriptTemplateConstantEditorModuleFunctionController;
use Nitsan\NsWhatsapp\Property\TypeConverter\UploadedFileReferenceConverter;
use TYPO3\CMS\Core\TypoScript\ExtendedTemplateService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Annotation\Inject as inject;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;
use TYPO3\CMS\Tstemplate\Controller\TypoScriptTemplateModuleController;

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
     * WhatsappRepository
     *
     * @var \Nitsan\NsWhatsapp\Domain\Repository\WhatsappRepository
     * @inject
     */
    protected $WhatsappRepository = null;

    /**
     * @param \Nitsan\NsWhatsapp\Domain\Repository\WhatsappstyleRepository $whatsappstyleRepository
     */
    public function injectWhatsappstyleRepository(\Nitsan\NsWhatsapp\Domain\Repository\WhatsappstyleRepository $whatsappstyleRepository)
    {
        $this->whatsappstyleRepository = $whatsappstyleRepository;
    }

    protected $templateService;

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
        $this->templateService = GeneralUtility::makeInstance(ExtendedTemplateService::class);
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
     * @return void
     */
    public function listAction()
    {
        $currentPid = $GLOBALS['TSFE']->id;
        $constant = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_nswhasapp_whatsapp.']['settings.'];
        $cpages = $constant['hide_pages'];
        $cpage = rtrim($cpages, ', ');
        $chat_hidepage = explode(',', $cpage);
        $spages = $constant['share_hide_pages'];
        $spage = rtrim($spages, ', ');
        $share_hidepage = explode(',', $spage);
        $gpages = $constant['group_hide_pages'];
        $gpage = rtrim($gpages, ', ');
        $group_hidepage = explode(',', $gpage);

        $whatsappstyle = $this->whatsappstyleRepository->findAllstyle();
        $this->view->assignMultiple(
            [
                'whatsappstyle' => $whatsappstyle,
                'currentpid' => $currentPid,
                'chat_hidepage' => $chat_hidepage,
                'share_hidepage' => $share_hidepage,
                'group_hidepage' => $group_hidepage,
            ]
        );
    }

    /**
     * action chatSettingsAction
     *
     * @return void
     */
    public function chatSettingsAction()
    {
        $this->view->assign('action', 'chatSettings');
        $this->view->assign('constant', $this->constants);
    }

    /**
     * Set TypeConverter option for image upload
     */
    public function initializeUpdateAction()
    {
        if (isset($this->arguments['whatsappstyle'])) {
            if (!empty($this->request->getArguments()['whatsappstyle']['image'][0]['name'])) {
                $this->setTypeConverterConfigurationForImageUpload('whatsappstyle', 'image');
            } else {
                $data = $this->request->getArguments()['whatsappstyle'];
                unset($data['image']);
                $this->request->setArgument('whatsappstyle', $data);
            }
        }
        $this->setTypeConverterConfigurationForImageUpload('whatsappstyle');
    }
    /**
     * action update
     *
     * @param \Nitsan\NsWhatsapp\Domain\Model\Whatsappstyle $whatsappstyle
     * @return void
     */
    public function updateAction(\Nitsan\NsWhatsapp\Domain\Model\Whatsappstyle $whatsappstyle)
    {
        $this->whatsappstyleRepository->update($whatsappstyle);
        $this->redirect('styleSettings');
    }

    /**
     * action styleSettings
     *
     * @return void
     */
    public function styleSettingsAction()
    {
        $id = (int) \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id');
        if ($id != 0) {
            $whatsappstyle = $this->whatsappstyleRepository->findAll();
            $this->view->assign('whatsappstyle', $whatsappstyle);
        }
    }

    /**
     * action saveConstant
     */
    public function saveConstantAction()
    {
        $this->constantObj->main();
        return false;
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
