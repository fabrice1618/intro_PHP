# 5. Opérateurs

Les **opérateurs** en PHP sont des symboles qui permettent d’effectuer des opérations sur des variables ou des valeurs. Ils sont essentiels pour manipuler les données, effectuer des calculs, comparer des valeurs ou contrôler le flux d’un programme.

## Principaux types d’opérateurs

### Opérateurs arithmétiques

Permettent de réaliser des opérations mathématiques :
| Opérateur | Signification      | Exemple      | Résultat                |
|-----------|-------------------|--------------|-------------------------|
| +         | Addition          | $a + $b      | Somme de $a et $b       |
| -         | Soustraction      | $a - $b      | Différence de $a et $b  |
| *         | Multiplication    | $a * $b      | Produit de $a et $b     |
| /         | Division          | $a / $b      | Quotient de $a et $b    |
| %         | Modulo            | $a % $b      | Reste de $a / $b        |
| **        | Exponentiation    | $a ** $b     | $a$ à la puissance $b   |

### Opérateurs d’affectation

Permettent d’assigner une valeur à une variable :
| Opérateur | Exemple      | Équivalent à      |
|-----------|--------------|-------------------|
| =         | $a = 3       |                   |
| +=        | $a += 2      | $a = $a + 2       |
| -=        | $a -= 2      | $a = $a - 2       |
| *=        | $a *= 2      | $a = $a * 2       |
| /=        | $a /= 2      | $a = $a / 2       |
| %=        | $a %= 2      | $a = $a % 2       |

### Opérateurs de comparaison

Permettent de comparer deux valeurs :
| Opérateur | Signification         | Exemple         | Résultat                |
|-----------|----------------------|-----------------|-------------------------|
| ==        | Égal à               | $a == $b        | Vrai si $a = $b         |
| ===       | Identique (valeur et type) | $a === $b | Vrai si $a = $b et même type |
| !=, <>    | Différent de         | $a != $b        | Vrai si $a ≠ $b         |
| !==       | Non identique        | $a !== $b       | Vrai si valeur ou type différent |
| <         | Inférieur à          | $a < $b         | Vrai si $a < $b         |
| >         | Supérieur à          | $a > $b         | Vrai si $a > $b         |
| <=        | Inférieur ou égal    | $a <= $b        | Vrai si $a ≤ $b         |
| >=        | Supérieur ou égal    | $a >= $b        | Vrai si $a ≥ $b         |

### Opérateurs logiques

Permettent de combiner des conditions :
| Opérateur | Signification | Exemple           | Résultat                |
|-----------|--------------|-------------------|-------------------------|
| &&, and   | ET logique   | $a && $b          | Vrai si $a et $b sont vrais |
| \|\|, or  | OU logique   | $a \|\| $b        | Vrai si $a ou $b est vrai   |
| !         | NON logique  | !$a               | Vrai si $a est faux         |

### Opérateurs de chaînes

Pour manipuler les chaînes de caractères :
| Opérateur | Signification      | Exemple         | Résultat                |
|-----------|-------------------|-----------------|-------------------------|
| .         | Concaténation     | $a . $b         | Colle $a et $b          |
| .=        | Affectation concaténée | $a .= $b   | Ajoute $b à $a          |

### Opérateur ternaire et opérateur Elvis

```php
$statut = $age >= 18 ? "majeur" : "mineur";   // ternaire complet
$nom = $entree ?: "Anonyme";                  // Elvis : $entree si "truthy", sinon "Anonyme"
```

⚠️ Depuis PHP 8, on ne peut plus empiler `a ? b : c ? d : e` sans parenthèses.

### Opérateur de coalescence des nuls `??` et `??=`

Renvoie l’opérande de gauche s’il est **défini et non `null`**, sinon celui de droite. Contrairement à `?:`, il ne déclenche **aucun avertissement** si la variable n’existe pas.

```php
$page = $_GET['page'] ?? 1;
$config['timeout'] ??= 30;   // affecte 30 seulement si la clé est absente/null
$valeur = $a ?? $b ?? $c ?? 'défaut';
```

### Opérateur nullsafe `?->` (PHP 8)

Court-circuite l’accès si l’objet est `null`, au lieu de planter :

```php
$ville = $utilisateur?->getAdresse()?->ville;  // null si un maillon est null
```

### Opérateur spaceship `<=>` (PHP 7)

Renvoie `-1`, `0` ou `1`. Idéal pour trier :

```php
usort($produits, fn($a, $b) => $a->prix <=> $b->prix);
```

### Opérateurs sur les entiers

```php
intdiv(7, 2);   // 3  (division entière)
fdiv(1, 0);     // INF au lieu d’une erreur
```

En PHP 8, `1 / 0` et `1 % 0` lèvent une `DivisionByZeroError`.

### Opérateurs binaires (bitwise)

`&` (ET), `|` (OU), `^` (OU exclusif), `~` (NON), `<<` / `>>` (décalages). Utiles pour les drapeaux de permissions :

```php
const LECTURE = 1, ECRITURE = 2;
$droits = LECTURE | ECRITURE;               // 3
$peutEcrire = (bool) ($droits & ECRITURE);  // true
```

### `instanceof`

Teste si un objet appartient à une classe (héritage et interfaces compris) :

```php
if ($e instanceof PDOException) { /* ... */ }
```

### Autres opérateurs courants

- **Incrémentation / décrémentation** : `++$a`, `$a++`, `--$a`, `$a--`
- **Opérateurs sur les tableaux** : `+`, `==`, `===`, `!=`, `<>`, `!==`
- **Opérateur de contrôle d’erreur** : `@` pour masquer les erreurs (à éviter sauf cas particulier)
- **Opérateur d’exécution** : `` `commande` `` pour exécuter une commande shell

## Priorité des opérateurs — pièges courants

```php
$a = 2 + 3 * 4;              // 14 : * avant +
$r = true and false;         // $r vaut true ! "=" s’applique avant "and"
$r = (true and false);       // $r vaut false
```

`and`/`or` ont une priorité **plus basse** que `=` : dans une expression, préférer `&&` et `||`. En cas de doute : parenthèses.

## Comparaison souple : le changement de PHP 8

Avant PHP 8, `0 == "bonjour"` valait `true` (la chaîne devenait `0`). Depuis PHP 8, c’est `false` (le nombre est converti en chaîne). Deux chaînes numériques restent comparées numériquement (`"1" == "01"` → `true`).

**Règle d’or : utiliser `===` par défaut.**

---

## Liens utiles

- [Les opérateurs en PHP (documentation officielle)](https://www.php.net/manual/fr/language.operators.php)
- [Opérateurs arithmétiques, d’affectation et de chaînes (Apprendre-PHP.com)](https://www.apprendre-php.com/tutoriels/tutoriel-8-les-operateurs.html)
- [PHP Operators (W3Schools)](https://www.w3schools.com/php/php_operators.asp)
- [Opérateurs de comparaison (documentation officielle)](https://www.php.net/manual/fr/language.operators.comparison.php)
- [Priorité des opérateurs (documentation officielle)](https://www.php.net/manual/fr/language.operators.precedence.php)
- [Comparaisons de types (tableaux comparatifs, documentation officielle)](https://www.php.net/manual/fr/types.comparisons.php)
- [Changements de PHP 8.0 : comparaison chaîne/nombre](https://www.php.net/manual/fr/migration80.incompatible.php)
