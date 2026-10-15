# ns_whatsapp — Operating Principles

*Every change to code, context or docs must serve the goals below.*

---

## Goal 1 — Nothing that works may break

The extension declares TYPO3 v12.4.37–v14 (Composer and Classic mode), see `core.md`.

- Keep every declared major working. Follow the existing version switches (`Typo3Version::getMajorVersion()`
  in `WhatsappController::listAction()` and `Configuration/Backend/Modules.php`) instead of inventing new ones.
- Lowest PHP is 8.1 (TYPO3 12): no PHP 8.2+ syntax such as `readonly` classes or DNF types.
- Both configuration paths must keep working: the classic static template (`plugin.tx_nswhasapp_whatsapp.*`
  constants, note the `whasapp` spelling) and the site set `nitsan/ns-whatsapp` (`ns_whatsapp.*` settings). A
  change to one usually needs the same change in the other.
- The button colours come from two places: the "Whatsapp Style" module record and the site set colour settings
  (`default` = keep the module value). Keep that fallback order.
- The free version only has Style 1; premium styles were removed on purpose (commit 7b6be0b). Don't bring them
  back here.
- Prefer the smallest change that fixes the root cause. No drive-by refactors.
- Run `tasks/run-quality.md` and re-test the affected flow before claiming done.

## Goal 2 — Token-cost efficiency (agent context)

- **DRY context:** each fact lives in exactly ONE file. Reference, don't copy.
- **Load on demand:** read `context/features/<area>.md` for the task, not everything.
- **Prune as you go:** keep `context/session-state.md` short.

## Goal 3 — Accuracy and trust

- Answer from context + code, never from invented API, table or field names.
- Mark statements as verified live or code-read; conflicting facts across files = fix the source file.

---

## Guardrails (non-negotiable)

- Installing the premium version through ns_license replaces this extension's folder: never keep user data in
  files below the extension.
- Do not change ns_license from an ns_whatsapp task; reuse its module and trial modal.
- The module registers the shared parent `nitsan_module`; other NITSAN extensions may register it too. Don't
  rename or remove it.
- All UI text goes into the English `Resources/Private/Language/*.xlf` files, no hard-coded labels.

---

## Apply this whenever you

- Edit `context/` or `AGENTS.md`
- Land a feature or bugfix (update the matching `context/features/*.md` + `session-state.md`)
