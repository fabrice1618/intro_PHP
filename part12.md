# 12. Introduction à la programmation orientée objet (POO)

La **programmation orientée objet (POO)** en PHP est un paradigme qui organise le code autour d’**objets** issus de **classes**, permettant une structure modulaire, réutilisable et facile à maintenir.

## Concepts de base

- **Classe** : Modèle ou plan définissant les propriétés (variables) et méthodes (fonctions) communes à tous les objets créés à partir de cette classe.
- **Objet** : Instance concrète d’une classe, possédant ses propres valeurs pour les propriétés et pouvant exécuter les méthodes définies dans la classe.
- **Propriété** : Variable associée à un objet, représentant ses données ou son état.
- **Méthode** : Fonction associée à un objet, définissant ses comportements ou actions.

## Exemple simple

```php
class Voiture {
    public $marque;
    public $couleur;

    public function demarrer() {
        echo "La voiture démarre";
    }
}

// Création d’un objet (instance)
$maVoiture = new Voiture();
$maVoiture->marque = "Renault";
$maVoiture->couleur = "rouge";
$maVoiture->demarrer(); // Affiche : La voiture démarre
```


## Le constructeur et `$this`

Le constructeur `__construct()` est appelé automatiquement à la création de l’objet. `$this` désigne l’objet courant à l’intérieur des méthodes.

```php
class CompteBancaire {
    private float $solde;

    public function __construct(float $soldeInitial = 0.0) {
        $this->solde = $soldeInitial;
    }

    public function deposer(float $montant): void {
        if ($montant <= 0) {
            throw new InvalidArgumentException('Montant invalide');
        }
        $this->solde += $montant;
    }

    public function getSolde(): float {
        return $this->solde;
    }
}

$compte = new CompteBancaire(100);
$compte->deposer(50);
echo $compte->getSolde(); // 150
```

### Promotion des propriétés du constructeur (PHP 8.0)

Raccourci qui déclare **et** initialise les propriétés directement dans la signature du constructeur :

```php
class CompteBancaire {
    public function __construct(
        private float $solde = 0.0,
        private readonly string $titulaire = 'inconnu',
    ) {}
}
```

`readonly` (PHP 8.1) : la propriété ne peut être écrite qu’une fois, depuis l’intérieur de la classe. Idéale pour les *objets valeurs* immuables.

## Visibilité

| Mot-clé | Accessible depuis… |
|---------|--------------------|
| `public` | partout |
| `protected` | la classe et ses sous-classes |
| `private` | la classe elle-même uniquement |

Principe d’**encapsulation** : propriétés `private`, accès contrôlé par des méthodes. On ne rend `public` que ce qui fait partie du « contrat » de la classe.

> **PHP 8.4** : la *visibilité asymétrique* permet `public private(set) string $version` — lecture publique, écriture privée — sans écrire de *getter*.

## Propriétés et méthodes statiques

Appartiennent à la **classe**, pas à une instance. On y accède avec `::`.

```php
class Compteur {
    public static int $total = 0;

    public static function incrementer(): void {
        self::$total++;
    }
}
Compteur::incrementer();
echo Compteur::$total; // 1
```

## Constantes de classe

```php
class Http {
    const OK = 200;
    public const NOT_FOUND = 404;   // peut être typée depuis PHP 8.3
}
echo Http::OK;
```

## `self`, `static`, `parent`

- `self::` — la classe où le code est écrit.
- `static::` — la classe réellement appelée (*late static binding*), utile pour les fabriques.
- `parent::` — la classe parente (souvent `parent::__construct(...)`).

## Principes fondamentaux de la POO

- **Encapsulation** : Les propriétés et méthodes sont regroupées dans une même entité (l’objet), ce qui protège les données et limite les accès directs grâce à des niveaux de visibilité (`public`, `private`, `protected`).
- **Héritage** : Une classe peut hériter des propriétés et méthodes d’une autre classe (classe parente), facilitant la réutilisation et l’extension du code.
    ```php
    class Vehicule {
        public $marque;
    }

    class Voiture extends Vehicule {
        public $couleur;
    }
    ```
- **Abstraction** : Permet de définir des classes ou méthodes abstraites qui servent de modèles sans être instanciées directement.
- **Polymorphisme** : Capacité à manipuler des objets de différentes classes dérivées via une interface ou une classe parente commune.

## Classes abstraites

Une classe `abstract` ne peut pas être instanciée. Elle sert de base commune et peut imposer des méthodes (`abstract`) que les enfants doivent implémenter.

```php
abstract class Forme {
    abstract public function aire(): float;

    public function decrire(): string {
        return sprintf('%s, aire = %.2f', static::class, $this->aire());
    }
}

class Cercle extends Forme {
    public function __construct(private float $rayon) {}
    public function aire(): float {
        return M_PI * $this->rayon ** 2;
    }
}
```

## Interfaces

Une interface définit un **contrat** (des méthodes publiques) sans code. Une classe peut en implémenter plusieurs.

```php
interface Exportable {
    public function versTableau(): array;
}

class Facture implements Exportable {
    public function versTableau(): array { /* ... */ }
}

function exporter(Exportable $e): string {
    return json_encode($e->versTableau());
}
```

On programme « **vers une interface** », pas vers une implémentation : cela facilite les tests et les remplacements.

## Traits

Un trait est un bloc de méthodes réutilisable, « collé » dans plusieurs classes (PHP n’a pas d’héritage multiple).

```php
trait Horodatage {
    public ?DateTimeImmutable $creeLe = null;
    public function marquerCreation(): void {
        $this->creeLe = new DateTimeImmutable();
    }
}

class Article {
    use Horodatage;
}
```

## Énumérations (`enum`, PHP 8.1)

Pour un ensemble fermé de valeurs (voir aussi la partie *Structures de contrôle* pour `match`).

```php
enum Statut: string {
    case Brouillon = 'brouillon';
    case Publie    = 'publie';
    case Archive   = 'archive';

    public function libelle(): string {
        return match ($this) {
            self::Brouillon => 'Brouillon',
            self::Publie    => 'Publié',
            self::Archive   => 'Archivé',
        };
    }
}

Statut::Publie->value;        // 'publie'
Statut::from('archive');      // Statut::Archive (exception si inconnu)
Statut::tryFrom('xxx');       // null
Statut::cases();              // toutes les valeurs
```

## Méthodes magiques utiles

- `__construct` / `__destruct`
- `__toString()` — conversion de l’objet en chaîne (`echo $objet`)
- `__get` / `__set` / `__isset` — accès à des propriétés dynamiques
- `__invoke()` — rendre l’objet appelable comme une fonction
- `__clone()` — personnaliser la copie (`$b = clone $a`)

## `final` et bonnes pratiques

- `final class` / `final function` : interdit l’extension / la redéfinition.
- Préférer la **composition** (l’objet contient d’autres objets) à l’héritage profond.
- Une classe = une responsabilité. Injecter les dépendances par le constructeur.
- Un fichier par classe, nommé comme la classe (voir *Namespaces et autoloading*).

## Avantages de la POO

- **Modularité** : Le code est organisé en entités indépendantes et réutilisables.
- **Maintenance facilitée** : Les modifications sont localisées et n’impactent pas l’ensemble du code.
- **Réutilisation** : Les classes et objets peuvent être réutilisés dans différents projets ou contextes.

## Liens utiles

- [Documentation officielle PHP : Programmation orientée objet](https://www.php.net/manual/fr/language.oop5.php)
- [Tutoriel complet sur la POO en PHP](https://nouvelle-techno.fr/articles/maitriser-la-poo-en-php)
- [Introduction à la POO en PHP](https://www.pierre-giraud.com/php-mysql-apprendre-coder-cours/programmation-orientee-objet-presentation/)
- [Le constructeur et la promotion des propriétés](https://www.php.net/manual/fr/language.oop5.decon.php)
- [Interfaces](https://www.php.net/manual/fr/language.oop5.interfaces.php) · [Classes abstraites](https://www.php.net/manual/fr/language.oop5.abstract.php) · [Traits](https://www.php.net/manual/fr/language.oop5.traits.php)
- [Énumérations](https://www.php.net/manual/fr/language.enumerations.php)
- [Propriétés `readonly` et hooks (PHP 8.1 / 8.4)](https://www.php.net/manual/fr/language.oop5.property-hooks.php)
- [Méthodes magiques](https://www.php.net/manual/fr/language.oop5.magic.php)
