# Feature — WhatsApp chat button and "Whatsapp Style" module

*Status: Done (free version, Style 1 only). Code-read (2026-10-15); module seen on v14.3.7, frontend not tested.*

## Setup

1. Include the static template "Whatsapp" or the site set `nitsan/ns-whatsapp`.
2. Set the WhatsApp number (country code + number) — without it no button is rendered.
3. Optional: change the button text and colours in the "Whatsapp Style" module (group T3Planet / NITSAN) or in
   the site set style settings.

## Rendering

- `page.111246` (USER, cached) runs `Whatsapp->list` on every page.
- `listAction()`: current page id (`TSFE` on v12, `frontend.page.information` on v13+), settings from the full
  TypoScript `plugin.tx_nswhasapp_whatsapp.settings`, `hide_pages` as an id list, `mobile` flag from the user
  agent, style records via `findAllstyle()`.
- `List.html`: for each style record whose `Style<n>` matches `style_desktop` / `style_mobile` (both fixed to
  `Style1`), renders `Partials/Chat/Style1.html` unless the page is in `hide_pages`, `is_enable` is off or the
  number is empty. Position classes for `Top-left`, `Top-right`, `Bottom-left` (default `Bottom-right`);
  `hide_mobile` / `hide_desktop` add CSS classes.
- `Style1.html`: colours from the site set settings, else from the module record, added via `f:asset.css`;
  link to `web.whatsapp.com` (`web_whatsapp` on) or `api.whatsapp.com` `send?phone=…&text=<pre-filled
  message>`, `target="_blank"`.

## Settings

| Classic constant (`plugin.tx_nswhasapp_whatsapp.settings.*`) | Site set setting | Default |
|---|---|---|
| `is_enable` | `ns_whatsapp.chat.isEnable` | on |
| `whatsapp_number` | `ns_whatsapp.chat.whatsappNumber` | empty |
| `pre_filled_message` | `ns_whatsapp.chat.preFilledMessage` | empty |
| `position` | `ns_whatsapp.chat.position` | `Top-left` |
| `web_whatsapp` | `ns_whatsapp.chat.webWhatsapp` | on |
| `hide_pages` | `ns_whatsapp.chat.hidePages` | empty |
| `hide_mobile` / `hide_desktop` | `ns_whatsapp.chat.hideMobile` / `hideDesktop` | off |
| — | `ns_whatsapp.style.style1{Text,TextColor,BackgroundColor,BorderWidth,BorderColor,HoverTextColor,HoverBackgroundColor,HoverBorderColor}` | `default` / empty = module value |
| `view.*RootPath` | `ns_whatsapp.view.*RootPath` | extension paths |

The site set quotes colour values in TypoScript because an unquoted `#hex` would be read as a comment.

## "Whatsapp Style" module

- `styleSettingsAction()` lists the style records; the form edits text, text/border/background colours, border
  width and hover colours of Style 1 and posts to `updateAction()`, which saves, adds a flash message and
  redirects back.
- `processRequest()` re-signs the trusted-properties token with string keys (fixes "hasArgument() must be of
  type string, int given").
- Premium strip at the top (see `premium-cta.md`).
