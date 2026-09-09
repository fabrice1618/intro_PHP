# 4. Variables et types de données

En **PHP**, une variable est un conteneur permettant de stocker des données (nombres, chaînes, tableaux, objets, etc.). Les variables sont créées lors de leur première affectation et leur type est déterminé automatiquement selon la valeur assignée (typage dynamique).

## Déclaration des variables

- **Syntaxe :**
  ```php
  $nom_variable = valeur;
  ```
- **Exemples :**
  ```php
  $nom = "Alice";      // Chaîne de caractères
  $age = 25;           // Entier
  $salaire = 3200.50;  // Nombre à virgule flottante
  $estActif = true;    // Booléen
  $notes = [12, 15, 18]; // Tableau
  ```
- **Règles de nommage :**
  - Commence par `$` suivi d’une lettre ou d’un underscore (`_`)
  - Peut contenir lettres, chiffres, underscores
  - Ne commence jamais par un chiffre
  - Sensible à la casse (`$nom` ≠ `$Nom`)

## Types de données principaux

- **Chaînes de caractères (string) :**  
  Texte entre guillemets simples ou doubles (`"Bonjour"`, `'PHP'`)
- **Nombres entiers (integer) :**  
  Valeurs numériques sans décimales (`42`, `-7`)
- **Nombres à virgule flottante (float) :**  
  Valeurs numériques avec décimales (`3.14`, `-0.5`)
- **Booléens (boolean) :**  
  `true` ou `false`
- **Tableaux (array) :**  
  Collection ordonnée de valeurs (`[1, 2, 3]`, `["a", "b", "c"]`)
- **Objets (object) :**  
  Instances de classes, pour la programmation orientée objet

## Le type `null`

`null` représente l’**absence de valeur**. Une variable vaut `null` si on lui affecte explicitement `null`, ou après `unset()`. Une variable jamais définie n’est pas `null` : y accéder déclenche un avertissement *Undefined variable*.

```php
$x = null;
var_dump(isset($x));        // false : isset() considère null comme "non défini"
var_dump($x ?? 'défaut');   // 'défaut'
```

## Catégories de types

| Catégorie | Types |
|-----------|-------|
| **Scalaires** | `bool`, `int`, `float`, `string` |
| **Composés** | `array`, `object`, `callable`, `iterable` |
| **Spéciaux** | `null`, `resource` (ancien mécanisme : fichiers, connexions…) |

## Inspecter une variable

```php
$v = [1, 2, 3];

var_dump($v);          // type + valeur + structure — l’outil de débogage n°1
print_r($v);           // affichage lisible, sans les types
var_export($v);        // affichage réutilisable comme code PHP

echo gettype($v);      // "array" (ancienne fonction)
echo get_debug_type($v); // "array" — plus précis pour les objets (PHP 8+)

var_dump(is_int(5), is_string("a"), is_array($v), is_null(null), is_bool(true));
```

## Nombres : précisions utiles

```php
echo PHP_INT_MAX;   // 9223372036854775807 sur un système 64 bits
echo PHP_INT_SIZE;  // 8 (octets)

// Au-delà de PHP_INT_MAX, PHP bascule automatiquement en float
var_dump(PHP_INT_MAX + 1); // float(9.2233720368548E+18)

// Les float sont approximatifs : ne JAMAIS tester leur égalité avec ==
var_dump(0.1 + 0.2 == 0.3);                 // false !
var_dump(abs((0.1 + 0.2) - 0.3) < PHP_FLOAT_EPSILON); // true

// Écritures numériques acceptées
$a = 1_000_000;   // séparateur de milliers (PHP 7.4+)
$b = 0x1A;        // hexadécimal
$c = 0b1010;      // binaire
$d = 1.5e3;       // notation scientifique = 1500.0
```

Pour les calculs monétaires exacts, utiliser l’extension **BCMath** (`bcadd()`, `bcmul()`…) ou travailler en centimes (entiers), jamais en `float`.

## Conversion de type (*casting*)

```php
$n = (int) "42abc";   // 42  (s’arrête au premier caractère non numérique)
$f = (float) "3.14";  // 3.14
$s = (string) 42;     // "42"
$b = (bool) 0;        // false
$arr = (array) "x";   // ["x"]

// Conversion implicite en booléen — valeurs FAUSSES :
// false, 0, 0.0, "", "0", [], null
// TOUT le reste est vrai, y compris "0.0", "false", [0], -1
```

## Superglobales

Ce sont des tableaux fournis par PHP, accessibles partout (même dans une fonction, sans `global`) :

| Superglobale | Contenu |
|--------------|---------|
| `$_GET`, `$_POST` | données envoyées par le client |
| `$_REQUEST` | fusion de `$_GET`, `$_POST`, `$_COOKIE` (à éviter) |
| `$_SESSION` | données de session côté serveur |
| `$_COOKIE` | cookies envoyés par le navigateur |
| `$_SERVER` | infos serveur et requête (`REQUEST_METHOD`, `REMOTE_ADDR`…) |
| `$_FILES` | fichiers téléversés |
| `$_ENV`, `getenv()` | variables d’environnement |
| `$GLOBALS` | toutes les variables globales |

## Typage en PHP

- **Typage dynamique :**  
  Le type d’une variable est déterminé automatiquement selon la valeur assignée. Il peut changer au cours de l’exécution.
- **Déclarations de type (optionnel) :**  
  Depuis PHP 7, il est possible de spécifier le type des arguments de fonctions, des valeurs de retour, des propriétés de classes et des constantes pour renforcer la sécurité du code.
  ```php
  function prix(float $ht, ?string $devise = null): float { /* ... */ }
  ```
  - `?string` = « chaîne **ou** `null` » (type *nullable*).
  - Types union (PHP 8) : `int|string`, `Produit|null`.
  - `mixed` = n’importe quel type ; `void` = ne retourne rien ; `never` = ne rend jamais la main.
- **`declare(strict_types=1)`** : sans cette directive, PHP convertit `"5"` → `5` à l’entrée d’une fonction typée (*mode coercitif*). Avec elle, il lève une `TypeError`. À activer systématiquement.

## Variables variables et références

- **Variable variable :**  
  Permet de créer une variable dont le nom est contenu dans une autre variable :
  ```php
  $x = 'nom';
  $$x = 'Alice'; // équivaut à $nom = 'Alice'
  ```
- **Référence :**  
  Permet de lier deux variables pour qu’elles partagent la même valeur :
  ```php
  $a = 5;
  $b = &$a; // $b référence $a
  ```

---

## Liens utiles

- [Variables et types de données (documentation officielle)](https://www.php.net/manual/fr/language.types.php)
- [Déclaration des variables en PHP (W3Schools)](https://www.w3schools.com/php/php_variables.asp)
- [Variables en PHP (GeeksforGeeks)](https://www.geeksforgeeks.org/php/php-variables/)
- [Déclarations de type en PHP (documentation officielle)](https://www.php.net/manual/fr/language.types.declarations.php)
- [Chaînes de caractères en PHP (documentation officielle)](https://www.php.net/manual/fr/language.types.string.php)
- [Manipulation de types (documentation officielle)](https://www.php.net/manual/fr/language.types.type-juggling.php)
- [Le type `null` (documentation officielle)](https://www.php.net/manual/fr/language.types.null.php)
- [Les variables prédéfinies / superglobales (documentation officielle)](https://www.php.net/manual/fr/language.variables.superglobals.php)
- [`var_dump`, `print_r`, `var_export` (documentation officielle)](https://www.php.net/manual/fr/function.var-dump.php)
