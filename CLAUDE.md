# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Repository Overview

This is a **PHP educational repository** containing French-language tutorial documentation covering fundamental PHP concepts. The repository contains markdown files (`.md`) that serve as a structured learning guide for PHP fundamentals, from basic syntax to security best practices.

## Repository Structure

- **Root directory**: Contains 21 numbered tutorial parts (`part1.md` to `part21.md`), a table of contents (`readme.md`) and a self-assessment quiz (`test.md`)
- **`exercices/`**: Standalone `.php` exercise files with an explanatory `readme.md`
- **Language**: All documentation is written in French
- **Target version**: PHP 8.4 (version-specific features are flagged, e.g. "PHP 8.1")

## Content Organization

The tutorial covers 21 PHP topics in sequence:

1. Introduction à PHP
2. Installation et configuration de PHP
3. Syntaxe de base et structure d'un script PHP
4. Variables et types de données
5. Opérateurs
6. Structures de contrôle
7. Fonctions
8. Tableaux
9. Gestion des chaînes de caractères
10. Gestion des formulaires et des données utilisateur
11. Gestion des fichiers
12. Introduction à la programmation orientée objet (POO)
13. Connexion à une base de données
14. Gestion des erreurs et débogage
15. Bonnes pratiques et sécurité
16. Dates et heures
17. Sessions, cookies et authentification
18. Organisation du code : inclusions, namespaces et autoloading
19. JSON et introduction aux API web
20. Expressions régulières (PCRE)
21. Introduction aux tests automatisés

Each part file links to official PHP documentation and other relevant resources.

## Coding Standards Referenced

The documentation emphasizes the following PHP best practices:

- **PSR Standards**: PSR-1 and PSR-12 for coding style
- **Indentation**: 4 spaces (no tabs)
- **Statement structure**: One statement per line
- **File structure**: Omit closing `?>` tag in pure PHP files
- **Case sensitivity**: Keywords in lowercase

## Security Principles Covered

The tutorial emphasizes:

- Server-side validation (never trust client-side validation alone)
- Using `filter_var()` and `filter_input()` for input validation
- `htmlspecialchars()` for XSS prevention
- Prepared statements (PDO/MySQLi) for SQL injection prevention
- HTTPS for secure communication
- Proper file permissions

## Common Development Commands

Since this is a documentation repository, there are no build, test, or run commands. The typical workflow involves:

- **Viewing documentation**: Open `.md` files in a markdown viewer or text editor
- **Testing PHP examples**: Code examples from the documentation can be tested using:
  ```bash
  php -S localhost:8000
  ```
  (for running a local PHP development server)

## Working with This Repository

When modifying or adding content:

- Maintain consistent French language throughout
- Follow the existing numbering scheme for parts
- Include official PHP documentation links
- Keep code examples simple and beginner-friendly
- Ensure examples demonstrate the concept being taught
- Update `readme.md` (the table of contents) if adding new sections
- When adding sections, keep `test.md` and `exercices/readme.md` in sync if relevant
