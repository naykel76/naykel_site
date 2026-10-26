# Imported guidance review

## Scope Reviewed

- Compared the imported `.ai/naykel-documentation` skill and `.ai/prompts.md` with the shared documentation, Markdown, skill-creation, review, Livewire, and working-with-Nathan rules.
- Checked local skill locations, installed skill names, Boost discovery code, and shared setup instructions. This is not a complete audit of every skill in the shared repository.
- Guidance was inspected only. This report is the only file created or changed.

## Findings

### Medium — The imported documentation skill is outside the standard discovery location

- **Impact:** The imported rules are not available through the current normal skill installation, so their presence does not reliably activate them.
- **Evidence:** The source is [`.ai/naykel-documentation/SKILL.md`](C:/Users/natha/sites/naykel/.ai/naykel-documentation/SKILL.md); [Boost SkillComposer.php:155](C:/Users/natha/sites/naykel/vendor/laravel/boost/src/Install/SkillComposer.php:155) discovers explicit user skills under `.ai/skills`, and `naykel-documentation` is absent from the current `.agents/skills` directory and Boost selection.
- **Fix:** Move the entire skill into `.ai/skills/naykel-documentation`, then include it in the configured Boost skill update and verify its availability.

### Medium — The documentation skill routes to a missing notes rule

- **Impact:** Notes tasks activate instructions that require a file which was not brought across.
- **Evidence:** [SKILL.md:29](C:/Users/natha/sites/naykel/.ai/naykel-documentation/SKILL.md:29) references `rules/notes.md`, but the imported rules directory contains only `guidelines.md` and `package-docs.md`; the original notes rule remains in the old site.
- **Fix:** Restore that rule if notes remain in scope, or remove the notes routing and trigger wording if its omission was intentional.

### Medium — Published-document rules are applied to internal notes and guidelines without a clear exception

- **Impact:** Agents are instructed to add HTML leads, review headings, and navigation entries to internal guidance where those requirements are inappropriate.
- **Evidence:** The imported skill explicitly covers notes and internal guidelines and inherits [nk-documentation-best-practices](C:/Users/natha/sites/skills-and-guidelines/nk-documentation-best-practices/SKILL.md), whose lines 17, 37–38, and 45 impose these rules broadly. The imported guidelines rule does not exempt internal documents; the notes exception was in the missing file.
- **Fix:** Scope published-page structure and navigation rules in the shared skill to published documentation, with explicit handling for internal notes, prompts, skills, and review reports.

### Medium — A reusable package-review prompt assumes vendor files are editable originals

- **Impact:** Reusing the prompt with a release installation can direct work toward an installed copy rather than the maintained package source.
- **Evidence:** [prompts.md:13](C:/Users/natha/sites/naykel/.ai/prompts.md:13) declares the vendor package local and directly editable, whereas [working-with-nathan.md:133](C:/Users/natha/sites/skills-and-guidelines/guidelines/working-with-nathan.md:133) requires reading and editing originals after resolving source locations.
- **Fix:** Ask the agent to resolve the package source or symlink first and keep review analysis-only unless changes are requested.

### Low — The component-generation prompt names an unavailable skill

- **Impact:** The prompt requires `livewire-development`, which is not available in the current installed skill set.
- **Evidence:** [prompts.md:47](C:/Users/natha/sites/naykel/.ai/prompts.md:47) names that skill; it is absent from `.agents/skills` and the shared repository inspected here.
- **Fix:** Update the prompt to the intended available skills, or deliberately install the missing skill if it is still required.

### Low — Shared setup instructions assume a sync script that this application does not use

- **Impact:** Following the shared README for this application leads to a different update procedure from the application's working Boost procedure.
- **Evidence:** [shared readme.md:64](C:/Users/natha/sites/skills-and-guidelines/readme.md:64) prescribes `node scripts/ai-sync.js`; the application setup guide prescribes `php artisan boost:update`.
- **Fix:** Document the applicable updater per project instead of prescribing the script universally; retain it for projects that actually use it.

## Duplication and precedence

The local documentation skill explicitly extends the shared skill and takes
precedence where they conflict. That is a valid arrangement, not a duplicate
installation. Package overview structure and individual component-page structure
also cover different subjects and can coexist.

Updating package status after confirmation is repeated in both documentation
skills. Keep the generic rule shared and let the local skill identify the actual
package tracker. This is maintenance cleanup rather than a behavioural defect.
It does not itself conflict with the separate approval rules for `_todo.md`,
`_current-task.md`, and `_project-context.md`.

The migration-based prompt already invokes the config-first Livewire skill, so
there is not an unavoidable instruction conflict. Explicitly saying to establish
resource configuration before generating components would make the intended
sequence clearer. The shared Livewire skill itself should qualify its broad
"any component" wording as applying to the resource-based components it describes.

The agreed JTB-first composition process is not captured in the imported
guidance. Record that workflow once in the appropriate source, then reference it
from prompts. Avoid repeating it across every skill.

The imported Markdown lint config does not duplicate behavioural skills; it
disables three lint rules. No blocking conflict was found there.

## Recommended order

1. Correct the local skill location and decide whether to restore notes support.
2. Clarify the shared documentation rule scope.
3. Correct the package-review and component-generation prompts.
4. Record the JTB-first composition workflow once.
5. Update the shared README's project-specific sync instructions, then refresh agent guidance after the agreed edits.

## Maintainability Risk

Moderate. The extension structure is useful, but missing references and overly
broad document rules can produce inconsistent output.

## Cross-Boundary Coupling Risk

Moderate. Local rules depend on shared originals and Boost publishing. Fix shared
rules in `skills-and-guidelines`, local rules in this project, and avoid editing
generated copies.
