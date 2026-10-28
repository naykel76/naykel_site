# Gotime Component Review

Review `[component]` in Gotime.

Read `AGENTS.md` or `CLAUDE.md` and apply `code-review` and other relevant
skills.

## References

**Design document or example, if applicable:** `[file path or link]`

Use the supplied reference. If one is needed but missing, ask for its location.
Check [Component Architecture](../resources/views/docs/gotime/core-concepts/component-architecture.md)
and the documentation relevant to the review target. Verify uncertain claims
against source.

For UI components, check `nk_jtb/docs/jtb-status.md` first and use the relevant
JTB example. Reuse confirmed coverage; inspect areas needed to establish
compatibility or resolve uncertainty. Ask about intended behaviour only when it
is unclear.

Use the sequence and status conventions in the
[Component Development Workflow](../resources/views/docs/component-development-workflow.md).
The Gotime status file is `resources/views/docs/gotime/gotime-status.md`.

## Scope

Review the named component, the pieces it directly composes, and application
overrides. Go deeper only to investigate a specific finding; record other nested
components as separate review targets. Establish which source files the
application uses.

Gotime is a local development repository linked through `vendor/naykel/gotime`,
so its files are editable directly.

## Findings

Ask one question at a time where clarification is needed. Discuss findings
before changing implementation. Once a change is agreed, edit the maintained
source and state which repository it belongs to.
