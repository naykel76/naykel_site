<!-- markdownlint-disable MD033 MD041 MD045-->
<p align="center"><a href="https://naykel.com.au" target="_blank"><img src="https://avatars0.githubusercontent.com/u/32632005?s=460&u=d1df6f6e0bf29668f8a4845271e9be8c9b96ed83&v=4" width="120"></a></p>

# NAYKEL Web Application

## Development symlinks (review)

Run these commands from the application root in Git Bash on Windows with native
symlink support enabled. The `/c/...` paths are Git Bash paths. Create only links
that do not already exist.

General syntax:

```bash +code
ln -s <target> <link_name>
```

Use `z-` for convenience links and guideline links so they are easy to exclude in
`.gitignore` and distinguish from actual packages. Skill links keep their skill
names.

```bash +code
# Package convenience links
ln -s vendor/naykel/gotime z-gotime

# Guideline and skill directories
mkdir -p .ai/guidelines .ai/skills

# Guidelines
ln -s /c/Users/natha/sites/skills-and-guidelines/guidelines/working-with-nathan.md .ai/guidelines/z-working-with-nathan.md
ln -s /c/Users/natha/sites/skills-and-guidelines/guidelines/naykel-laravel.md .ai/guidelines/z-naykel-laravel.md
ln -s /c/Users/natha/sites/skills-and-guidelines/guidelines/naykel-livewire.md .ai/guidelines/z-naykel-livewire.md

# Best practices
ln -s /c/Users/natha/sites/nk_jtb/.ai/skills/jtb-best-practices .ai/skills/jtb-best-practices
ln -s /c/Users/natha/sites/skills-and-guidelines/nk-documentation-best-practices .ai/skills/nk-documentation-best-practices
ln -s /c/Users/natha/sites/skills-and-guidelines/nk-laravel-best-practices .ai/skills/nk-laravel-best-practices
ln -s /c/Users/natha/sites/skills-and-guidelines/nk-livewire-best-practices .ai/skills/nk-livewire-best-practices

# Other skills
ln -s /c/Users/natha/sites/skills-and-guidelines/code-review .ai/skills/code-review
ln -s /c/Users/natha/sites/skills-and-guidelines/grill-me .ai/skills/grill-me
ln -s /c/Users/natha/sites/skills-and-guidelines/markdown-formatting .ai/skills/markdown-formatting
ln -s /c/Users/natha/sites/skills-and-guidelines/mermaid-diagram .ai/skills/mermaid-diagram
ln -s /c/Users/natha/sites/skills-and-guidelines/skill-creation .ai/skills/skill-creation
```
