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

### Autres opérateurs courants

- **Incrémentation / décrémentation** : `++$a`, `$a++`, `--$a`, `$a--`
- **Opérateurs sur les tableaux** : `+`, `==`, `===`, `!=`, `<>`, `!==`
- **Opérateur de contrôle d’erreur** : `@` pour masquer les erreurs (à éviter sauf cas particulier)
- **Opérateur d’exécution** : `` `commande` `` pour exécuter une commande shell

---

## Liens utiles

- [Les opérateurs en PHP (documentation officielle)](https://www.php.net/manual/fr/language.operators.php)
- [Opérateurs arithmétiques, d’affectation et de chaînes (Apprendre-PHP.com)](https://www.apprendre-php.com/tutoriels/tutoriel-8-les-operateurs.html)
- [PHP Operators (W3Schools)](https://www.w3schools.com/php/php_operators.asp)
- [Opérateurs de comparaison (documentation officielle)](https://www.php.net/manual/fr/language.operators.comparison.php)
