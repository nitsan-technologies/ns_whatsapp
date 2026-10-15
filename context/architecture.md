# ns_whatsapp — Architecture

One Extbase plugin (`NsWhatsapp`/`Whatsapp`) rendered on every page through TypoScript, one style table, one
backend module ("Whatsapp Style"). No content element, no FlexForm.

## Configuration

| File | What |
|---|---|
| `ext_localconf.php` | `configurePlugin('NsWhatsapp', 'Whatsapp', list/update/create)` as content-element type (not registered in TCA) |
| `Configuration/Backend/Modules.php` | Parent `nitsan_module` (shared NITSAN group) + `nitsan_nswhatsapp_constants` ("Whatsapp Style", path `/module/nitsan/NsWhatsappConstant/`, access `user`, page tree; actions `styleSettings`, `update`) |
| `Configuration/TCA/tx_nswhatsapp_domain_model_whatsappstyle.php` | Style record (`text`, `textcolor`, `bgcolor`, `border`, `bordercolor`, `htextcolor`, `hbgcolor`, `hboredrcolor`, `style`, …), `hideTable` |
| `ext_tables.sql`, `ext_tables_static+adt.sql` | Style table + default Style 1 record on pid 0 |
| `Configuration/TCA/Overrides/sys_template.php` | Static template "Whatsapp" (`Configuration/TypoScript`) |
| `Configuration/TypoScript/` | Constants `plugin.tx_nswhasapp_whatsapp.{view,settings}.*` (Constant Editor category `ns_whatsapp_chat`); setup: plugin settings, `page.includeCSS` `nswhatsapp.css`, `page.111246` USER object rendering `Whatsapp->list` |
| `Configuration/Sets/NsWhatsapp/` | Site set `nitsan/ns-whatsapp`; 19 settings below `ns_whatsapp.{view,chat,style}`; setup imports the classic setup, overrides it and re-copies `page.111246.settings` |
| `Configuration/ContentSecurityPolicies.php` | Backend CSP: `ajax.googleapis.com` (jQuery), `www.googleapis.com`, `demo.t3planet.com` images |
| `Configuration/JavaScriptModules.php` | `@nitsan/ns-whatsapp/` → `Resources/Public/JavaScript/` |
| `Configuration/Icons.php` | `ns_whatsapp-plugin-whatsapp`, `module-nswhatsapp` |

## Classes

| Class | Role |
|---|---|
| `Controller\WhatsappController` | `listAction` (frontend button), `styleSettingsAction` / `updateAction` (module), `processRequest` normalises the trusted-properties token, `getTrialUrl()` (premium strip) |
| `Domain\Model\Whatsappstyle`, `Domain\Repository\WhatsappstyleRepository` | Style record; `findAllstyle()`, `updateSysFileReferenceRecord()` |
| `Domain\Model\Whatsapp`, `Domain\Repository\WhatsappRepository`, `ViewHelpers\ThemeContainsViewHelper` | Not referenced anywhere (see `core.md`) |

## Views

- Frontend: `Templates/Whatsapp/List.html` → `Layouts/Default.html` → `Partials/Chat/Style1.html`,
  `Partials/NoRecordFound.html`.
- Module: `Templates/Whatsapp/StyleSettings.html` → `Layouts/Backend/Default.html` (premium strip, module
  navigation, CSS/JS includes).

## Assets

- Frontend: `Css/nswhatsapp.css` (page include), inline button colours via `f:asset.css`.
- Module: `Vendor/bootstrap4.3.1.min.css`, `Css/{font-awesome,global,main,nswhatsapp,backend-premium-strip}.css`,
  `JavaScript/custom.js`, jQuery 2.1.3 from Google.
