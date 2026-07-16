# Content Reveal Widget

<!-- prettier-ignore-start -->

## What it does

Content Reveal lets editors introduce deeper content with up to 12 teaser cards. A visitor can open a registered widget snapshot in an accessible overlay, slide-over, inline region, or replacement region.

## Do I need to do anything?

Add **Content Reveal** in Layout Builder and enter its heading. Add one to 12 ordered teaser cards; each card needs a title, teaser, button label, and the UUID of its target widget instance. Choose how the target should open: **Modal**, **Slide-over**, **Inline reveal**, or **Replace region**. Preview the public page before publishing.

## Where it shows up

Editors configure it as a Layout Builder widget that selects target widget instances and a presentation behaviour for each card. On the public page, a resolved card is a regular link as well as an enhanced interaction. If its target is not present in the rendered page, the card keeps its teaser and button label but cannot open the target.

## Good to know

- This free beta extension belongs to Capell Foundation and requires Layout Builder.
- Target UUIDs are authoring data. A resolvable target becomes an interaction locator in public markup; raw model identifiers are not emitted.
- Modal interactions support backdrop dismissal and expose loading, ready, error, retry, and standalone-fallback status text to assistive technology.

## Screenshot status

Capture the configured teaser cards and a public reveal in its open state, including the keyboard-visible close control. The committed Marketplace card is interim beta artwork until these two fixture captures are recorded.

---

For developers: see the [README](../README.md).

<!-- prettier-ignore-end -->
