# Run quality checks

The repo has no PHPUnit, PHPStan or CS config. Available checks:

```bash
# PHP syntax; also run once with PHP 8.1, the lowest version TYPO3 12 supports
for f in $(find . -name "*.php" -not -path "./.git/*" -not -path "./.Build/*"); do php -l "$f"; done

# composer.json
composer validate --no-check-publish

# XLF well-formedness
for f in Resources/Private/Language/*.xlf; do xmllint --noout "$f"; done
```

## Manual test (per TYPO3 major 12 / 13 / 14)

1. "Whatsapp Style" module: strip at the top, above the module navigation; still there after saving the style
   form.
2. "Start Free Trial" (as system maintainer) opens the ns_license module and its trial modal with
   "WhatsApp (ns_whatsapp)" preselected. Cancel; don't start a trial.
3. Deactivate ns_license (test system only): no strip, the module still works.
4. Frontend with a number set: button visible in the chosen position, link opens WhatsApp with the pre-filled
   message; hidden on `hide_pages`, on mobile/desktop when the hide options are on. Test with the classic
   template and with the site set (colour overrides).
5. Check light and dark backend themes.
