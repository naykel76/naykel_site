# Naykel Project Plan (review)

## Project Goal

Rebuild the website one section at a time, using each section to review, refine, and validate the packages and libraries that support it.

Use Naykel as a practical development environment to regain control of unfinished work and bring its supporting packages up to date and into alignment through real use.

Develop and test a reusable website discovery, design and build process alongside this work. The process should support client discussions, recording answers and returning to unfinished work.

## Purpose and Audience (review)

The immediate purpose is to document existing work. The initial reader is the developer maintaining it, expanding to developers and clients who need reference documentation for sites built with these packages.

The first release is a working documentation site with content migrated incrementally. Business promotion is a longer-term goal.

## Functional Requirements (review)

Initial package scope is JTB and Gotime. Introduce other packages as needed.

Application and package setup comes first. The navbar, including a burger menu, is the first UI feature. Detailed behaviours remain to be agreed during that work. A side drawer is not a confirmed requirement.

Existing documentation, skills and guidelines are the foundation. Review, refine and migrate the relevant material as each feature is addressed, preserving the established documentation structure.

## Non-Functional Requirements (review)

Review these considerations against each feature's actual needs. Specific targets remain open.

- [ ] Agree responsive behaviour and mobile usability checks.
- [ ] Agree relevant accessibility and keyboard interaction checks.
- [ ] Identify performance expectations and appropriate checks.
- [ ] Identify reliability, error handling and browser compatibility needs.

## Development Approach (review)

Start with a fresh Laravel application in a separate directory and repository, keeping the existing site as a reference. Application installation will be handled manually by the project owner. Preserving the existing repository history in the new application is not required.

Implementation drives package review. Review existing implementations before deciding what needs to be built. Reuse, refine and integrate what already exists.

A feature can be ready for the current site while broader package gaps remain explicitly tracked. Resolve blockers for the agreed site behaviour before moving on; package-wide completion is not a prerequisite.

### Application Setup Checklist (review)

Prepare the fresh Laravel application for installing Gotime and JTB. Development tools are assumed installed. Package installation follows in the next phase.

- [x] Confirm the fresh application baseline. Laravel 13.38.0, Boost guidance and five Boost-managed skills are installed.
- [x] Create the three tracking files and migrate this project plan.
- [ ] Select the shared skills and guidelines needed for the application baseline, plus any project-specific additions. The selection is not yet final.
- [ ] Confirm how guidelines and project-specific skills will be activated and updated before adding them. The shared README references a missing `scripts/ai-sync.js`; no working sync procedure has been established for Codex guidance.
- [ ] Install shared skills from the Laravel project root using the existing [shared repository instructions](C:/Users/natha/sites/skills-and-guidelines/readme.md). This documented command is pending validation; confirm it matches the selected baseline before running it.

    ```bash +code
    npx skills@latest add naykel76/skills-and-guidelines --copy --yes
    ```

    The earlier isolated CLI test failed to download and was cancelled. It installed no skills and did not validate this command.

- [ ] Add the selected shared guidelines from the shared repository's `guidelines/` directory to `.ai/guidelines/`, then activate them using the procedure agreed above. Copying them alone does not establish Codex activation.
- [ ] Add any needed project-specific skills to `.ai/skills/` using the documented source layout, then activate them using the agreed procedure. Their activation and update mechanism remains unresolved.
- [ ] Verify the selected skills and guidelines are accessible to the intended agents and work alongside the existing Boost guidance without conflicting copies or overwritten Boost content.
- [ ] Record the verified application-specific setup and update steps, linking to existing shared instructions rather than duplicating them.
- [ ] Confirm the application baseline is ready for Gotime and JTB installation, with no unresolved guidance activation blockers.

### Package Installation Checklist (review)

After application setup, install Gotime and JTB before starting the navbar. Validate their existing installation documentation through use.

- [ ] Locate and review the existing JTB and Gotime installation instructions.
- [ ] Follow those instructions to set up the packages in the fresh application.
- [ ] Verify the installed packages operate in the application.
- [ ] Correct documentation gaps encountered during setup and record remaining gaps through the existing package status systems. Confirm coverage before updating statuses.
- [ ] Document a repeatable application setup procedure with links to the existing package instructions and the site-specific steps alongside them. Avoid duplicating package instructions.

### Navbar Checklist (review)

The first UI feature follows application setup. This checklist is a draft for review. No implementation work is marked complete.

- [ ] Identify the required links, states and interactions, including burger menu behaviour.
- [ ] Review the relevant JTB navbar, menu and utility styles against their implementation and existing documentation.
- [ ] Verify which Gotime components and behaviours already support the navbar, and identify any gaps.
- [ ] Agree the integration approach and acceptance criteria for this site's navbar.
- [ ] Implement and integrate the navbar using the existing package capabilities, refining only what the agreed behaviour needs.
- [ ] Test the agreed behaviour and relevant responsive layouts, burger interaction, keyboard access, focus and accessibility states. Confirm the specific checks before implementation.
- [ ] Review, update and migrate the applicable existing documentation and examples against the implemented behaviour.
- [ ] Record remaining package or documentation gaps in the existing package status systems. Update coverage statuses only when confirmed against implementation and documentation.
- [ ] Confirm the navbar meets this site's acceptance criteria and distinguish any remaining package gaps from site blockers.

### Feature Review Checklist (review)

Reuse this cycle for later features. The navbar checklist applies it to the first UI feature.

- [ ] Define the feature's required behaviour and acceptance criteria.
- [ ] Check the relevant existing styles, components, documentation and package status entries.
- [ ] Implement, integrate and test what the site needs.
- [ ] Review and migrate the applicable documentation alongside implementation.
- [ ] Confirm site readiness and record remaining package gaps in the existing status systems.

### Provisional Website Coverage (review)

Review these work areas as the site develops. They are coverage prompts, not approved features or a fixed build order after the navbar.

- [ ] Site layout and navigation. Identify the remaining structure and components needed for the documentation site.
- [ ] Documentation migration. Identify relevant existing material and migrate it incrementally into the established structure.
- [ ] Documentation access. Check how readers reach and navigate the migrated content, and identify any missing behaviour.
- [ ] Site verification. Check the integrated experience, links, content rendering and agreed quality requirements.
- [ ] Release and maintenance. Agree first-release readiness, deployment checks and how ongoing package and documentation changes will be maintained.

## Acceptance Criteria (review)

Specific feature criteria and release criteria remain to be agreed. Proposed readiness checks:

- [ ] The feature's agreed behaviour works on the site and passes the relevant checks.
- [ ] Applicable documentation reflects the verified implementation.
- [ ] Remaining gaps are recorded, with site blockers resolved and broader package work clearly distinguishable.
- [ ] Relevant package coverage has been confirmed before its status is updated.

## Out of Scope / Deferred Work (review)

Business promotion is deferred beyond the initial documentation release. Additional packages enter scope only as needed.

Record further deliberate exclusions as they are agreed. This checklist does not require every package capability or possible website use case to be completed.

## Tracking (review)

- **Project plan:** overall deliverables and build checklist.
- **Current task:** active work.
- **Project context:** durable decisions and important parked matters.
- **Todo:** future reminders, never an automatic work queue.
- **Package status boards:** implementation and documentation coverage, using each board's existing statuses.

Use the original [JTB status board](C:/Users/natha/sites/nk_jtb/docs/jtb-status.md) and [Gotime status board](C:/Users/natha/sites/naykel/resources/views/docs/gotime/gotime-status.md). Keep package coverage there rather than duplicating it in this plan.

Do not add or remove entries in the current task, project context or todo files without approval.

## Open Questions (review)

Resolve decisions one question at a time as the work reaches them.

- Navbar behaviours, integration details and acceptance criteria.
- Remaining site scope and priorities after the navbar.
- Package versions and update requirements.
- Measurable quality targets and first-release acceptance criteria.
- Timeline and release arrangements.
