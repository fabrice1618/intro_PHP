# 21. Introduction aux tests automatisés

Un **test automatisé** est du code qui vérifie que votre code fait ce qu’on attend. Il remplace le fait de « lancer la page et regarder si ça marche », et surtout il **rejoue** cette vérification à chaque modification : on détecte immédiatement une régression.

## Pourquoi tester

- **Confiance pour modifier** : on refactorise sans peur.
- **Documentation vivante** : un test montre comment utiliser une fonction.
- **Conception** : du code testable est du code découpé, avec des dépendances explicites.
- **Gain de temps** : une vérification automatique de 50 ms remplace 2 minutes de clics.

## Types de tests

| Type | Portée | Vitesse |
|------|--------|---------|
| **Unitaire** | une fonction / une classe isolée | très rapide |
| **Intégration** | plusieurs composants ensemble (ex. code + base de données) | moyen |
| **Fonctionnel / end-to-end** | l’application via HTTP, comme un utilisateur | lent |

Ce chapitre porte sur les tests **unitaires** avec **PHPUnit**, l’outil standard.

## Installation

```bash
composer require --dev phpunit/phpunit
./vendor/bin/phpunit --version
```

`--dev` : PHPUnit n’est pas installé en production.

## Rendre le code testable

Une fonction **pure** (résultat qui ne dépend que des arguments, sans effet de bord) est triviale à tester :

```php
<?php
// src/Calcul.php
declare(strict_types=1);

namespace App;

final class Calcul
{
    public static function prixTTC(float $ht, float $taux = 0.20): float
    {
        if ($ht < 0) {
            throw new \InvalidArgumentException('Le montant HT ne peut pas être négatif.');
        }
        return round($ht * (1 + $taux), 2);
    }
}
```

## Écrire un test

Convention : un fichier `tests/CalculTest.php`, une classe `CalculTest` qui étend `TestCase`, des méthodes `test...()`.

```php
<?php
declare(strict_types=1);

namespace App\Tests;

use App\Calcul;
use PHPUnit\Framework\TestCase;

final class CalculTest extends TestCase
{
    public function testPrixTtcAvecTauxParDefaut(): void
    {
        $this->assertSame(120.0, Calcul::prixTTC(100));
    }

    public function testPrixTtcArrondiAuCentime(): void
    {
        $this->assertSame(12.11, Calcul::prixTTC(10.09));
    }

    public function testMontantNegatifLeveUneException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Calcul::prixTTC(-1);
    }
}
```

### Assertions courantes

```php
$this->assertSame($attendu, $obtenu);      // === (type + valeur) : à préférer
$this->assertEquals($attendu, $obtenu);    // == (souple)
$this->assertTrue($x);   $this->assertFalse($x);
$this->assertNull($x);
$this->assertCount(3, $tableau);
$this->assertContains('php', $liste);
$this->assertStringContainsString('erreur', $message);
$this->expectException(RuntimeException::class);
```

### Jeux de données (`dataProvider`)

Tester plusieurs cas sans dupliquer :

```php
public static function casDeTva(): array
{
    return [
        'taux normal'    => [100.0, 0.20, 120.0],
        'taux réduit'    => [100.0, 0.055, 105.5],
        'montant nul'    => [0.0, 0.20, 0.0],
    ];
}

#[\PHPUnit\Framework\Attributes\DataProvider('casDeTva')]
public function testTva(float $ht, float $taux, float $attendu): void
{
    $this->assertSame($attendu, Calcul::prixTTC($ht, $taux));
}
```

## Configuration et lancement

`phpunit.xml` à la racine :

```xml
<?xml version="1.0"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         bootstrap="vendor/autoload.php"
         colors="true">
    <testsuites>
        <testsuite name="unit">
            <directory>tests</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

```bash
./vendor/bin/phpunit                 # toute la suite
./vendor/bin/phpunit --filter testTva
./vendor/bin/phpunit --testdox       # sortie lisible façon spécification
```

## Isoler les dépendances : les doublures (*mocks*)

Pour tester une classe qui dépend d’une base ou d’un service externe, on injecte une **fausse** implémentation :

```php
$depot = $this->createMock(DepotUtilisateur::class);
$depot->method('trouver')->with(42)->willReturn(new Utilisateur('Alice'));

$service = new ServiceProfil($depot);
$this->assertSame('Alice', $service->nomAffiche(42));
```

Cela suppose que `ServiceProfil` reçoive son dépôt **par le constructeur** (injection de dépendances) plutôt que de l’instancier lui-même.

## Le cycle TDD (optionnel)

*Test-Driven Development* : **Rouge** (écrire un test qui échoue) → **Vert** (le code minimal qui le fait passer) → **Refactor** (nettoyer). On construit ainsi le code par petits pas guidés par les tests.

## Aller plus loin

- **Couverture de code** : `phpunit --coverage-text` (nécessite Xdebug ou PCOV) indique les lignes non testées. Un chiffre élevé n’est pas un but en soi.
- **Analyse statique** : PHPStan / Psalm détectent des bugs sans exécuter le code — complémentaire des tests.
- **Style** : PHP_CodeSniffer (`phpcs`) / PHP-CS-Fixer pour appliquer PSR-12.
- **Intégration continue (CI)** : lancer tests + analyse à chaque `push` (GitHub Actions, GitLab CI).

---

## Liens utiles

- [PHPUnit — documentation](https://docs.phpunit.de/)
- [PHPUnit : écrire des tests](https://docs.phpunit.de/en/11.0/writing-tests-for-phpunit.html)
- [PHP The Right Way : Tests](https://phptherightway.com/#testing)
- [PHPStan](https://phpstan.org/) · [Psalm](https://psalm.dev/)
- [Article fondateur sur le TDD (Martin Fowler)](https://martinfowler.com/bliki/TestDrivenDevelopment.html)
