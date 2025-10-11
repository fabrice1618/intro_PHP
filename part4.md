# 4. Variables et types de données

En **PHP**, une variable est un conteneur permettant de stocker des données (nombres, chaînes, tableaux, objets, etc.). Les variables sont créées lors de leur première affectation et leur type est déterminé automatiquement selon la valeur assignée (typage dynamique).

## Déclaration des variables

- **Syntaxe :**
  ```php
  $nom_variable = valeur;
  ```
- **Exemples :**
  ```php
  $nom = "Alice";      // Chaîne de caractères
  $age = 25;           // Entier
  $salaire = 3200.50;  // Nombre à virgule flottante
  $estActif = true;    // Booléen
  $notes = [12, 15, 18]; // Tableau
  ```
- **Règles de nommage :**
  - Commence par `$` suivi d’une lettre ou d’un underscore (`_`)
  - Peut contenir lettres, chiffres, underscores
  - Ne commence jamais par un chiffre
  - Sensible à la casse (`$nom` ≠ `$Nom`)

## Types de données principaux

- **Chaînes de caractères (string) :**  
  Texte entre guillemets simples ou doubles (`"Bonjour"`, `'PHP'`)
- **Nombres entiers (integer) :**  
  Valeurs numériques sans décimales (`42`, `-7`)
- **Nombres à virgule flottante (float) :**  
  Valeurs numériques avec décimales (`3.14`, `-0.5`)
- **Booléens (boolean) :**  
  `true` ou `false`
- **Tableaux (array) :**  
  Collection ordonnée de valeurs (`[1, 2, 3]`, `["a", "b", "c"]`)
- **Objets (object) :**  
  Instances de classes, pour la programmation orientée objet

## Typage en PHP

- **Typage dynamique :**  
  Le type d’une variable est déterminé automatiquement selon la valeur assignée. Il peut changer au cours de l’exécution.
- **Déclarations de type (optionnel) :**  
  Depuis PHP 7, il est possible de spécifier le type des arguments de fonctions, des valeurs de retour, des propriétés de classes et des constantes pour renforcer la sécurité du code.

## Variables variables et références

- **Variable variable :**  
  Permet de créer une variable dont le nom est contenu dans une autre variable :
  ```php
  $x = 'nom';
  $$x = 'Alice'; // équivaut à $nom = 'Alice'
  ```
- **Référence :**  
  Permet de lier deux variables pour qu’elles partagent la même valeur :
  ```php
  $a = 5;
  $b = &$a; // $b référence $a
  ```

---

## Liens utiles

- [Variables et types de données (documentation officielle)](https://www.php.net/manual/fr/language.types.php)
- [Déclaration des variables en PHP (W3Schools)](https://www.w3schools.com/php/php_variables.asp)
- [Variables en PHP (GeeksforGeeks)](https://www.geeksforgeeks.org/php/php-variables/)
- [Déclarations de type en PHP (documentation officielle)](https://www.php.net/manual/fr/language.types.declarations.php)
- [Chaînes de caractères en PHP (documentation officielle)](https://www.php.net/manual/fr/language.types.string.php)
