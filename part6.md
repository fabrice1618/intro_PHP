# 6. Structures de contrôle

Les **structures de contrôle** en PHP permettent de contrôler le flux d’exécution du programme, en fonction de conditions ou de répétitions. Les principales structures sont les conditions (`if`, `else`, `elseif`, `switch`) et les boucles (`while`, `for`, `foreach`).

## Conditions

### if, else, elseif

Permettent d’exécuter des blocs de code selon qu’une condition est vraie ou fausse :

```php
if ($age < 18) {
    echo "Mineur";
} elseif ($age < 65) {
    echo "Adulte";
} else {
    echo "Senior";
}
```
- `if` : exécute le bloc si la condition est vraie.
- `elseif`/`else if` : teste une nouvelle condition si la précédente est fausse.
- `else` : exécute le bloc si aucune condition précédente n’est vraie.

### switch

Permet de comparer une variable à plusieurs valeurs possibles, plus lisible qu’une succession de `if...elseif` pour de nombreux cas :

```php
switch ($jour) {
    case "lundi":
        echo "Début de semaine";
        break;
    case "vendredi":
        echo "Bientôt le week-end";
        break;
    default:
        echo "Jour ordinaire";
        break;
}
```
- La condition du `switch` n’est évaluée qu’une seule fois, puis comparée à chaque `case`.
- Il faut utiliser `break` pour sortir du switch après un cas correspondant.

### match (PHP 8)

`match` ressemble à `switch` mais :
- compare avec `===` (strict, pas de conversion de type) ;
- **renvoie une valeur** (c’est une expression) ;
- pas besoin de `break`, pas de *fall-through* ;
- lève une `\UnhandledMatchError` si aucun cas ne correspond et qu’il n’y a pas de `default`.

```php
$libelle = match ($codeHttp) {
    200, 201, 204 => 'Succès',
    301, 302      => 'Redirection',
    404           => 'Introuvable',
    default       => 'Autre',
};

// On peut aussi tester des conditions en mettant "true" comme sujet :
$mention = match (true) {
    $note >= 16 => 'Très bien',
    $note >= 14 => 'Bien',
    $note >= 12 => 'Assez bien',
    $note >= 10 => 'Passable',
    default     => 'Insuffisant',
};
```

### switch ou match ?

| | `switch` | `match` |
|--|----------|---------|
| Comparaison | `==` (souple) | `===` (stricte) |
| Renvoie une valeur | non | oui |
| `break` obligatoire | oui | non |
| Cas non géré | ignoré | erreur (si pas de `default`) |
| Plusieurs instructions par cas | oui | non (une expression) |

## Boucles

### while

Exécute un bloc tant qu’une condition est vraie :

```php
$i = 0;
while ($i < 5) {
    echo $i;
    $i++;
}
```


### do...while

Comme `while`, mais le bloc est exécuté au moins une fois :

```php
$i = 0;
do {
    echo $i;
    $i++;
} while ($i < 5);
```


### for

Boucle avec initialisation, condition et incrémentation :

```php
for ($i = 0; $i < 5; $i++) {
    echo $i;
}
```


### foreach

Spécifique aux tableaux, permet de parcourir chaque élément :

```php
$fruits = ["pomme", "banane", "cerise"];
foreach ($fruits as $fruit) {
    echo $fruit;
}
```


### foreach avec la clé, et modification en place

```php
foreach ($notes as $matiere => $note) {
    echo "$matiere : $note\n";
}

// Pour MODIFIER le tableau pendant le parcours : référence avec &
foreach ($prix as &$p) {
    $p *= 1.20;
}
unset($p); // IMPORTANT : casser la référence après la boucle, sinon bugs sournois
```

### list() / déstructuration

```php
$points = [[1, 2], [3, 4]];
foreach ($points as [$x, $y]) {
    echo "($x, $y)\n";
}

['nom' => $nom, 'age' => $age] = $personne; // déstructuration associative
```

## Contrôler l’itération : `break` et `continue`

- `break;` sort de la boucle (ou du `switch`).
- `continue;` passe directement à l’itération suivante.
- Les deux acceptent un **niveau** pour agir sur des boucles imbriquées : `break 2;` sort de deux boucles.

```php
foreach ($lignes as $ligne) {
    foreach ($ligne as $cellule) {
        if ($cellule === null) {
            continue 2; // passe à la ligne suivante
        }
    }
}
```

## Éviter les boucles infinies

Une boucle `while (true)` doit contenir une condition de sortie (`break`) ; une boucle `for`/`while` classique doit faire **évoluer** la variable testée. Oublier `$i++` est l’erreur n°1 du débutant — le script tourne jusqu’au `max_execution_time`.

## Syntaxe alternative

PHP propose une syntaxe alternative pour les structures de contrôle, utile dans les fichiers mêlant PHP et HTML :

```php
<?php if ($condition): ?>
    <p>Condition vraie</p>
<?php else: ?>
    <p>Condition fausse</p>
<?php endif; ?>
```


---

## Liens utiles

- [Structures de contrôle (documentation officielle)](https://www.php.net/manual/fr/language.control-structures.php)
- [Syntaxe alternative (documentation officielle)](https://www.php.net/manual/fr/control-structures.alternative-syntax.php)
- [Exemples de conditions et boucles (W3Schools)](https://www.w3schools.com/php/php_if_else.asp)
- [L’expression `match` (documentation officielle)](https://www.php.net/manual/fr/control-structures.match.php)
- [`break` et `continue` (documentation officielle)](https://www.php.net/manual/fr/control-structures.break.php)
- [`foreach` (documentation officielle)](https://www.php.net/manual/fr/control-structures.foreach.php)
