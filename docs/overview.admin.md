## What it does

Content Reveal lets editors introduce deeper content with up to 12 teaser cards. A visitor can open a registered widget snapshot in an accessible overlay, slide-over, inline region, or replacement region.

## Do I need to do anything?

Add **Content Reveal** in Layout Builder and enter its heading. Add one to 12 ordered teaser cards; each card needs a title, teaser, button label, and a named target widget from **Content to open**. Choose how the target should open: **Modal**, **Slide-over**, **Inline reveal**, or **Replace region**. Preview the public page before publishing.

## Where it shows up

Editors configure it as a Layout Builder widget that selects target widget instances and a presentation behaviour for each card. On the public page, a resolved card is a regular link as well as an enhanced interaction. If its target is not present in the rendered page, the card keeps its teaser and button label but cannot open the target.

## Good to know

- This free beta extension belongs to Capell Foundation and requires Layout Builder.
- Target UUIDs are authoring data. A resolvable target becomes an interaction locator in public markup; raw model identifiers are not emitted.
- Modal interactions support backdrop dismissal and expose loading, ready, error, retry, and standalone-fallback status text to assistive technology.

## Screenshot status

Capture the configured teaser cards and a public reveal in its open state, including the keyboard-visible close control. The committed Marketplace card is interim beta artwork until these two fixture captures are recorded.

**Content to open** lists registered widgets from the current page content field and language, excluding the widget being edited. It keeps stable identities internally, so reordering does not change the target. Targets in other pages, languages, or separate content fields are not offered. If a saved target is removed or unavailable, the authoring form asks you to select a replacement before publishing. The public page keeps the existing safe fallback without exposing the missing identity.
