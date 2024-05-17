<?php
namespace Nitsan\NsWhatsapp\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Nitsan\NsWhatsapp\Domain\Model\Whatsappstyle;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Nitsan\NsWhatsapp\Domain\Repository\WhatsappstyleRepository;
use TYPO3\CMS\Tstemplate\Controller\TypoScriptTemplateModuleController;
use Nitsan\NsWhatsapp\NsConstantModule\TypoScriptTemplateConstantEditorModuleFunctionController;

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

    public function __construct(
        protected WhatsappstyleRepository $whatsappstyleRepository
    ) {}

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
        // @extensionScannerIgnoreLine
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
        $configurationManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface');
        $extensions = $configurationManager->getConfiguration(
            \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT
        );
        $constant = $extensions['plugin.']['tx_nswhasapp_whatsapp.']['settings.'];
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
     * @param Whatsappstyle $whatsappstyle
     * @return ResponseInterface
     */
    public function updateAction(Whatsappstyle $whatsappstyle): ResponseInterface
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
}
