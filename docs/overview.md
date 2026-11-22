# Content Reveal Widget

<!-- prettier-ignore-start -->

A visitor presses "See prices" on a short card, and your price list opens over the page in a pop-up or a panel that slides in from the side. They read it, close it and are back where they were. That helps on a long page, where the part someone came for can be a lot of scrolling away.

The cards don't hold the detail themselves. Each one points at something you've already put on the same page, such as your price list or the piece about your team. Build that part of the page first and save it. Then add up to twelve cards, each with a title and a line of teaser text above its button.

For every card you pick what it opens from a searchable list of the other parts of that page. You also choose whether it appears as a pop-up or slides in from the side. A card can't open anything from a different page. Rearrange the page later and every card still opens the right part.

## What it does

Content Reveal lets editors introduce deeper content with up to 12 teaser cards. A visitor can open a registered widget snapshot in an accessible overlay, slide-over, inline region, or replacement region.

## Do I need to do anything?

Add **Content Reveal** in Layout Builder and enter its heading. Add one to 12 ordered teaser cards; each card needs a title, teaser, button label, and a named target widget from **Content to open**. Choose how the target should open: **Modal**, **Slide-over**, **Inline reveal**, or **Replace region**. Preview the public page before publishing.

## Where it shows up

Editors configure it as a Layout Builder widget that selects target widget instances and a presentation behaviour for each card. On the public page, a resolved card is a regular link as well as an enhanced interaction. If its target is not present in the rendered page, the card keeps its teaser and button label but cannot open the target.

## Good to know

- This free extension belongs to Capell Essentials and requires Layout Builder.
- Target UUIDs are authoring data. A resolvable target becomes an interaction locator in public markup; raw model identifiers are not emitted.
- Modal interactions support backdrop dismissal and expose loading, ready, error, retry, and standalone-fallback status text to assistive technology.

**Content to open** lists registered widgets from the current page content field and language, excluding the widget being edited. It keeps stable identities internally, so reordering does not change the target. Targets in other pages, languages, or separate content fields are not offered. If a saved target is removed or unavailable, the authoring form asks you to select a replacement before publishing. The public page keeps the existing safe fallback without exposing the missing identity.

---

For developers: see the [README](../README.md).

<!-- prettier-ignore-end -->
