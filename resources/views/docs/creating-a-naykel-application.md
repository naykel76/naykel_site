# Creating a Naykel application

## 1. Create the application

- [x] Create a fresh Laravel application and initialise its Git repository.
- [x] Install and configure Laravel Boost for the development agents in use.
- [x] Create `_current-task.md`, `_project-context.md` and `_todo.md`.

## 2. Install and configure Gotime

- [x] Choose the package source. Standard applications use published releases.
  For local package development, add a Composer path repository before requiring
  Gotime. Merge these entries into `composer.json`, preserving other settings:

    ```json +code
    {
        "repositories": [
            {
                "type": "path",
                "url": "../nk_packages/gotime",
                "options": {
                    "symlink": true
                }
            }
        ],
        "require": {
            "naykel/gotime": "dev-main as 2.0.x-dev"
        }
    }
    ```

    Adjust the path to the local package. This development constraint is not
    required when using published releases. Add other packages only as needed.

- [x] Follow [Gotime installation](gotime/installation.md) to install the Composer
  dependency, run `gotime:install`, install frontend dependencies and build assets.
- [x] Configure the application environment and any required package settings.
- [ ] Check the generated starter routes, layouts, Livewire/Alpine setup and
  asset integration. Adapt them to the application rather than adding them twice.

    The installer adds JTB to `package.json`; `npm install` installs it. A separate
    JTB installation step is not needed for the default scaffold.

- [x] Open the application and confirm the page loads, JTB styling appears, and
  a basic Gotime interaction works.

## 3. Set up skills and guidelines

- [x] Set up shared skills using the appropriate source method.

    For standard applications, install shared skill copies from the application
    root:

    ```bash +code
    npx skills@latest add naykel76/skills-and-guidelines --copy --yes
    ```

    For the package development site, follow the
    [development symlink instructions](../../../README.md#development-symlinks-review)
    to link shared working originals instead of installing copies.

- [x] Add project-specific skills to `.ai/skills` if needed.
- [x] Copy or link the relevant custom guidelines into `.ai/guidelines`.
- [x] Update the configured agents' instructions and skills with Laravel Boost.

    ```bash +code
    php artisan boost:update
    ```

- [x] Verify the generated instructions include the selected custom guidelines
  and the agents can access the required skills.
