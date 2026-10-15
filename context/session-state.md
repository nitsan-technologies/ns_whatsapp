# ns_whatsapp — Session state

## 2026-10-15 — ns_license integration + premium strip + agent context

- Branch `feature/ns-license-premium-strip` from `main` (2cb7be6).
- Added `nitsan/ns-license ^14.5.4` / `ns_license 14.5.4-14.9.99` (minimum stays TYPO3 12.4.37). Version
  14.1.0 → 14.2.0 (14.1.0 is already tagged).
- Premium strip with "Start Free Trial" → ns_license module `?trial=ns_whatsapp#free-section` at the top of the
  "Whatsapp Style" module, team-wide wording and design (see `features/premium-cta.md`).
- Verified live on TYPO3 14.3.7 classic with a temporary system-maintainer admin (removed; `settings.php`
  restored byte-identical). PHP 8.4 and 8.1 lint clean.
- Created agent context (`AGENTS.md`, `CLAUDE.md`, `context/`, `tasks/`) and `.gitattributes`; no previous
  context existed.
- Open: ns_license 14.5.4 not yet published; v12/v13 not tested; frontend only code-read.
