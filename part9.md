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

## Guillemets simples ou doubles ?

| | `'simple'` | `"double"` |
|--|-----------|-----------|
| Interpolation de variables | non | oui |
| Séquences d’échappement | seulement `\'` et `\\` | `\n`, `\t`, `\"`, `\$`, `\u{...}`… |
| Performance | identique en pratique | identique |

```php
$nom = "Alice";
echo 'Bonjour $nom';           // Bonjour $nom
echo "Bonjour $nom\n";         // Bonjour Alice
echo "Total : {$panier->total} €";  // accolades obligatoires pour une expression complexe
```

Convention courante : guillemets simples par défaut, doubles seulement quand on a besoin d’interpoler ou d’une séquence d’échappement.

## Heredoc et Nowdoc

Pour les longues chaînes multilignes (gabarits HTML, requêtes SQL, e-mails) :

```php
$html = <<<HTML
    <article>
        <h1>{$titre}</h1>
        <p>{$contenu}</p>
    </article>
    HTML;   // heredoc : les variables sont interpolées (comme "...")

$brut = <<<'TXT'
    Ici $rien n'est interprété.
    TXT;   // nowdoc : littéral (comme '...')
```

Depuis PHP 7.3, le marqueur de fermeture peut être indenté (l’indentation commune est retirée du résultat).

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


## Formatage : `sprintf` / `printf` / `number_format`

`printf` affiche, `sprintf` renvoie la chaîne formatée.

```php
printf("%s a %d ans\n", $nom, $age);
printf("Prix : %.2f €\n", 19.9);        // Prix : 19.90 €
printf("%05d\n", 42);                    // 00042
printf("%-10s|\n", "gauche");            // "gauche    |"
printf("%+d\n", 5);                      // +5
printf("%x / %b\n", 255, 5);             // ff / 101
printf("%'*8.2f\n", 3.5);                // "****3.50"

echo number_format(1234567.891, 2, ',', ' '); // "1 234 567,89" (format français)
```

Principaux spécificateurs : `%s` chaîne, `%d` entier, `%f` flottant, `%.2f` 2 décimales, `%x` hexa, `%b` binaire, `%%` un `%` littéral.

## Autres fonctions utiles

```php
str_starts_with("fichier.php", "fichier"); // true (PHP 8.0)
str_ends_with("fichier.php", ".php");       // true (PHP 8.0)
str_pad("7", 3, "0", STR_PAD_LEFT);         // "007"
str_repeat("=", 20);
ucfirst("bonjour");   ucwords("jean dupont");  // "Bonjour" ; "Jean Dupont"
nl2br("ligne1\nligne2");                    // insère des <br>
wordwrap($texte, 72, "\n", true);
substr_count($texte, "php");
sprintf('%1$s %2$s %1$s', 'a', 'b');        // "a b a" (arguments positionnels)
```

## UTF-8 : utiliser les fonctions `mb_`

`strlen("é")` renvoie `2` (octets), pas `1` (caractère). Pour du texte contenant des accents ou des emojis, utiliser les fonctions multi-octets :

```php
mb_strlen("héllo");            // 5
mb_strtoupper("éàù");          // "ÉÀÙ"
mb_substr("château", 0, 4);    // "chât"
mb_str_split("héllo");
mb_internal_encoding('UTF-8'); // à définir une fois au démarrage
```

PHP 8.4 ajoute `mb_trim()`, `mb_ltrim()`, `mb_rtrim()`, `mb_ucfirst()`, `mb_lcfirst()`.

## Recherche et remplacement

- **Rechercher** : `strpos()`, `str_contains()`
- **Remplacer** : `str_replace()`, `substr_replace()`
- **Extraire** : `substr()`, `mb_substr()` (pour l’UTF-8)

## Sécurité et encodage

- Utilisez `htmlspecialchars()` pour éviter les failles XSS lors de l’affichage de texte utilisateur dans une page HTML.
- Utilisez `addslashes()` ou `mysqli_real_escape_string()` pour sécuriser les entrées en base de données.

> ⚠️ **À corriger dans la pratique moderne** : `addslashes()` et `mysqli_real_escape_string()` ne sont **pas** une protection fiable contre l’injection SQL. La bonne méthode est **toujours** la requête préparée (PDO ou MySQLi), qui sépare le code SQL des données. Voir les parties *Connexion à une base de données* et *Bonnes pratiques et sécurité*. N’échappez jamais manuellement des valeurs SQL.

## Fonctions avancées

- **Découper** : `str_split()`, `chunk_split()`
- **Comparer** : `strcmp()`, `strcasecmp()`
- **Analyse avancée** : `levenshtein()`, `similar_text()` pour mesurer la similarité entre chaînes.

## Documentation

- [Chaînes de caractères - PHP.net (documentation officielle)](https://www.php.net/manual/fr/language.types.string.php)
- [Fonctions sur les chaînes - PHP.net](https://www.php.net/manual/fr/ref.strings.php)
- [Liste des fonctions de chaîne - W3Schools](https://www.w3schools.com/php/php_ref_string.asp)
- [Syntaxe des chaînes : simple, double, heredoc, nowdoc](https://www.php.net/manual/fr/language.types.string.php)
- [`sprintf` et les formats](https://www.php.net/manual/fr/function.sprintf.php)
- [Fonctions multi-octets `mbstring`](https://www.php.net/manual/fr/ref.mbstring.php)

PHP propose une très large palette de fonctions natives pour la gestion des chaînes, couvrant la quasi-totalité des besoins courants et avancés. Avant d'écrire une fonction personnalisée, il est recommandé de consulter la documentation officielle.