# Exercices PHP pour Débutants

Ce dossier contient une série d'exercices PHP organisés par ordre de difficulté croissante, permettant d'apprendre progressivement les concepts fondamentaux de PHP.

---

## Exercice 1 : Hello World
**Fichier :** `01-hello.php`

### Objectif
Créer votre premier programme PHP qui affiche "Hello World" dans la console.

### Concepts abordés
- Structure de base d'un fichier PHP
- Fonction `printf()` pour afficher du texte
- Caractères spéciaux comme `\n` (retour à la ligne)

### Exercice
Modifiez le programme pour qu'il affiche :
```
Bonjour le monde!
Bienvenue en PHP!
```

---

## Exercice 2 : Manipulation des Entiers
**Fichier :** `02-entier.php`

### Objectif
Découvrir les types entiers et les opérations de conversion et d'arrondi en PHP.

### Concepts abordés
- Déclaration de variables
- Conversion de types avec `(int)` et `intval()`
- Fonction `round()` pour arrondir des nombres avec différents modes
- Fonction `var_dump()` pour afficher le type et la valeur
- Constantes PHP : `PHP_INT_MAX`, `PHP_INT_SIZE`
- Limites des entiers et conversion automatique en float

### Ce que fait le programme
Le programme démontre :
1. La conversion d'un float en entier avec `(int)` et `intval()`
2. L'affichage d'une division avec `var_dump()`
3. L'arrondi d'un nombre avec `round()` et le mode `PHP_ROUND_HALF_DOWN`
4. L'affichage des constantes `PHP_INT_MAX` (valeur maximale d'un entier) et `PHP_INT_SIZE` (taille en octets)
5. Comment PHP gère les grands nombres qui dépassent la limite des entiers (conversion automatique en float)

### Exercice
1. Modifiez le mode d'arrondi pour utiliser `PHP_ROUND_HALF_UP` au lieu de `PHP_ROUND_HALF_DOWN` et observez la différence
2. Testez la conversion en entier avec un nombre négatif comme `-7.8`
3. Calculez et affichez `PHP_INT_MAX + 1` avec `var_dump()` pour voir la conversion en float

---

## Exercice 3 : Structures Conditionnelles
**Fichier :** `03-si.php`

### Objectif
Apprendre à utiliser les structures `if`, `elseif` et `else` pour créer des branchements conditionnels.

### Concepts abordés
- Structure conditionnelle `if/elseif/else`
- Comparaison de chaînes de caractères avec `==`
- Opérateur logique `||` (OU) pour tester plusieurs conditions
- Opérateur logique `&&` (ET) pour combiner plusieurs conditions
- Fonction `echo` pour afficher du texte

### Ce que fait le programme
Le programme contient trois exemples :
1. **Test de langue** : Teste si la variable `$language` vaut 'fr', 'en' ou autre chose, et affiche un message correspondant
2. **Test de valeur avec OU** : Teste si la variable `$value` vaut 2 ou 3, 5 ou 6, ou autre chose, en utilisant l'opérateur logique `||` (OU)
3. **Test combiné avec ET** : Teste si une personne peut conduire en vérifiant à la fois l'âge (>= 18) et la possession du permis (`$hasLicense`), en utilisant l'opérateur logique `&&` (ET)

### Exercice
1. Modifiez l'exemple 3 pour tester différentes valeurs de `$age` et `$hasLicense` et observez les résultats
2. Ajoutez le support de l'italien ('it') et de l'espagnol ('es') dans le premier exemple
3. Créez un quatrième exemple qui teste si une variable `$note` (entre 0 et 20) correspond à :
   - "Excellent" si la note est >= 16
   - "Bien" si la note est >= 14
   - "Assez bien" si la note est >= 12
   - "Passable" si la note est >= 10
   - "Insuffisant" sinon
4. Créez un cinquième exemple pour un système d'accès qui vérifie :
   - "Accès autorisé" si l'utilisateur a un badge ET (est admin OU a une autorisation spéciale)
   - "Accès refusé" sinon

---

## Exercice 4 : Fonctions et Booléens
**Fichiers :** `04-booleen.php` et `04-booleen_fonctions.php`

### Objectif
Comprendre les valeurs booléennes en PHP et créer des fonctions avec paramètres.

### Concepts abordés
- Type booléen (`true`/`false`)
- Valeurs considérées comme `false` : `0`, `0.0`, `""`, `"0"`, `null`, `array()`
- Valeurs considérées comme `true` : tous les nombres non nuls, chaînes non vides
- Création de fonctions avec paramètres
- Instruction `require_once()` pour inclure des fichiers
- Opérateur de négation `!` pour inverser un booléen
- Comparaison stricte (`===`) vs comparaison souple (`==`)

### Ce que fait le programme
Le programme contient deux parties :

1. **Tests de conversion en booléen** : Appelle la fonction `displayBooleanValue()` avec différentes valeurs pour observer comment PHP convertit automatiquement les valeurs en booléen :
   - `-13` → `true` (nombre non nul)
   - `0` → `false` (zéro)
   - `0.0` → `false` (zéro float)
   - `0.1` → `true` (nombre non nul)
   - `"0"` → `false` (chaîne "0")
   - `"1"` → `true` (chaîne non vide différente de "0")
   - `""` → `false` (chaîne vide)
   - `'0'` → `false` (chaîne "0")

2. **Opérateur de négation** : Utilise l'opérateur `!` pour inverser la valeur d'un booléen (`!$hasError`)

**Note importante** : À la ligne 10, il y a un bug volontaire : `displayBooleanValue($value, $value)` passe un nombre au lieu d'une langue. Cela démontre l'importance de valider les paramètres !

### Exercice
1. Corrigez le bug à la ligne 10 en passant une langue valide
2. Ajoutez des tests avec d'autres valeurs : `null`, `[]`, `[1,2,3]`, `"false"`
3. Modifiez l'exemple avec `$hasError` pour tester `$hasError = true` et observez le résultat
4. Créez une fonction `isAdult($age)` qui :
   - Prend un âge en paramètre
   - Retourne `true` si l'âge est >= 18, `false` sinon
   - Testez la fonction avec plusieurs valeurs

---

## Exercice 5 : Boucles, Tableaux et Switch
**Fichier :** `05-test-embauche.php`

### Objectif
Combiner les boucles, les tableaux et les structures `switch` pour résoudre un problème plus complexe.

### Concepts abordés
- Boucle `for` pour itérer
- Tableaux (`array()` ou `[]`)
- Opérateur modulo (`%`) pour tester la divisibilité
- Ajout d'éléments dans un tableau avec `[]`
- Structure `switch/case` avec `break`
- Fonction `count()` pour compter les éléments d'un tableau
- Concaténation de chaînes avec `.`

### Ce que fait le programme
Le programme teste la divisibilité des nombres de 1 à 42 :

1. **Boucle for** : Parcourt les nombres de 1 à 42 avec la variable `$number`
2. **Tableau $divisors** : Pour chaque nombre, crée un tableau vide puis y ajoute les diviseurs trouvés parmi 2, 3 et 5
3. **Tests de divisibilité** : Utilise l'opérateur modulo `%` pour tester si le nombre est divisible par 2, 3 ou 5
4. **Structure switch** : En fonction du nombre de diviseurs trouvés (comptés avec `count()`), construit le message `$message` approprié :
   - 1 diviseur : "Est divisible par X"
   - 2 diviseurs : "Est divisible par X et Y"
   - 3 diviseurs : "Est divisible par 2, 3 et 5"
   - 0 diviseur : message vide
5. **Affichage** : Affiche le nombre suivi du message

### Exercice
1. Exécutez le programme et observez les résultats pour les nombres 6, 15, 30
2. Modifiez le programme pour tester les nombres de 1 à 100 (au lieu de 42)
3. Ajoutez le test de divisibilité par 7 dans le tableau
4. Adaptez le switch pour gérer le cas où il y a 4 diviseurs
5. Testez avec le nombre 210 qui est divisible par 2, 3, 5 et 7

---

## Exercice 6 : Validation de Chaînes de Caractères
**Fichiers :** `06-chaine.php` et `06-chaine_fonctions.php`

### Objectif
Créer des fonctions de validation pour tester les chaînes vides et les mots de passe robustes.

### Concepts abordés
- Parcours de chaînes caractère par caractère
- Fonction `strlen()` pour obtenir la longueur
- Accès aux caractères avec `$string[$index]`
- Boucle `while` avec conditions multiples
- Validation complexe avec plusieurs critères
- Fonctions utilitaires (`isDigit()`, `isSymbol()`, `isLowerCase()`, `isUpperCase()`)
- Test de valeurs booléennes retournées par des fonctions

### Ce que fait le programme
Le programme teste deux fonctions de validation :

1. **Fonction `isEmpty()`** : Teste si une chaîne est vide
   - `''` → vide
   - `""` → vide
   - `"A"` → non vide
   - `" "` → non vide (contient un espace)

2. **Fonction `isValidPassword()`** : Valide des mots de passe selon des règles strictes
   - `" "` → invalide (espace)
   - `"Aa1-Bb2@"` → valide (8+ caractères, majuscules, minuscules, chiffres, symboles)
   - `"Aa1- Bb2"` → invalide (contient un espace)
   - `"Aa-Bb@CcTtY"` → invalide (pas de chiffre)
   - `"Aa1-Bb2"` → invalide (moins de 8 caractères)

### Règles de validation du mot de passe
Un bon mot de passe doit contenir :
- Au moins 8 caractères
- Au moins un chiffre (0-9)
- Au moins une minuscule (a-z)
- Au moins une majuscule (A-Z)
- Au moins un symbole parmi : `@`, `/`, `-`, `:`, `=`
- Aucun caractère interdit (espaces, etc.)

### Exercice
1. Exécutez le programme et vérifiez que les résultats correspondent aux attentes
2. Ajoutez un test pour le mot de passe `"Password1@"` qui devrait être valide
3. Ajoutez un test pour `"password"` qui devrait être invalide (pas de majuscule, pas de chiffre, pas de symbole)
4. Modifiez `isSymbol()` dans `06-chaine_fonctions.php` pour accepter aussi les symboles `!`, `?`, `#`
5. Testez un mot de passe avec ces nouveaux symboles

---

## Exercice 7 : Récursivité - Factorielle
**Fichier :** `07-factorielle.php`

### Objectif
Comprendre le concept de récursivité en implémentant le calcul de la factorielle.

### Concepts abordés
- Fonction récursive (fonction qui s'appelle elle-même)
- Cas de base pour arrêter la récursion
- Cas récursif pour décomposer le problème
- Définition de fonction avant son appel

### Rappel mathématique
```
factorielle(1) = 1
factorielle(2) = 2 × 1 = 2
factorielle(3) = 3 × 2 × 1 = 6
factorielle(4) = 4 × 3 × 2 × 1 = 24
factorielle(n) = n × factorielle(n-1)
```

### Ce que fait le programme
Le programme implémente et utilise une fonction récursive pour calculer la factorielle :

1. **Définition de la fonction** : La fonction `factorielle($n)` est définie avec :
   - **Cas de base** : Si `$n == 1`, retourne 1 (arrête la récursion)
   - **Cas récursif** : Sinon, retourne `$n * factorielle($n-1)` (appel récursif)

2. **Appel de la fonction** : Calcule et affiche `factorielle(5)`

3. **Déroulement de l'exécution** pour factorielle(5) :
   ```
   factorielle(5) = 5 × factorielle(4)
                  = 5 × 4 × factorielle(3)
                  = 5 × 4 × 3 × factorielle(2)
                  = 5 × 4 × 3 × 2 × factorielle(1)
                  = 5 × 4 × 3 × 2 × 1
                  = 120
   ```

### Exercice
1. Exécutez le programme et vérifiez que factorielle(5) = 120
2. Modifiez l'appel pour calculer factorielle(10) et observez le résultat (3 628 800)
3. Créez une version itérative (avec une boucle `for`) de la fonction factorielle :
   ```php
   function factorielle_iterative($n) {
     $resultat = 1;
     for ($i = 2; $i <= $n; $i++) {
       $resultat *= $i;
     }
     return $resultat;
   }
   ```
4. Comparez les deux approches (récursive vs itérative) en termes de lisibilité et de compréhension

---

## Exercice 8 : Suite de Fibonacci
**Fichier :** `08-fibonaci.php`

### Objectif
Générer la suite de Fibonacci et observer le nombre d'or.

### Concepts abordés
- Suite mathématique
- Boucle `while` avec condition
- Variables temporaires pour mémoriser les états précédents
- Formatage de l'affichage avec `printf()`
- Rapport entre deux nombres successifs tendant vers le nombre d'or (≈ 1.618)

### Rappel mathématique
La suite de Fibonacci :
```
1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89...
```
Chaque nombre est la somme des deux précédents :
```
F(n) = F(n-1) + F(n-2)
```

### Ce que fait le programme
Le programme génère la suite de Fibonacci avec un algorithme itératif utilisant 3 variables :

1. **Initialisation** :
   - `$previous2 = 1` (premier nombre - deux positions en arrière)
   - `$previous1 = 1` (deuxième nombre - une position en arrière)
   - Affiche les deux premiers nombres

2. **Algorithme à 3 variables** :
   - `$current = $previous2 + $previous1` (calcule le nombre suivant)
   - Décale les valeurs : `$previous2 = $previous1` et `$previous1 = $current`
   - Cette technique évite d'utiliser un tableau

3. **Condition d'arrêt** : La boucle `while` continue tant que `$previous2 + $previous1 <= 100`

4. **Affichage avec printf** :
   - Affiche chaque nombre sur 3 caractères (`%3d`)
   - **Calcule et affiche le ratio** `$current / $previous1` sur 8 caractères avec 5 décimales (`%8.5f`)
   - Ce ratio converge vers le nombre d'or φ ≈ 1.618033...

### Exercice
1. Exécutez le programme et observez comment le ratio dans la 2ème colonne se stabilise vers 1.618...
2. Modifiez le programme pour générer les 20 premiers nombres de Fibonacci (changez la condition du while pour compter les itérations)
3. Créez une version récursive de Fibonacci :
   ```php
   function fibonacci($n) {
     if ($n <= 2)
       return 1;
     return fibonacci($n-1) + fibonacci($n-2);
   }
   ```
   **Attention** : La version récursive est très lente pour n > 40 !
4. Calculez le 30ème nombre de Fibonacci avec les deux méthodes et comparez les performances

---

## Conseils pour progresser

1. **Commencez par le début** : Les exercices sont classés par difficulté croissante
2. **Expérimentez** : Modifiez les programmes, testez avec différentes valeurs
3. **Lisez les commentaires** : Les fichiers contiennent souvent des exemples commentés
4. **Utilisez `var_dump()`** : C'est un excellent outil pour comprendre ce qui se passe
5. **Testez vos modifications** : Exécutez le code avec `php nom_du_fichier.php`

## Ressources utiles

- [Documentation PHP officielle](https://www.php.net/manual/fr/)
- [PHP : Les bases](https://www.php.net/manual/fr/langref.php)
- [Fonctions de chaînes](https://www.php.net/manual/fr/ref.strings.php)
- [Fonctions mathématiques](https://www.php.net/manual/fr/ref.math.php)


