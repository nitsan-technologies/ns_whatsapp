# AGENTS.md — ns_whatsapp (TYPO3 WhatsApp Chat Integration)

Agent router for the WhatsApp free extension. Load only what your task needs.

> **Principles:** `context/principles.md`
> **Session log:** `context/session-state.md`
> **Doc index:** `context/docs-map.md`

---

## Always load

| File | Why |
|---|---|
| `context/principles.md` | Guardrails, "nothing that works may break" rule |
| `context/core.md` | Identity, TYPO3/PHP/ns_license constraints, tooling, known issues |

---

## Task router

| Task | Load |
|---|---|
| Chat button on the website: TypoScript / site set settings, position, hide rules, WhatsApp URL, button style | `context/features/chat-button.md` |
| "Whatsapp Style" backend module (button text and colours) | `context/features/chat-button.md` |
| Premium strip / free trial / ns_license dependency | `context/features/premium-cta.md` |
| Files, classes, TypoScript structure, assets | `context/architecture.md` |
| Lint / validate / manual test | `tasks/run-quality.md` |
| Update agent context after a change | `tasks/context-update.md` |

---

## Feature status

| Feature | Status | Agent entry |
|---|---|---|
| Floating WhatsApp chat button on every page (Style 1) | Done (code-read) | `context/features/chat-button.md` |
| "Whatsapp Style" backend module | Done (seen on v14.3.7) | `context/features/chat-button.md` |
| Premium strip at the top of the "Whatsapp Style" module + ns_license free-trial deep link | Done (needs ns_license 14.5.4 release) | `context/features/premium-cta.md` |

---

## Quick commands

```bash
cd packages/ns_whatsapp            # or typo3conf/ext/ns_whatsapp in Classic mode
for f in $(find . -name "*.php" -not -path "./.git/*"); do php -l "$f"; done
composer validate --no-check-publish
for f in Resources/Private/Language/*.xlf; do xmllint --noout "$f"; done
```
