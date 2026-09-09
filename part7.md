# 7. Fonctions

Les **fonctions** en PHP sont des blocs de code réutilisables qui effectuent des tâches spécifiques. Elles peuvent accepter des paramètres, exécuter des instructions, et retourner des valeurs. Cela permet de structurer le code de manière modulaire et d’éviter les répétitions.

## Déclaration d’une fonction

Une fonction est déclarée en utilisant le mot-clé `function`, suivi du nom de la fonction, des paramètres entre parenthèses, et du code à exécuter entre accolades :

```php
function addition($a, $b) {
    return $a + $b;
}
```
- **Nom de la fonction** : Doit commencer par une lettre ou un underscore (`_`), suivi de lettres, chiffres ou underscores.
- **Paramètres** : Variables définies entre parenthèses, qui reçoivent des valeurs lors de l’appel de la fonction.

## Appel d’une fonction

Une fois déclarée, une fonction peut être appelée en utilisant son nom suivi de parenthèses contenant les arguments nécessaires :

```php
$resultat = addition(5, 3);
echo $resultat; // Affiche 8
```


## Paramètres et valeurs de retour

### Paramètres

Les paramètres sont des variables définies dans la déclaration de la fonction. Ils permettent de passer des valeurs à la fonction lors de son appel :

```php
function greet($name) {
    echo "Bonjour, $name!";
}

greet("Alice"); // Affiche "Bonjour, Alice!"
```


### Valeurs de retour

Une fonction peut retourner une valeur à l’aide de l’instruction `return`. Cette valeur est alors récupérée par la variable qui appelle la fonction :

```php
function multiplier($a, $b) {
    return $a * $b;
}

$resultat = multiplier(4, 5);
echo $resultat; // Affiche 20
```


## Paramètres : valeurs par défaut, nommés, variadiques

### Valeurs par défaut

```php
function saluer(string $nom, string $civilite = "Bonjour"): string {
    return "$civilite $nom";
}
saluer("Alice");                 // "Bonjour Alice"
saluer("Alice", "Bonsoir");      // "Bonsoir Alice"
```

Les paramètres ayant une valeur par défaut doivent venir **après** ceux qui n’en ont pas.

### Arguments nommés (PHP 8)

On peut passer les arguments par leur nom, dans n’importe quel ordre, et ne renseigner que ceux qui nous intéressent :

```php
htmlspecialchars($texte, double_encode: false);

function creerFenetre(int $largeur = 800, int $hauteur = 600, bool $pleinEcran = false) { /* ... */ }
creerFenetre(pleinEcran: true);   // largeur et hauteur gardent leur valeur par défaut
```

### Nombre variable d’arguments (variadique `...`)

```php
function somme(int ...$nombres): int {
    return array_sum($nombres);   // $nombres est un tableau
}
somme(1, 2, 3, 4);   // 10

// L’opérateur de décomposition (spread) fait l’inverse :
$valeurs = [1, 2, 3];
somme(...$valeurs);  // 6
```

## Passage par valeur ou par référence

Par défaut, PHP passe les arguments **par valeur** (la fonction reçoit une copie). Le préfixe `&` passe par référence (la fonction peut modifier la variable d’origine) :

```php
function incrementer(int &$n): void {
    $n++;
}
$compteur = 5;
incrementer($compteur);   // $compteur vaut maintenant 6
```

À utiliser avec parcimonie : une fonction qui **retourne** une valeur est plus lisible qu’une fonction à effet de bord.

## Portée des variables

En PHP, les variables définies à l’intérieur d’une fonction sont locales à cette fonction et ne sont pas accessibles en dehors d’elle. Pour accéder à une variable globale à l’intérieur d’une fonction, il faut utiliser le mot-clé `global` ou passer la variable en paramètre :

```php
$nom = "Jean";

function afficherNom() {
    global $nom; // Accès à la variable globale
    echo $nom;
}

afficherNom(); // Affiche "Jean"
```

> **Bonne pratique** : éviter `global`. Passer explicitement les données en paramètre et récupérer un résultat via `return`. Le code devient testable et prévisible.

### Variables statiques locales

Une variable `static` conserve sa valeur d’un appel à l’autre, tout en restant locale :

```php
function compteur(): int {
    static $n = 0;
    return ++$n;
}
compteur(); // 1
compteur(); // 2
```

## Fonctions anonymes, closures et fonctions fléchées

```php
// Fonction anonyme classique — "use" importe les variables du contexte
$tva = 0.20;
$ttc = function (float $ht) use ($tva): float {
    return $ht * (1 + $tva);
};

// Fonction fléchée (PHP 7.4) : capture automatiquement le contexte, une seule expression
$ttc = fn(float $ht): float => $ht * (1 + $tva);

// Usage typique avec les fonctions de tableau
$noms = array_map(fn($u) => $u['nom'], $utilisateurs);
$majeurs = array_filter($utilisateurs, fn($u) => $u['age'] >= 18);
```

### Syntaxe « first-class callable » (PHP 8.1)

Permet de référencer une fonction existante comme valeur :

```php
$fn = strlen(...);          // équivaut à fn($s) => strlen($s)
$longueurs = array_map(strtoupper(...), $mots);
```

## Fonctions natives

PHP fournit des **milliers de fonctions** intégrées (chaînes, tableaux, maths, dates, fichiers, JSON…). Avant d’écrire la vôtre, cherchez dans la [référence des fonctions](https://www.php.net/manual/fr/funcref.php). Une fonction inconnue se documente en une ligne : `php --rf array_map`.

## Déclarations de type

Depuis PHP 7, il est possible de spécifier le type des paramètres et de la valeur de retour pour renforcer la sécurité du code :

```php
function additionner(int $a, int $b): int {
    return $a + $b;
}

echo additionner(5, 3); // Affiche 8
```

Types de retour particuliers :
- `: void` — la fonction ne retourne rien d’exploitable.
- `: ?int` — un entier **ou** `null`.
- `: never` (PHP 8.1) — la fonction ne rend jamais la main (elle lève une exception ou appelle `exit`).
- `: static` / `: self` — utile en POO pour le chaînage.

Sans `declare(strict_types=1)`, `additionner("5", "3")` fonctionne (conversion automatique). Avec, il lève une `TypeError`.

## Récursivité

Une fonction peut s’appeler elle-même. Il faut **toujours** un cas d’arrêt (*cas de base*), sinon on atteint la limite de pile (`Fatal error: Maximum function nesting`). Voir l’exercice `07-factorielle.php`. Pour des données très profondes, une version itérative (avec une boucle et éventuellement une pile explicite) est souvent préférable.

---

## Liens utiles

- [Fonctions en PHP (documentation officielle)](https://www.php.net/manual/fr/language.functions.php)
- [Création et utilisation de fonctions en PHP 8](https://www.dailycomputerscience.com/post/functions-in-php-8-how-to-create-and-use-them)
- [Fonctions PHP (W3Schools)](https://www.w3schools.com/php/php_functions.asp)
- [Arguments de fonction : défaut, nommés, variadiques (documentation officielle)](https://www.php.net/manual/fr/functions.arguments.php)
- [Fonctions anonymes et closures (documentation officielle)](https://www.php.net/manual/fr/functions.anonymous.php)
- [Fonctions fléchées (documentation officielle)](https://www.php.net/manual/fr/functions.arrow.php)
- [Portée des variables (documentation officielle)](https://www.php.net/manual/fr/language.variables.scope.php)
