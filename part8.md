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


## Bonnes pratiques

- **Typage** : PHP est faiblement typé, mais il est possible de typer les paramètres de fonctions pour renforcer la sécurité du code (cf. section 7. Fonctions).
- **Performance** : Les tableaux sont très performants pour la gestion de listes de données, mais il faut éviter de les surcharger inutilement.
- **Documentation** : PHP propose une vaste bibliothèque de fonctions pour manipuler les tableaux, consultable dans la documentation officielle.

---

## Liens utiles

- [Tableaux en PHP (documentation officielle)](https://www.php.net/manual/fr/language.types.array.php)
- [Fonctions sur les tableaux (documentation officielle)](https://www.php.net/manual/en/ref.array.php)
- [Tutoriel sur les tableaux (Apprendre-PHP.com)](https://www.apprendre-php.com/tutoriels/tutoriel-7-les-tableaux-ou-arrays.html)
