# 18. Organisation du code : inclusions, namespaces et autoloading

Au-delà de quelques fichiers, un projet PHP a besoin d’une organisation : découper le code en fichiers, éviter les collisions de noms, et charger automatiquement les classes. C’est le rôle des **inclusions**, des **namespaces** et de l’**autoloading** (via Composer).

## Inclure un fichier

```php
require 'config.php';        // erreur fatale si le fichier manque
require_once 'config.php';   // idem, mais n’inclut qu’une seule fois
include 'entete.php';        // simple avertissement si le fichier manque
include_once 'entete.php';
```

- Pour du **code dont dépend la suite** (fonctions, classes, config) : `require_once`.
- Pour un **fragment de gabarit** optionnel : `include`.
- Toujours partir de `__DIR__` : `require __DIR__ . '/../config/db.php';`.

> Un fichier inclus **partage les variables** du contexte où il est inclus. Un fichier de config qui fait `return [...]` est plus propre : `$config = require __DIR__ . '/config.php';`.

## Namespaces

Un namespace est un **préfixe** qui évite que deux classes portant le même nom court entrent en conflit (la vôtre et celle d’une bibliothèque, par exemple).

```php
<?php
// fichier src/Model/Utilisateur.php
namespace App\Model;

class Utilisateur
{
    // ...
}
```

```php
<?php
// fichier public/index.php
namespace App;

use App\Model\Utilisateur;      // importe le nom
use App\Service\Mailer as M;    // avec alias

$u = new Utilisateur();          // grâce au "use"
$u = new \App\Model\Utilisateur(); // nom complètement qualifié (le \ initial = racine)

// Fonctions/constantes d’un autre namespace, ou natives, avec un préfixe \
$json = \json_encode($data);
```

Règles :
- `namespace` doit être la **première instruction** du fichier (après `declare`).
- La séparation se fait avec `\`.
- Un nom sans `\` initial est **relatif** au namespace courant ; avec `\`, il est **absolu**.
- Les classes natives (`PDO`, `DateTimeImmutable`, `Exception`…) sont dans le namespace **global** : dans un fichier avec `namespace`, écrire `new \PDO(...)` ou ajouter `use PDO;`.

## Composer et l’autoloading PSR-4

Écrire un `require` par classe devient vite ingérable. **Composer** génère un *autoloader* : dès qu’une classe est utilisée, le bon fichier est chargé automatiquement.

### Initialiser un projet

```bash
composer init          # crée composer.json de façon interactive
composer require monolog/monolog   # ajoute une dépendance
```

### Déclarer son propre code (norme PSR-4)

`composer.json` :

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    },
    "require": {
        "php": ">=8.4"
    }
}
```

Puis :

```bash
composer dump-autoload
```

La règle **PSR-4** fait correspondre le namespace à l’arborescence :

| Classe | Fichier |
|--------|---------|
| `App\Model\Utilisateur` | `src/Model/Utilisateur.php` |
| `App\Service\Mailer` | `src/Service/Mailer.php` |

Le nom du fichier doit correspondre **exactement** (casse comprise) au nom de la classe.

### Utiliser l’autoloader

Un seul `require` dans le point d’entrée :

```php
<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Model\Utilisateur;

$u = new Utilisateur();   // src/Model/Utilisateur.php est chargé automatiquement
```

## Structure de projet typique

```text
mon-projet/
├── composer.json
├── composer.lock          ← versions exactes installées (à committer)
├── .gitignore             ← contient /vendor et .env
├── vendor/                ← dépendances (JAMAIS committé)
│   └── autoload.php
├── src/                   ← votre code (namespace App\)
│   ├── Controller/
│   ├── Model/
│   └── Service/
├── public/                ← racine web : seul dossier exposé
│   └── index.php
├── templates/
├── tests/
└── config/
```

Seul `public/` est accessible depuis le web : le code source, la config et `vendor/` restent hors d’atteinte.

## `composer.json` vs `composer.lock`

- `composer.json` : les contraintes (`^3.2` = « 3.x, ≥ 3.2 »).
- `composer.lock` : les versions **exactes** résolues. On le committe pour que toute l’équipe et la production installent rigoureusement la même chose (`composer install`).
- `composer update` recalcule le `.lock` selon les contraintes.

---

## Liens utiles

- [Inclusion de fichiers : `include`/`require`](https://www.php.net/manual/fr/function.include.php)
- [Espaces de noms (documentation officielle)](https://www.php.net/manual/fr/language.namespaces.php)
- [Autoloading des classes](https://www.php.net/manual/fr/language.oop5.autoload.php)
- [Composer — Getting Started](https://getcomposer.org/doc/00-intro.md)
- [PSR-4 : Autoloader (PHP-FIG)](https://www.php-fig.org/psr/psr-4/)
- [Packagist — dépôt de paquets](https://packagist.org/)
