# Feature — Premium strip and ns_license free trial

*Status: Done. Verified live on TYPO3 14.3.7 (2026-10-15): strip at the top of the "Whatsapp Style" module; the
button opens the ns_license module with "WhatsApp (ns_whatsapp)" preselected in the trial modal. Requires
ns_license 14.5.4 (deep-link support) to be released. v12/v13 not tested.*

## Licensing status

Freemium. Premium product (T3Planet catalog): "WhatsApp", €79, https://t3planet.de/en/typo3-whatsapp-extension
(not linked from the UI; the trial stays inside the TYPO3 backend). Catalog features: floating chat widget,
agent profile details, prefilled chat messages, direct WhatsApp chats, group chat links, share message support,
responsive widget positioning.

## Dependency

`composer.json` `"nitsan/ns-license": "^14.5.4"`, `ext_emconf.php` `'ns_license' => '14.5.4-14.9.99'`. Does not
raise the minimum TYPO3 version (see `core.md`).

## Placement

The extension has no content element or FlexForm, so the strip sits only in its backend module:

| Place | Position |
|---|---|
| "Whatsapp Style" module (`nitsan_nswhatsapp_constants`) | Top of the module body, above the module navigation and flash messages |

## How it works

- `WhatsappController::getTrialUrl()` builds route `nitsan_nslicensemodule` + `trial=ns_whatsapp` +
  `#free-section`; returns `''` (`RouteNotFoundException`) without ns_license. `styleSettingsAction()` assigns it
  as `trialUrl`; `updateAction()` redirects there, so the strip is always shown in the module.
- `Layouts/Backend/Default.html` renders the strip inside `<f:if condition="{trialUrl}">`: `actions-rocket` icon
  (`core:icon`), headline and description on two lines, `btn btn-primary` "Start Free Trial →" (the arrow is
  `aria-hidden` markup), same frame. It also links `Css/backend-premium-strip.css`.

## Strip

- Labels in `locallang.xlf`: `premium.strip.headline` "You're using the free version of NS WhatsApp",
  `premium.strip.description` "Unlock premium features and get more out of NS WhatsApp.",
  `premium.strip.trial` "Start Free Trial".
- `Resources/Public/Css/backend-premium-strip.css`: `.ns-whatsapp-premium-strip` — team-wide design (light-blue
  card `#e7f2fc`, border `#8eb6e8`, 4px `#2b6cb0` left accent, 6px radius, padding 14px 18px, `light-dark()` for
  dark mode, button `#007bff` / hover `#0062cc`). The module also loads Bootstrap 4; the `gap-3` utility still
  applies through the TYPO3 backend CSS (checked live: 16px).
- Measured on v14.3.7: 883×67px in a 931px module body.
- ns_license's module requires system maintainer access; other users get access denied after clicking.
