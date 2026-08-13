<?php

namespace Nitsan\NsWhatsapp\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Crypto\HashAlgo;
use Nitsan\NsWhatsapp\Domain\Model\Whatsappstyle;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Extbase\Security\HashScope;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use Nitsan\NsWhatsapp\Domain\Repository\WhatsappstyleRepository;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
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
    ) {}

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
     * Normalize trusted properties token: ensure string keys and remove stray top-level numeric keys.
     * Fixes: hasArgument() must be of type string, int given (e.g. top-level key "0" from form).
     */
    public function processRequest(RequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        $extbaseParams = $request->getAttribute('extbase');
        if ($extbaseParams !== null) {
            $token = $extbaseParams->getInternalArgument('__trustedProperties');
            if (is_string($token) && $token !== '') {
                try {
                    $encoded = $this->hashService->validateAndStripHmac(
                        $token,
                        HashScope::TrustedProperties->prefix(),
                        HashAlgo::SHA3_256
                    );
                    $decoded = json_decode($encoded, true);
                    if (is_array($decoded)) {
                        $normalized = $this->normalizeTrustedPropertiesKeys($decoded);
                        // Remove top-level numeric keys (e.g. "0") so core only sees "whatsappstyle"
                        foreach (array_keys($normalized) as $key) {
                            if (is_numeric($key) && (string)(int)$key === (string)$key) {
                                unset($normalized[$key]);
                            }
                        }
                        $reEncoded = json_encode($normalized);
                        $newToken = $this->hashService->appendHmac(
                            $reEncoded,
                            HashScope::TrustedProperties->prefix(),
                            HashAlgo::SHA3_256
                        );
                        $extbaseParams->setArgument('__trustedProperties', $newToken);
                    }
                } catch (\Throwable $e) {
                    // Leave token unchanged if validation fails
                }
            }
        }
        return parent::processRequest($request);
    }

    /**
     * Recursively convert integer array keys to string (JSON decodes "0" to 0).
     */
    private function normalizeTrustedPropertiesKeys(array $data): array
    {
        $result = [];
        foreach ($data as $key => $value) {
            $stringKey = is_int($key) ? (string)$key : $key;
            $result[$stringKey] = is_array($value)
                ? $this->normalizeTrustedPropertiesKeys($value)
                : $value;
        }
        return $result;
    }

    /**
     * action list
     *
     * @return ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
        // Determine current page id (pid) in a version-safe way
        $typo3Version = GeneralUtility::makeInstance(Typo3Version::class);
        if ($typo3Version->getMajorVersion() === 12) {
            // @extensionScannerIgnoreLine
            $pageRecord = $GLOBALS['TSFE']->page ?? [];
        } else {
            $pageRecord = $GLOBALS['TYPO3_REQUEST']->getAttribute('frontend.page.information')->getPageRecord() ?? [];
        }
        $currentPid = (int)($pageRecord['uid'] ?? 0);

        $configurationManager = GeneralUtility::makeInstance(ConfigurationManagerInterface::class);
        $typoScriptSetup = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        $constant = $typoScriptSetup['plugin.']['tx_nswhasapp_whatsapp.']['settings.'] ?? [];

        $chatHidepage = GeneralUtility::trimExplode(
            ',',
            rtrim($constant['hide_pages'] ?? '', ', '),
            true
        );

        // Keep mobile detection available inside Fluid settings
        $constant['mobile'] = (bool)($this->settings['mobile'] ?? false);

        // Site Settings color enums use "default" sentinel = keep Whatsapp Style module values
        foreach ([
            'style1_textcolor',
            'style1_bgcolor',
            'style1_bordercolor',
            'style1_htextcolor',
            'style1_hbgcolor',
            'style1_hbordercolor',
        ] as $styleKey) {
            if (($constant[$styleKey] ?? '') === 'default') {
                $constant[$styleKey] = '';
            }
        }

        $whatsappstyle = $this->whatsappstyleRepository->findAllstyle();
        $urlConnection = GeneralUtility::getIndpEnv('TYPO3_SSL') ? 'https://' : 'http://';
        $this->view->assignMultiple(
            [
                'whatsappstyle' => $whatsappstyle,
                'currentpid' => $currentPid,
                'chat_hidepage' => $chatHidepage,
                'settings' => $constant,
                'urlConnection' => $urlConnection,
            ]
        );
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @return ResponseInterface
     */
    public function updateAction(Whatsappstyle $whatsappstyle): ResponseInterface
    {
        $this->whatsappstyleRepository->update($whatsappstyle);

        $this->addFlashMessage(
            'Great choice! Your new WhatsApp style is now active.',
            'Style Changed',
            ContextualFeedbackSeverity::OK,
            true
        );

        return $this->redirect('styleSettings');
    }
    /**
     * action styleSettings
     *
     * @return ResponseInterface
     */
    public function styleSettingsAction(): ResponseInterface
    {
        $whatsappstyle = $this->whatsappstyleRepository->findAll();
        $this->view->assignMultiple([
            'whatsappstyle' => $whatsappstyle,
            'middleAttribute' => 'data-bs-',
            'style1' => 'show'
        ]);
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
