# 8. Tableaux

Les **tableaux** (ou *arrays*) en PHP sont des structures de données permettant de stocker plusieurs valeurs sous un seul nom de variable. Ils sont essentiels pour organiser, manipuler et traiter des ensembles de données de manière efficace.

## Création de tableaux

Il existe deux syntaxes principales pour créer un tableau en PHP :

- **Syntaxe classique** : `array()`  
  ```php
  $client = array('Jean', 'Dupond', 30);
  ```
- **Syntaxe raccourcie** (depuis PHP 5.4) : `[]`  
  ```php
  $client = ['Jean', 'Dupond', 30];
  ```
Les deux syntaxes sont équivalentes et créent un tableau indexé numériquement.

### Tableaux associatifs

Un tableau associatif utilise des clés personnalisées (chaînes ou entiers) au lieu d’indices numériques :
```php
$notes = ['matiere' => 'm1202', 'note1' => 12, 'note2' => 7, 'note3' => 11.5];
```
ou
```php
$notes = array('matiere' => 'm1202', 'note1' => 12, 'note2' => 7, 'note3' => 11.5);
```


### Tableaux multidimensionnels

Un tableau peut contenir d’autres tableaux, permettant de structurer des données complexes :
```php
$clients = [    'client1' => [        'prenom' => 'John',
        'nom' => 'Dupond',
        'age' => 30,
        'commandes' => ['article 1', 'article 2', 'article 3']
    ],
    'client2' => [        'prenom' => 'Paul',
        'nom' => 'Durond',
        'age' => 35
    ]
];
```


## Manipulation des tableaux

### Accès aux éléments

- **Tableau indexé** : `$client` (accède au premier élément)
- **Tableau associatif** : `$notes['matiere']` (accède à la valeur associée à la clé 'matiere')
- **Tableau multidimensionnel** : `$clients['client1']['prenom']` (accède au prénom du client1)

### Ajout et modification

- **Ajout en fin de tableau** : `$legumes[] = 'salade';` (ajoute 'salade' à la fin du tableau)
- **Ajout à un index précis** : `$legumes = 'endive';` (ajoute 'endive' à l’index 12)
- **Modification** : `$client = 'Pierre';` (remplace 'Jean' par 'Pierre')

### Suppression

- **Suppression d’un élément** : `unset($client);` (supprime le premier élément)
- **Suppression du dernier élément** : `array_pop($client);`
- **Suppression du premier élément** : `array_shift($client);`

### Fonctions principales

| Fonction           | Description                                 |
|--------------------|---------------------------------------------|
| `array_push()`     | Ajoute un ou plusieurs éléments à la fin     |
| `array_pop()`      | Supprime le dernier élément                 |
| `array_shift()`    | Supprime le premier élément                 |
| `array_unshift()`  | Ajoute un ou plusieurs éléments au début    |
| `count()`          | Retourne le nombre d’éléments               |
| `sort()`, `rsort()`| Trie le tableau par ordre croissant/décroissant |
| `array_merge()`    | Fusionne plusieurs tableaux                 |
| `in_array()`       | Vérifie si une valeur existe dans le tableau|
| `array_keys()`     | Retourne les clés du tableau                |
| `array_values()`   | Retourne les valeurs du tableau             |

## Parcours des tableaux

La boucle `foreach` est la méthode la plus courante pour parcourir un tableau :
```php
foreach ($client as $valeur) {
    echo $valeur . '<br>';
}

foreach ($notes as $cle => $valeur) {
    echo "$cle : $valeur<br>";
}
```


## Ce qu’est vraiment un « tableau » PHP

En PHP, `array` est en réalité une **carte ordonnée** (*ordered map*) : une structure qui associe des clés à des valeurs **tout en conservant l’ordre d’insertion**. Elle sert donc à la fois de liste, de dictionnaire, de pile et de file.

- Les clés sont des `int` ou des `string`. `"1"` devient `1`, `true` devient `1`, `null` devient `""`, `1.9` devient `1`.
- Ajouter avec `$t[] = ...` utilise le plus grand indice entier utilisé + 1 (même si des éléments ont été supprimés entre-temps).

```php
$t = [5 => 'a'];
$t[] = 'b';        // indice 6
unset($t[6]);
$t[] = 'c';        // indice 7, pas 6
```

## Vérifier une clé ou une valeur

```php
isset($t['cle'])              // true si la clé existe ET n’est pas null
array_key_exists('cle', $t)   // true même si la valeur est null
in_array('x', $t, true)       // 3e argument true = comparaison stricte (===), recommandé
array_search('x', $t, true)   // renvoie la clé, ou false si absent
$valeur = $t['cle'] ?? 'défaut';  // accès sûr sans avertissement
```

## Parcourir et transformer : `map`, `filter`, `reduce`

```php
$nombres = [1, 2, 3, 4, 5];

$carres  = array_map(fn($n) => $n ** 2, $nombres);       // [1, 4, 9, 16, 25]
$pairs   = array_filter($nombres, fn($n) => $n % 2 === 0); // [1 => 2, 3 => 4] (clés conservées !)
$total   = array_reduce($nombres, fn($acc, $n) => $acc + $n, 0); // 15

$pairs = array_values($pairs); // réindexer si besoin

// PHP 8.4 : trouver / tester
$premierGrand = array_find($nombres, fn($n) => $n > 3);   // 4
$tousPositifs = array_all($nombres, fn($n) => $n > 0);    // true
$ilYAPair     = array_any($nombres, fn($n) => $n % 2 === 0); // true
```

## Trier

| Fonction | Trie selon | Conserve les clés |
|----------|-----------|-------------------|
| `sort` / `rsort` | valeurs | non (réindexe) |
| `asort` / `arsort` | valeurs | oui |
| `ksort` / `krsort` | clés | oui |
| `usort` | valeurs, callback | non |
| `uasort` | valeurs, callback | oui |
| `uksort` | clés, callback | oui |

```php
usort($produits, fn($a, $b) => $a['prix'] <=> $b['prix']);        // par prix croissant
usort($produits, fn($a, $b) => $b['note'] <=> $a['note']);        // par note décroissante
```

Attention : ces fonctions modifient le tableau **en place** et renvoient `true`/`false`, pas le tableau trié.

## Fonctions très utiles

```php
array_keys($t); array_values($t);
array_column($clients, 'nom');              // extrait une colonne
array_column($clients, 'nom', 'id');        // indexée par 'id'
array_combine(['a', 'b'], [1, 2]);          // ['a' => 1, 'b' => 2]
array_slice($t, 1, 3);                      // sous-tableau (sans modifier l’original)
array_splice($t, 1, 2, ['x']);             // remplace en place
array_unique($t); array_flip($t); array_reverse($t);
array_sum($t); array_product($t);
range(1, 10); range('a', 'e');
array_fill(0, 3, null);                     // [null, null, null]
implode(', ', $t); explode(',', $chaine);
count($t); count($t, COUNT_RECURSIVE);
```

## Décomposition (*spread*) et déstructuration

```php
$a = [1, 2];
$b = [0, ...$a, 3];          // [0, 1, 2, 3]
$fusion = [...$defauts, ...$options]; // les clés string de droite écrasent celles de gauche (PHP 8.1)

[$x, $y] = [10, 20];         // $x = 10, $y = 20
['nom' => $nom] = $personne; // déstructuration associative
```

## Bonnes pratiques

- **Typage** : PHP est faiblement typé, mais il est possible de typer les paramètres de fonctions pour renforcer la sécurité du code (cf. section 7. Fonctions).
- **Performance** : Les tableaux sont très performants pour la gestion de listes de données, mais il faut éviter de les surcharger inutilement.
- **Documentation** : PHP propose une vaste bibliothèque de fonctions pour manipuler les tableaux, consultable dans la documentation officielle.

---

## Liens utiles

- [Tableaux en PHP (documentation officielle)](https://www.php.net/manual/fr/language.types.array.php)
- [Fonctions sur les tableaux (documentation officielle)](https://www.php.net/manual/en/ref.array.php)
- [Tutoriel sur les tableaux (Apprendre-PHP.com)](https://www.apprendre-php.com/tutoriels/tutoriel-7-les-tableaux-ou-arrays.html)
- [Tri des tableaux (documentation officielle)](https://www.php.net/manual/fr/array.sorting.php)
- [`array_map`](https://www.php.net/manual/fr/function.array-map.php) · [`array_filter`](https://www.php.net/manual/fr/function.array-filter.php) · [`array_reduce`](https://www.php.net/manual/fr/function.array-reduce.php)
- [Nouvelles fonctions PHP 8.4 : `array_find`, `array_any`, `array_all`](https://www.php.net/releases/8.4/fr.php)
