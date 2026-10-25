<laravel-boost-guidelines>
=== .ai/z-naykel-laravel rules ===

# Naykel Laravel Conventions

## Core rules

- Follow Laravel conventions first.
- Use explicit types (properties, params, returns).
- Prefer early returns over nested branching.
- Use migration `up()` only.
- Keep pricing/amount fields nullable without default `0`.

## Architecture priority

- Gotime is a foundational application package in this codebase (Livewire base
  components, shared traits, UI components, file handling, casts, markdown
  extensions, and supporting services).
- Prefer Gotime patterns first where they exist (`BaseForm`, `BaseIndex`,
  `Formable`, `Crudable`, `WithFormActions`, resource config, shared
  components/traits).
- Before introducing custom Laravel, Livewire, model, view, or helper behavior,
  check whether Gotime already provides a shared trait, helper, cast,
  component, or established pattern for that concern.
- Treat existing Gotime-backed implementations in sibling files as the default
  approach unless there is a clear reason to diverge.
- Use raw Livewire/Laravel alternatives only when Gotime does not provide the
  required behavior.

## Shared model helpers

- `HasFormattedDates` is an example of the broader Gotime-first rule above.
- When a model exposes user-facing date fields in views, form objects, tests,
  or controllers, prefer Gotime's `HasFormattedDates` pattern instead of ad hoc
  date formatting.
- If sibling models with similar date usage already use `HasFormattedDates`,
  follow that pattern unless there is a clear reason not to.
- Prefer model/helper methods such as `formatDate('published_at')` or
  convenience methods like `publishedAt()` over inline `->format(...)` calls in
  Blade and other callers.

=== .ai/z-naykel-livewire rules ===

# Naykel Livewire Conventions

## Component types

- `Index`: list and manage collections
- `Form`: create/edit a single record
- `Form-Modal`: form rendered inside a modal
- `Manager`: route-level coordinator for one resource
- `Editor`: coordinated multi-part editing workflow

## Core rules

- Generate components with `php artisan make:livewire`.
- If `config/livewire.php` does not exist, publish it first with
  `php artisan livewire:publish --config --no-interaction` before proceeding,
  then register the required namespace.
- Before registering or using a namespace, read `config/livewire.php` to check
  what namespaces and paths already exist.
- Namespaces must be registered in `config/livewire.php` under
  `component_namespaces` before use. Known namespaces and their paths:
    - `'admin' => resource_path('views/admin')`
    - `'user' => resource_path('views/user')`
- If the required namespace is not one of the known namespaces above, ask for
  the correct path before registering it.
- Name components as `{namespace}::{resource}.{type}`.
- Prefer inline Blade attributes; wrap only when the tag becomes hard to scan.

## Method ordering

Always follow this order inside any component class:

1. `configKey()` — always first
2. Event listeners (`#[On(...)]` methods)
3. `query()` — always last

## Guard rails

- If naming or structure is ambiguous, stop and confirm.
- Avoid unrequested namespace changes or broad renames.
- Preserve established local patterns unless explicitly asked to migrate.
- Do not change modal save semantics (`wire:submit`, `save`, `saveAndClose`,
  `saveAndEdit`) without explicit approval.

## Examples

- `admin::course.index`
- `admin::course.manager`
- `admin::lesson.quiz-form-modal`

=== .ai/z-working-with-nathan rules ===

# Working with Nathan

## When to Act vs When to Ask

**Act without asking when:**

- The task is explicitly requested.
- The approach is covered by an applicable skill.
- You're following an established pattern already used in the codebase.

**Stop and ask when:**

- Modifying files not mentioned in the request, unless clearly required to
  complete the task correctly.
- Multiple valid approaches exist and the choice has real consequences.
- Something conflicts with existing patterns in a way that needs a decision.
- Your interpretation of the request is genuinely ambiguous.

**Red flags — stop and explain before proceeding:**

- "I'll also…" — unsolicited additions
- "While I'm at it…" — scope expansion
- Using flags, options, or commands not present in the existing code or docs
- Expanding scope because something "requires" extra work — name the
  prerequisite and ask first

## Assumptions

State assumptions plainly. If an assumption has real consequences, do not
proceed without raising it.

If you are not sure, say so directly. Do not present guesses as facts.

## Disagreement and Pushback

Speak up when you see a real problem — silence is worse than friction.

**Do push back when:**

- A technical fact is incorrect
- A chosen approach will clearly cause a problem
- There is new information that changes the picture

**Don't relitigate:**

- Decisions already made without new information to offer
- Preferences already expressed
- Closed questions — unless based on a factual error, clear risk, or newly
  relevant information

When pushing back, state it once, clearly. If Nathan disagrees and proceeds,
follow the direction.

## Code Philosophy

- Start with the simplest solution that fits the existing code. If you see a
  better approach or a reason to change it, explain why and discuss it with Nathan
  before proceeding.

- **Explicit over clever** — show what's happening rather than hiding it
- **Start small, expand later** — validate the approach before building out
- **Name it before fixing it** — if something needs prerequisite work, say what
  and why before doing it

## Consistency First

- Check what the codebase already does before applying any rule or pattern.
- Validate existing patterns against applicable skills and guidelines.
- If a pattern conflicts with a rule, surface it — do not silently follow the wrong pattern.

## Scope Discipline

- Do not add adjacent improvements, refactors, cleanup, renaming, formatting,
  reorganisation, or bundled unrelated changes unless explicitly requested or
  clearly required to complete the task correctly.
- Do not introduce flags, options, or commands that are not already part of the
  existing code, docs, or agreed approach without raising them first.
- If something "requires" extra work, name the prerequisite and ask before
  expanding scope.
- Never remove a non-obviously-wrong comment without explicit approval.

## Execution Style

- For small, explicit tasks, do the work directly and report the result.
- For multi-step, risky, or ambiguous work, use incremental check-ins.
- Show the approach before executing when scope, risk, or consequences justify
  it.
- If the work starts taking a different shape than expected, surface that early
  instead of finishing and explaining afterwards.
- Once a concrete change is agreed, make the update instead of asking for
  another confirmation.
- Do not repeat agreement back unless there is a new risk, conflict, or
  decision to surface.
- Keep responses concise. Avoid long explanations when the next action is
  already clear.
- Do not summarise completed work. The result speaks for itself.
- Do not add filler at the end of responses ("let me know if you need
  anything", "hope that helps", etc.).

## Frustrations to Avoid

- Overcomplicating simple things
- Suggesting solutions already rejected
- Performing helpfulness — doing extra work that wasn't asked for to seem useful
- Burying a concern in the middle of a response instead of leading with it
- Being indirect or vague to avoid conflict

## Session Management

- Work one issue at a time. Do not answer several unresolved points in a single
  response.
- When multiple threads are in play, name the open threads explicitly — at the
  top of the response, not buried at the end.
- If a tangent appears, state what the main thread was before engaging with it
  so it is easy to return.
- If a required review, status, or process step becomes due, surface it before
  moving on.

## Naykel Conventions

- When reviewing guidelines, skills, or conventions in a Naykel project, assume
  they apply across all Naykel projects unless explicitly marked as
  project-specific. Do not treat them as local decisions without evidence.

## Skills

- When a skill applies, invoke it. Reading its `SKILL.md` is not a substitute.
- If a request conflicts with the skill, say so before proceeding, then follow
  the request. Never drop the skill silently.

### Sources and Sync

- Read, quote, and edit originals, never generated or installed copies.
- Project sources live in `.ai/`. Inspect entries with `ls -la` (PowerShell:
  `Get-ChildItem -Force` with `LinkType` and `Target`) and follow symlinks.
- Installed skills may be copies, not symlinks. Use available installation
  metadata or a documented source location to find the original. Ask only if
  it cannot be found or read.
- Changes to shared originals belong to the separate `skills-and-guidelines`
  repository, not this project's diff. Always name that repository and the files
  changed when reporting, including when Nathan asked for the change. If Nathan
  disputes a change, state that location first.
- Run the project's sync command only when Nathan asks or a batch is finished,
  not after every edit. Until then, read originals because copies may be behind.
  If no sync command exists, say propagation is pending.

## File References

- If a referenced file cannot be read, try resolving it from the repository
  root, then stop and ask. Never assume what a missing file contains.
- Reference files and code locations as markdown links —
  `[filename.md](path/to/file.md)` or `[file.php:42](path/file.php#L42)`.
  Never plain text paths.

## Task Tracking

Three files at the project root, distinguished by how long a thing stays true
and by who owns it.

### `_current-task.md`

The to-do list for the job in hand. Nathan's to use, ours to work with — he
writes in it too.

- Short-lived. Nathan may clear it at any time and move on. Never rely on it
  to carry anything between sessions.
- Help keep it current: when an item looks done, ask whether it should come
  off. Never add or remove an item without Nathan's yes.
- If something in it needs to outlast the job, raise it with Nathan.

### `_project-context.md`

Things we can't afford to forget. Ours to use — both of us.

- Important parked threads we genuinely need to come back to, and decisions
  worth remembering.
- Not every deferred point. The test is whether it would hurt to lose it, not
  whether it came up.
- Never add or remove an entry without Nathan's yes.
- Keep it under constant review. When an entry looks resolved or out of date,
  prompt Nathan to remove or update it — don't wait to be asked.
- Group entries under whatever headings fit — typically **Parked** and
  **Decided**, but add others as they're needed.

### `_todo.md`

Nathan's reminder list — jobs to ask for when he is ready. Not a work queue:
never action an item unless he asks.

- Never add or remove an item without Nathan's yes. When work on an item
  finishes in the session, ask whether it should come off.
- Match his style by default — terse entries, whatever headings made sense at
  the time. Expand or restructure when he asks.

## Off-Limits Directories

- `/tmp` is Nathan's personal scratch space. Never read, modify, delete, or
  reference files there unless explicitly asked.

=== foundation rules ===

# Laravel Boost Guidelines

## Foundational Context

This application is a Laravel application running on PHP 8.4. Always use the APIs that match the installed major version of each package — do not assume a version.

Before relying on a package's API, confirm its installed version:
- PHP packages: run `composer show --direct` to list direct dependencies with versions, or `composer show <vendor/package>` for a single package.
- JS packages: check `package.json` for the installed versions.

## Skills Activation

This project has domain-specific skills available in `**/skills/**`. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If a frontend change doesn't show in the UI or you get a "Unable to locate file in Vite manifest" error, run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Use `search-docs` before changes that depend on Laravel ecosystem APIs, behavior, configuration, or version-specific syntax. Skip it for copy-only edits and other changes where package documentation is irrelevant. Reuse sufficient results already in context instead of searching again.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Project Rules

- This project contains committed, area-grouped rules in `.ai/rules` when that directory exists, including path-scoped framework guidelines under `.ai/rules/boost`. Before you enter plan mode or create/edit any file, you MUST first: open @.ai/rules/index.md (it maps file globs to rule files), read every rule file whose globs cover the path(s) in scope, and run `grep -rin 'keyword' .ai/rules` to catch what a path match alone misses. Do not write code until you have read and are following every matching rule. If `.ai/rules` does not exist, continue without it.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.
- Activate the `deploying-to-cloud` skill whenever deploying to Laravel Cloud, configuring Cloud environments or resources, using the Cloud CLI, or troubleshooting Cloud deployments.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== pest/core rules ===

# Pest

- This project uses Pest. Create tests with `php artisan make:test --pest {name}`.
- Do not include the test suite directory in `{name}`. Use `SomeFeatureTest`, not `Feature/SomeFeatureTest`.
- Read the `testing-best-practices` skill for guidance on coverage, naming, structure, dependency isolation, and review.
- Do not delete tests or test files without approval. They are part of the application.

## Running Tests

- Run the narrowest set of tests that covers the change. Pass a file path or `--filter=testName` to `php artisan test --compact`.
- Rerun a test after each change to it.
- Run `vendor/bin/pest` to call the test runner directly. It accepts the same file path and `--filter=testName` arguments.
- After the feature tests pass, ask the user to run the complete suite with `php artisan test --compact`.

</laravel-boost-guidelines>
