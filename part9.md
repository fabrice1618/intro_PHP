# 9. Chaînes de caractères

Les **chaînes de caractères** en PHP sont des séquences de caractères utilisées pour stocker et manipuler du texte. PHP offre de nombreuses fonctions pour créer, concaténer, rechercher, remplacer et transformer les chaînes.

## Création et déclaration

- Une chaîne peut être déclarée avec des **guillemets simples** (`'...'`) ou **doubles** (`"..."`).  
- Les guillemets doubles permettent l’**interpolation** de variables :  
  ```php
  $nom = "Alice";
  echo "Bonjour $nom"; // Affiche : Bonjour Alice
  ```
- Les **heredoc** et **nowdoc** permettent de déclarer des chaînes multilignes.

## Concaténation

- L’opérateur `.` permet de **concaténer** (joindre) plusieurs chaînes :  
  ```php
  $prenom = "Alice";
  $message = "Bonjour " . $prenom . " !";
  ```


## Accès et modification

- On accède à un caractère par son index :  
  ```php
  $mot = "chat";
  echo $mot; // Affiche 'c'
  $mot = 'o'; // $mot devient "coat"
  ```
- Les indices négatifs permettent d’accéder à la fin de la chaîne (PHP 7.1+).

## Fonctions courantes de manipulation

| Fonction            | Description                                      | Exemple d’utilisation                      |
|---------------------|--------------------------------------------------|--------------------------------------------|
| `strlen()`          | Longueur de la chaîne                            | `strlen("abc")` → 3                        |
| `strtolower()`      | Met en minuscules                                | `strtolower("ABC")` → "abc"                |
| `strtoupper()`      | Met en majuscules                                | `strtoupper("abc")` → "ABC"                |
| `trim()`            | Supprime les espaces en début/fin                | `trim(" abc ")` → "abc"                    |
| `substr()`          | Extrait une sous-chaîne                          | `substr("bonjour", 0, 3)` → "bon"          |
| `str_replace()`     | Remplace une sous-chaîne                         | `str_replace("chien", "chat", "chien noir")` → "chat noir" |
| `strpos()`          | Cherche la position d’une sous-chaîne            | `strpos("bonjour", "jour")` → 3            |
| `explode()`         | Découpe une chaîne en tableau                    | `explode(",", "a,b,c")` → ["a","b","c"]    |
| `implode()`         | Fusionne un tableau en chaîne                    | `implode("-", ["a","b","c"])` → "a-b-c"    |
| `str_contains()`    | Vérifie la présence d’une sous-chaîne (PHP 8+)   | `str_contains("abc", "b")` → true          |
| `htmlspecialchars()`| Sécurise l’affichage HTML                        |                                              |
| `addslashes()`      | Ajoute des antislashs pour sécuriser             |                                              |


## Recherche et remplacement

- **Rechercher** : `strpos()`, `str_contains()`
- **Remplacer** : `str_replace()`, `substr_replace()`
- **Extraire** : `substr()`, `mb_substr()` (pour l’UTF-8)

## Sécurité et encodage

- Utilisez `htmlspecialchars()` pour éviter les failles XSS lors de l’affichage de texte utilisateur dans une page HTML.
- Utilisez `addslashes()` ou `mysqli_real_escape_string()` pour sécuriser les entrées en base de données.

## Fonctions avancées

- **Découper** : `str_split()`, `chunk_split()`
- **Comparer** : `strcmp()`, `strcasecmp()`
- **Analyse avancée** : `levenshtein()`, `similar_text()` pour mesurer la similarité entre chaînes.

## Documentation

- [Chaînes de caractères - PHP.net (documentation officielle)](https://www.php.net/manual/fr/language.types.string.php)
- [Fonctions sur les chaînes - PHP.net](https://www.php.net/manual/fr/ref.strings.php)
- [Liste des fonctions de chaîne - W3Schools](https://www.w3schools.com/php/php_ref_string.asp)

PHP propose une très large palette de fonctions natives pour la gestion des chaînes, couvrant la quasi-totalité des besoins courants et avancés. Avant d'écrire une fonction personnalisée, il est recommandé de consulter la documentation officielle.