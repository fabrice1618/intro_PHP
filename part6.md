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
