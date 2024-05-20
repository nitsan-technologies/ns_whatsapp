<?php

namespace Nitsan\NsWhatsapp\Controller;

use Nitsan\NsWhatsapp\Domain\Model\Whatsappstyle;
use Nitsan\NsWhatsapp\Domain\Repository\WhatsappRepository;
use Nitsan\NsWhatsapp\Domain\Repository\WhatsappstyleRepository;
use Nitsan\NsWhatsapp\NsConstantModule\TypoScriptTemplateConstantEditorModuleFunctionController;
use TYPO3\CMS\Core\TypoScript\ExtendedTemplateService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Annotation\Inject as inject;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
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
class WhatsappController extends ActionController
{
    /**
     * WhatsappRepository
     *
     * @var WhatsappRepository
     * @extensionScannerIgnoreLine
     * @inject
     */
    protected $WhatsappRepository = null;

    /**
     * @param WhatsappstyleRepository $whatsappstyleRepository
     */
    public function injectWhatsappstyleRepository(WhatsappstyleRepository $whatsappstyleRepository)
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
        // @extensionScannerIgnoreLine
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

        $whatsappStyle = $this->whatsappstyleRepository->findAllstyle();

        $this->view->assignMultiple(
            [
                'whatsappstyle' => $whatsappStyle,
                'currentpid' => $currentPid,
                'chat_hidepage' => $chat_hidepage,
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
        $bootstrapVariable = 'data';
        if (version_compare(TYPO3_branch, '11.0', '>')) {
            $bootstrapVariable = 'data-bs';
        }
        $this->view->assign('bootstrapVariable', $bootstrapVariable);
        $this->view->assign('action', 'chatSettings');
        $this->view->assign('constant', $this->constants);
    }

    /**
     * action update
     *
     * @param Whatsappstyle $whatsappstyle
     * @return void
     */
    public function updateAction(Whatsappstyle $whatsappstyle)
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
        $id = (int) GeneralUtility::_GP('id');
        if ($id != 0) {
            $whatsappStyle = $this->whatsappstyleRepository->findAll();
            $this->view->assign('whatsappstyle', $whatsappStyle);
        }
        $bootstrapVariable = 'data';
        if (version_compare(TYPO3_branch, '11.0', '>')) {
            $bootstrapVariable = 'data-bs';
        }
        $this->view->assign('bootstrapVariable', $bootstrapVariable);
    }

    /**
     * action saveConstant
     */
    public function saveConstantAction()
    {
        $this->constantObj->main();
        return false;
    }
}
