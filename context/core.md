# ns_whatsapp — Core facts

## Identity

| Item | Value |
|---|---|
| Extension key | `ns_whatsapp` |
| Composer name | `nitsan/ns-whatsapp` |
| Title (ext_emconf) / product name | TYPO3 WhatsApp Chat Integration / WhatsApp |
| Namespace | `Nitsan\NsWhatsapp\` → `Classes/` |
| Version (ext_emconf) | 14.2.0 (latest tag 14.1.0) |
| Repository | https://github.com/nitsan-technologies/ns_whatsapp (default branch `main`) |
| Licensing status | **Freemium** — this repo is the free version (Style 1 only); a paid premium version exists in the T3Planet catalog (the NITSAN Free/Freemium sheet needs a Google login) |
| Premium version (T3Planet catalog) | "WhatsApp", €79, https://t3planet.de/en/typo3-whatsapp-extension |

## Compatibility

| Source | TYPO3 | PHP |
|---|---|---|
| `ext_emconf.php` | `12.4.37-14.9.99` | not declared |
| `composer.json` | `12.4.37 \|\| ^13 \|\| ^14` (exactly 12.4.37 for v12, see known issues) | not declared |
| ns_license 14.5.4 (dependency) | `12.4.18-14.9.99` | not declared (TYPO3 12.4 needs 8.1+) |

- ns_license does not raise the minimum: TYPO3 12.4.37, PHP 8.1.

## Dependencies

| Package | Constraint | Why |
|---|---|---|
| `typo3/cms-core` | see above | core |
| `nitsan/ns-license` / `ns_license` | `^14.5.4` / `14.5.4-14.9.99` | TYPO3 Shop module + free-trial deep link (see `features/premium-cta.md`) |

Bundled libraries (no package manager): Bootstrap 4.3.1 CSS and Font Awesome (backend module).
The backend layout loads jQuery 2.1.3 from `ajax.googleapis.com` (allowed in `ContentSecurityPolicies.php`).

## Tooling

- No PHPUnit, PHPStan, CS fixer or package.json in the repo. `composer.json` has a `.Build/` vendor/web-dir
  config for standalone installs.
- CI: `.github/workflows/ter-release.yml` only (publishes tags to TER with tailor; PHP 7.4, deprecated
  `set-output`).
- `.gitattributes` export-ignores `.github/`, `AGENTS.md`, `CLAUDE.md`, `context/`, `tasks/` and itself, so they
  are not in the GitHub/Composer archive or the TER package (the TER release uploads the GitHub tag archive).
- Translations: only English sources (`locallang.xlf` frontend + module + premium strip, `BackendModule.xlf`,
  `WhatsappStyle.xlf`, `WhatsappConfiguration.xlf`, `locallang_whastappmodule.xlf`); no Crowdin config.

## Conventions

- PHP: 4 spaces, no `declare(strict_types=1)` in the controller.
- TypoScript: 4 spaces; Fluid and XLF mix tabs and spaces.
- Public assets in `Resources/Public/{Css,JavaScript,Vendor,Icons,fonts}/`; backend strip CSS
  `Resources/Public/Css/backend-premium-strip.css`.

## Known issues (existing, not fixed)

All code-read unless marked.

- `composer.json` requires `typo3/cms-core` `12.4.37` without `^`, so Composer installs on v12 only accept
  exactly 12.4.37.
- **Cached output depends on the visitor:** `initializeObject()` sets `settings.mobile` from the user agent,
  but `list` is a cached action rendered through the cached `page.111246` USER object, so the first visitor
  decides the WhatsApp URL variant (`send/` vs. `send`) for everyone until the page cache is cleared.
- `findAllstyle()` builds a query with settings and then executes a new `createQuery()` (settings unused;
  storage page is ignored anyway by the repository defaults).
- `page.111246` still sets `switchableControllerActions` and `vendorName` (ignored since TYPO3 12); the plugin
  is configured as a content element but never registered in TCA (rendered globally instead).
- `module.tx_nswhatsapp_nitsan_nswhatsappwhatsappmodule` TypoScript points to `Resources/Private/Backend/*`
  folders that don't exist; the module uses the default `Resources/Private/{Templates,Layouts}` paths.
- The style TCA labels point to the missing `locallang_db.xlf`; the column `hboredrcolor` is misspelled
  (kept for data compatibility).
- Unused: `ThemeContainsViewHelper` (uses `renderStatic`), `WhatsappRepository`, the `Whatsapp` model,
  `Css/myfile.css`, `JavaScript/fieldToggle.js` and `JavaScript/jquery.js`.
- Backend layout includes `EXT:backend/Resources/Public/Css/backend.css` and Bootstrap 4 next to the TYPO3
  backend's own Bootstrap 5.
- `updateAction()` flash message is hard-coded English.
- README badge shows 14.0.1 and GPL-3.0; `composer.json` uses the deprecated SPDX id `GPL-2.0+` and an old
  `demo.t3planet.com` link.
