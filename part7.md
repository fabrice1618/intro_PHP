# 7. Fonctions

Les **fonctions** en PHP sont des blocs de code réutilisables qui effectuent des tâches spécifiques. Elles peuvent accepter des paramètres, exécuter des instructions, et retourner des valeurs. Cela permet de structurer le code de manière modulaire et d’éviter les répétitions.

## Déclaration d’une fonction

Une fonction est déclarée en utilisant le mot-clé `function`, suivi du nom de la fonction, des paramètres entre parenthèses, et du code à exécuter entre accolades :

```php
function addition($a, $b) {
    return $a + $b;
}
```
- **Nom de la fonction** : Doit commencer par une lettre ou un underscore (`_`), suivi de lettres, chiffres ou underscores.
- **Paramètres** : Variables définies entre parenthèses, qui reçoivent des valeurs lors de l’appel de la fonction.

## Appel d’une fonction

Une fois déclarée, une fonction peut être appelée en utilisant son nom suivi de parenthèses contenant les arguments nécessaires :

```php
$resultat = addition(5, 3);
echo $resultat; // Affiche 8
```


## Paramètres et valeurs de retour

### Paramètres

Les paramètres sont des variables définies dans la déclaration de la fonction. Ils permettent de passer des valeurs à la fonction lors de son appel :

```php
function greet($name) {
    echo "Bonjour, $name!";
}

greet("Alice"); // Affiche "Bonjour, Alice!"
```


### Valeurs de retour

Une fonction peut retourner une valeur à l’aide de l’instruction `return`. Cette valeur est alors récupérée par la variable qui appelle la fonction :

```php
function multiplier($a, $b) {
    return $a * $b;
}

$resultat = multiplier(4, 5);
echo $resultat; // Affiche 20
```


## Portée des variables

En PHP, les variables définies à l’intérieur d’une fonction sont locales à cette fonction et ne sont pas accessibles en dehors d’elle. Pour accéder à une variable globale à l’intérieur d’une fonction, il faut utiliser le mot-clé `global` ou passer la variable en paramètre :

```php
$nom = "Jean";

function afficherNom() {
    global $nom; // Accès à la variable globale
    echo $nom;
}

afficherNom(); // Affiche "Jean"
```


## Déclarations de type

Depuis PHP 7, il est possible de spécifier le type des paramètres et de la valeur de retour pour renforcer la sécurité du code :

```php
function additionner(int $a, int $b): int {
    return $a + $b;
}

echo additionner(5, 3); // Affiche 8
```


---

## Liens utiles

- [Fonctions en PHP (documentation officielle)](https://www.php.net/manual/fr/language.functions.php)
- [Création et utilisation de fonctions en PHP 8](https://www.dailycomputerscience.com/post/functions-in-php-8-how-to-create-and-use-them)
- [Fonctions PHP (W3Schools)](https://www.w3schools.com/php/php_functions.asp)
