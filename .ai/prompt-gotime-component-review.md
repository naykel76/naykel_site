# Gotime Component Review

## Purpose

Gotime's components predate the current JTB framework. This review takes one
component at a time and establishes whether the application can rely on it as
it stands.

Follow the [Component Development Workflow](../resources/views/docs/component-development-workflow.md)
for the JTB → Gotime → application sequence, documentation, and status updates.
Existing components may be used while their broader review remains outstanding.

## Review Target

- **Component or composition:** `[name]`
- **Required behaviour:** `[what it needs to do for this application]`
- **JTB reference:** `[example or file path]`

## Instructions and Skills

Read `AGENTS.md` or `CLAUDE.md` and apply `code-review` and the relevant Naykel
and JTB skills.

## Source Locations

Three separate repositories are in play.

| Concern                            | Repository             |
| ---------------------------------- | ---------------------- |
| Styling, markup and design         | `nk_jtb`               |
| Reusable components and behaviour  | `vendor/naykel/gotime` |
| Application-specific composition   | this application       |

Gotime is linked as a local development repository, so its files are editable
directly. When changes are agreed, edit the appropriate source file and state
which repository it belongs to. Changes outside this application do not appear
in its diff.

## Scope

Review the named component and the pieces it directly composes. Do not follow
composition further unless a finding depends on it. Note anything deeper as a
separate review target instead of expanding this one.

## Review Checklist

Start with the JTB reference, then check:

- The Gotime component and the pieces it directly composes.
- Which of those files the application actually uses.
- Existing documentation and entries in `resources/views/docs/gotime/gotime-status.md`.

## Findings

Use `resources/views/docs/gotime/gotime-status.md` as the package status file.
Follow the **Package Review Procedure** in `code-review` for findings,
documentation checks, and coverage updates.

Ask one question at a time where clarification is needed. Discuss findings
before changing implementation.
