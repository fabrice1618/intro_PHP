# Test PHP

Ce test évalue vos connaissances sur les bases indispensables de PHP couvertes dans ce cours.

---

## Section 1 : Introduction et installation

**Question 1** - Qu'est-ce que PHP ?
- [ ] A. Un langage de programmation côté client
- [ ] B. Un langage de programmation côté serveur
- [ ] C. Un système de gestion de bases de données
- [ ] D. Un framework JavaScript

**Question 2** - Quelle commande permet de vérifier la version de PHP installée ?
- [ ] A. `php --version`
- [ ] B. `php -v`
- [ ] C. `php version`
- [ ] D. Réponses A et B sont correctes

**Question 3** - Comment lancer un serveur de développement PHP local ?
- [ ] A. `php -S localhost:8000`
- [ ] B. `php start server`
- [ ] C. `php-server`
- [ ] D. `php run`

---

## Section 2 : Syntaxe de base

**Question 4** - Quelle est la balise correcte pour commencer un script PHP ?
- [ ] A. `<php>`
- [ ] B. `<?php`
- [ ] C. `<script php>`
- [ ] D. `<%php`

**Question 5** - Comment termine-t-on une instruction en PHP ?
- [ ] A. Par un point (.)
- [ ] B. Par un point-virgule (;)
- [ ] C. Par une virgule (,)
- [ ] D. Par un retour à la ligne

**Question 6** - Comment écrire un commentaire sur une seule ligne en PHP ?
- [ ] A. `/* commentaire */`
- [ ] B. `<!-- commentaire -->`
- [ ] C. `// commentaire`
- [ ] D. `# commentaire`

---

## Section 3 : Variables et types de données

**Question 7** - Comment déclare-t-on une variable en PHP ?
- [ ] A. `var nom = "Jean";`
- [ ] B. `$nom = "Jean";`
- [ ] C. `let nom = "Jean";`
- [ ] D. `string nom = "Jean";`

**Question 8** - Quel est le type de la variable `$age = 25;` ?
- [ ] A. string
- [ ] B. integer
- [ ] C. float
- [ ] D. boolean

**Question 9** - PHP est-il un langage à typage statique ou dynamique ?
- [ ] A. Typage statique
- [ ] B. Typage dynamique
- [ ] C. Les deux
- [ ] D. Aucun des deux

---

## Section 4 : Opérateurs

**Question 10** - Quel opérateur utilise-t-on pour concaténer deux chaînes en PHP ?
- [ ] A. `+`
- [ ] B. `.`
- [ ] C. `&`
- [ ] D. `,`

**Question 11** - Quelle est la différence entre `==` et `===` ?
- [ ] A. Aucune différence
- [ ] B. `==` compare les valeurs, `===` compare les valeurs et les types
- [ ] C. `===` est plus rapide que `==`
- [ ] D. `==` est obsolète

**Question 12** - Que retourne l'expression `5 % 2` ?
- [ ] A. 0
- [ ] B. 1
- [ ] C. 2
- [ ] D. 2.5

---

## Section 5 : Structures de contrôle

**Question 13** - Quelle structure utilise-t-on pour tester plusieurs conditions successives ?
- [ ] A. `if...else`
- [ ] B. `switch...case`
- [ ] C. `while`
- [ ] D. Réponses A et B sont correctes

**Question 14** - Quelle boucle garantit qu'un bloc de code s'exécute au moins une fois ?
- [ ] A. `while`
- [ ] B. `do...while`
- [ ] C. `for`
- [ ] D. `foreach`

**Question 15** - Quelle boucle est spécifiquement conçue pour parcourir un tableau ?
- [ ] A. `for`
- [ ] B. `while`
- [ ] C. `foreach`
- [ ] D. `do...while`

---

## Section 6 : Fonctions

**Question 16** - Comment déclare-t-on une fonction en PHP ?
- [ ] A. `def maFonction() { }`
- [ ] B. `function maFonction() { }`
- [ ] C. `func maFonction() { }`
- [ ] D. `void maFonction() { }`

**Question 17** - Que fait l'instruction `return` dans une fonction ?
- [ ] A. Elle termine la fonction
- [ ] B. Elle retourne une valeur
- [ ] C. Les deux réponses A et B
- [ ] D. Elle affiche un résultat

**Question 18** - Comment accède-t-on à une variable globale dans une fonction ?
- [ ] A. Directement par son nom
- [ ] B. Avec le mot-clé `global`
- [ ] C. Avec `$GLOBALS`
- [ ] D. Réponses B et C sont correctes

---

## Section 7 : Tableaux

**Question 19** - Quelle syntaxe est correcte pour créer un tableau en PHP ?
- [ ] A. `$fruits = array("pomme", "banane");`
- [ ] B. `$fruits = ["pomme", "banane"];`
- [ ] C. Les deux sont correctes
- [ ] D. Aucune n'est correcte

**Question 20** - Comment ajoute-t-on un élément à la fin d'un tableau ?
- [ ] A. `$tableau[] = "valeur";`
- [ ] B. `array_push($tableau, "valeur");`
- [ ] C. Les deux sont correctes
- [ ] D. `$tableau.add("valeur");`

**Question 21** - Quelle fonction retourne le nombre d'éléments dans un tableau ?
- [ ] A. `length()`
- [ ] B. `size()`
- [ ] C. `count()`
- [ ] D. `sizeof()`

---

## Section 8 : Chaînes de caractères

**Question 22** - Quelle fonction retourne la longueur d'une chaîne ?
- [ ] A. `length()`
- [ ] B. `strlen()`
- [ ] C. `size()`
- [ ] D. `count()`

**Question 23** - Quelle fonction permet de mettre une chaîne en majuscules ?
- [ ] A. `uppercase()`
- [ ] B. `toUpper()`
- [ ] C. `strtoupper()`
- [ ] D. `upper()`

**Question 24** - Comment découpe-t-on une chaîne en tableau selon un séparateur ?
- [ ] A. `split()`
- [ ] B. `explode()`
- [ ] C. `str_split()`
- [ ] D. `divide()`

---

## Section 9 : Formulaires et données utilisateur

**Question 25** - Quelle superglobale permet de récupérer des données envoyées par la méthode POST ?
- [ ] A. `$_GET`
- [ ] B. `$_POST`
- [ ] C. `$_REQUEST`
- [ ] D. `$_DATA`

**Question 26** - Quelle méthode HTTP affiche les données dans l'URL ?
- [ ] A. POST
- [ ] B. GET
- [ ] C. PUT
- [ ] D. DELETE

**Question 27** - Quelle fonction utilise-t-on pour sécuriser l'affichage de données utilisateur en HTML ?
- [ ] A. `escape()`
- [ ] B. `sanitize()`
- [ ] C. `htmlspecialchars()`
- [ ] D. `clean()`

---

## Section 10 : Gestion des fichiers

**Question 28** - Quelle fonction permet d'ouvrir un fichier en PHP ?
- [ ] A. `open()`
- [ ] B. `file_open()`
- [ ] C. `fopen()`
- [ ] D. `openfile()`

**Question 29** - Quel mode d'ouverture permet de lire un fichier ?
- [ ] A. `"w"`
- [ ] B. `"r"`
- [ ] C. `"a"`
- [ ] D. `"x"`

**Question 30** - Quelle fonction permet de supprimer un fichier ?
- [ ] A. `delete()`
- [ ] B. `remove()`
- [ ] C. `unlink()`
- [ ] D. `fdelete()`

---

## Section 11 : Programmation Orientée Objet

**Question 31** - Comment crée-t-on une classe en PHP ?
- [ ] A. `class MaClasse { }`
- [ ] B. `new class MaClasse { }`
- [ ] C. `define class MaClasse { }`
- [ ] D. `object MaClasse { }`

**Question 32** - Comment crée-t-on une instance d'une classe ?
- [ ] A. `$obj = create MaClasse();`
- [ ] B. `$obj = new MaClasse();`
- [ ] C. `$obj = MaClasse();`
- [ ] D. `$obj = instance MaClasse();`

**Question 33** - Quel niveau de visibilité rend une propriété accessible uniquement dans la classe ?
- [ ] A. `public`
- [ ] B. `protected`
- [ ] C. `private`
- [ ] D. `internal`

---

## Section 12 : Bases de données

**Question 34** - Quelles sont les deux principales extensions PHP pour se connecter à MySQL ?
- [ ] A. MySQLi et PDO
- [ ] B. MySQL et PDO
- [ ] C. MySQLi et ODBC
- [ ] D. PDO et JDBC

**Question 35** - Pourquoi utilise-t-on des requêtes préparées ?
- [ ] A. Pour améliorer les performances
- [ ] B. Pour prévenir les injections SQL
- [ ] C. Pour simplifier le code
- [ ] D. Pour gérer les transactions

**Question 36** - Quelle fonction MySQLi permet d'exécuter une requête SQL ?
- [ ] A. `mysqli_query()`
- [ ] B. `mysqli_execute()`
- [ ] C. `mysqli_run()`
- [ ] D. `mysqli_sql()`

---

## Section 13 : Gestion des erreurs

**Question 37** - Quelle fonction permet d'afficher toutes les erreurs en PHP ?
- [ ] A. `error_reporting(0);`
- [ ] B. `error_reporting(E_ALL);`
- [ ] C. `show_errors(true);`
- [ ] D. `display_errors(true);`

**Question 38** - Quel bloc de code permet de capturer une exception ?
- [ ] A. `try...catch`
- [ ] B. `if...else`
- [ ] C. `error...handle`
- [ ] D. `exception...catch`

**Question 39** - Quelle fonction permet de définir un gestionnaire d'erreurs personnalisé ?
- [ ] A. `error_handler()`
- [ ] B. `set_error_handler()`
- [ ] C. `custom_error()`
- [ ] D. `define_error_handler()`

---

## Section 14 : Sécurité

**Question 40** - Quelle est la meilleure pratique pour valider les données utilisateur ?
- [ ] A. Valider uniquement côté client
- [ ] B. Valider uniquement côté serveur
- [ ] C. Valider côté client et côté serveur
- [ ] D. Ne pas valider

**Question 41** - Quelle fonction PHP permet de valider une adresse email ?
- [ ] A. `is_email()`
- [ ] B. `validate_email()`
- [ ] C. `filter_var()` avec `FILTER_VALIDATE_EMAIL`
- [ ] D. `check_email()`

**Question 42** - Quel type d'attaque vise à injecter du code SQL malveillant ?
- [ ] A. XSS
- [ ] B. CSRF
- [ ] C. SQL Injection
- [ ] D. DDoS

---

## Section 15 : Dates et heures

**Question 43** - Quelle classe est recommandée pour manipuler les dates sans risque d'effet de bord ?
- [ ] A. `DateTime`
- [ ] B. `DateTimeImmutable`
- [ ] C. `Calendar`
- [ ] D. `Timestamp`

**Question 44** - Que renvoie `time()` ?
- [ ] A. La date au format `Y-m-d`
- [ ] B. Le nombre de secondes écoulées depuis le 1er janvier 1970 UTC
- [ ] C. L'heure locale sous forme de chaîne
- [ ] D. Un objet `DateTime`

**Question 45** - Comment ajouter proprement un jour à une date ?
- [ ] A. `$date + 86400`
- [ ] B. `$date->add(new DateInterval('P1D'))`
- [ ] C. `$date->plusDay()`
- [ ] D. `date_add_day($date)`

---

## Section 16 : Sessions et cookies

**Question 46** - Où sont stockées les données d'une session PHP ?
- [ ] A. Dans le navigateur du client
- [ ] B. Côté serveur, le client ne reçoit qu'un identifiant
- [ ] C. Dans l'URL
- [ ] D. Dans la base de données obligatoirement

**Question 47** - Quelle fonction appeler juste après une connexion réussie pour prévenir la fixation de session ?
- [ ] A. `session_destroy()`
- [ ] B. `session_regenerate_id(true)`
- [ ] C. `session_reset()`
- [ ] D. `session_abort()`

**Question 48** - Quel attribut de cookie empêche son accès par JavaScript ?
- [ ] A. `secure`
- [ ] B. `samesite`
- [ ] C. `httponly`
- [ ] D. `path`

---

## Section 17 : Namespaces et autoloading

**Question 49** - À quoi sert un espace de noms (`namespace`) ?
- [ ] A. À accélérer l'exécution
- [ ] B. À éviter les collisions entre classes de même nom
- [ ] C. À chiffrer le code
- [ ] D. À définir des constantes

**Question 50** - Quel outil génère l'autoloader d'un projet PHP moderne ?
- [ ] A. npm
- [ ] B. Composer
- [ ] C. PEAR
- [ ] D. Make

**Question 51** - Avec la norme PSR-4 et le préfixe `App\` → `src/`, où se trouve la classe `App\Model\Utilisateur` ?
- [ ] A. `App/Model/Utilisateur.php`
- [ ] B. `src/Model/Utilisateur.php`
- [ ] C. `src/App/Model/Utilisateur.php`
- [ ] D. `model/utilisateur.php`

---

## Section 18 : JSON et API

**Question 52** - Quelle fonction convertit un tableau PHP en chaîne JSON ?
- [ ] A. `json_parse()`
- [ ] B. `json_encode()`
- [ ] C. `to_json()`
- [ ] D. `serialize()`

**Question 53** - Comment obtenir un tableau associatif (et non un `stdClass`) avec `json_decode()` ?
- [ ] A. `json_decode($s)`
- [ ] B. `json_decode($s, true)`
- [ ] C. `json_decode($s, ASSOC)`
- [ ] D. `json_decode_array($s)`

**Question 54** - Quel code de statut HTTP indique la création réussie d'une ressource ?
- [ ] A. 200
- [ ] B. 201
- [ ] C. 204
- [ ] D. 404

**Question 55** - Comment lire un corps de requête au format JSON (Content-Type: application/json) ?
- [ ] A. Via `$_POST`
- [ ] B. Via `$_JSON`
- [ ] C. Via `file_get_contents('php://input')`
- [ ] D. Via `$_GET`

---

## Section 19 : Expressions régulières

**Question 56** - Quelle fonction teste si une chaîne correspond à un motif ?
- [ ] A. `preg_test()`
- [ ] B. `preg_match()`
- [ ] C. `regex_match()`
- [ ] D. `str_match()`

**Question 57** - Que signifie le quantificateur `+` dans une regex ?
- [ ] A. 0 ou 1 occurrence
- [ ] B. 0 ou plus
- [ ] C. 1 ou plus
- [ ] D. Exactement 1

**Question 58** - Quelle option de motif active le mode UTF-8 (indispensable avec des accents) ?
- [ ] A. `i`
- [ ] B. `m`
- [ ] C. `s`
- [ ] D. `u`

---

## Section 20 : Tests automatisés

**Question 59** - Quel est l'outil standard de tests unitaires en PHP ?
- [ ] A. Jest
- [ ] B. PHPUnit
- [ ] C. Mocha
- [ ] D. PHPTest

**Question 60** - Quelle assertion vérifie l'égalité stricte (valeur ET type) ?
- [ ] A. `assertEquals()`
- [ ] B. `assertSame()`
- [ ] C. `assertTrue()`
- [ ] D. `assertMatch()`

---

## Corrigé

<details>
<summary>Cliquez pour afficher les réponses</summary>

1. **B** - PHP est un langage côté serveur
2. **D** - Les deux commandes fonctionnent
3. **A** - `php -S localhost:8000`
4. **B** - `<?php`
5. **B** - Point-virgule (;)
6. **C** - `//` pour un commentaire sur une ligne
7. **B** - Les variables commencent par `$`
8. **B** - integer (nombre entier)
9. **B** - PHP est à typage dynamique
10. **B** - L'opérateur `.` concatène les chaînes
11. **B** - `===` compare valeurs et types
12. **B** - Le modulo de 5 par 2 est 1
13. **D** - if...else et switch...case permettent de tester des conditions
14. **B** - do...while s'exécute au moins une fois
15. **C** - foreach est conçu pour les tableaux
16. **B** - `function nom() { }`
17. **C** - return termine et retourne une valeur
18. **D** - `global` ou `$GLOBALS`
19. **C** - Les deux syntaxes sont valides
20. **C** - Les deux méthodes fonctionnent
21. **C** - `count()` retourne le nombre d'éléments
22. **B** - `strlen()`
23. **C** - `strtoupper()`
24. **B** - `explode()`
25. **B** - `$_POST`
26. **B** - GET affiche les données dans l'URL
27. **C** - `htmlspecialchars()`
28. **C** - `fopen()`
29. **B** - Mode `"r"` pour lecture
30. **C** - `unlink()`
31. **A** - `class NomClasse { }`
32. **B** - `new NomClasse()`
33. **C** - `private`
34. **A** - MySQLi et PDO
35. **B** - Pour prévenir les injections SQL
36. **A** - `mysqli_query()`
37. **B** - `error_reporting(E_ALL)`
38. **A** - `try...catch`
39. **B** - `set_error_handler()`
40. **C** - Valider des deux côtés
41. **C** - `filter_var()` avec le filtre approprié
42. **C** - SQL Injection
43. **B** - `DateTimeImmutable` (ses méthodes renvoient un nouvel objet)
44. **B** - Horodatage Unix en secondes depuis le 1er janvier 1970 UTC
45. **B** - `$date->add(new DateInterval('P1D'))` (l'ajout de 86400 s est faux les jours de changement d'heure)
46. **B** - Côté serveur ; le client ne transporte que l'identifiant de session
47. **B** - `session_regenerate_id(true)`
48. **C** - `httponly`
49. **B** - Éviter les collisions entre classes de même nom
50. **B** - Composer
51. **B** - `src/Model/Utilisateur.php`
52. **B** - `json_encode()`
53. **B** - `json_decode($s, true)`
54. **B** - 201 Created
55. **C** - `file_get_contents('php://input')`
56. **B** - `preg_match()`
57. **C** - 1 ou plus
58. **D** - `u` (mode UTF-8)
59. **B** - PHPUnit
60. **B** - `assertSame()`

</details>
