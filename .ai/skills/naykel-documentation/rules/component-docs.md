# Component Documentation

Extends the [shared component rules](../../nk-documentation-best-practices/rules/component-docs.md).

## Document Flow

Use this order as a starting point, including only sections the component needs:

1. **Basic Usage** — what to add and what happens, using working defaults.
2. **Customising** — common options before the full API; introduce one change per example.
3. **Properties** — types, defaults and concise descriptions.
4. **How It Works** — the component's data flow and responsibilities.
5. **Building a Custom Layout (optional)** — explain extension points when the
   component's complexity warrants it; link to a walkthrough if one is needed.
6. **Important Limits** — constraints that affect correct use.

Explain actions in plain language before introducing implementation terms.
Link to shared architecture and configuration references instead of repeating them.
Simple components do not need a custom-layout section or a separate guide.

## Examples

- Keep copyable usage focused on the option being explained. Do not add props
  solely to make the documentation preview work.
- Use `+demo` or `+demo-folded` when the displayed call and preview use the same
  data and settings.
- When the preview needs different data or settings, separate the code-only
  usage from a `+preview` block labelled **Example output**.
- Make sample labels and headings fit together. Keep demonstration data separate
  from application navigation when the preview needs a stable example.
- Use `preview-class` to frame only the rendered component; `class` wraps the
  combined demo and code. Keep presentation framing out of reusable markup.

## Custom Layouts and Guides

- When documenting custom layouts, present the base as an optional extension
  point. Explain what it provides and what custom markup must handle itself.
- Keep reference docs focused on available options and responsibilities. Link
  to a guide for the progressive build rather than duplicating its walkthrough.
- In guides, explain what view to create, how to select it and the expected
  result. Treat example filenames as illustrations, not required conventions.
- Indent code blocks under their numbered list items so numbering continues.
