# 3. Syntaxe de base et structure d’un script PHP

Un **script PHP** est généralement contenu dans un fichier avec l’extension `.php`. Le code PHP s’insère entre les balises `<?php` et `?>`, ce qui permet de mélanger du code PHP et du HTML dans un même fichier.

## Structure d’un fichier PHP

Exemple minimal :
```php
<?php
// Votre code PHP ici
?>
```
L’extension du fichier doit être `.php` pour que le serveur interprète correctement le code.

Un fichier PHP peut contenir à la fois du HTML et du PHP :
```php
<!DOCTYPE html>
<html>
  <body>
    <h1>Ma première page PHP</h1>
    <?php
      echo "Bonjour, monde !";
    ?>
  </body>
</html>
```
Le code PHP est exécuté côté serveur, et seul le résultat (généralement du HTML) est envoyé au navigateur.

## Afficher du texte : `echo`, `print`, `printf`

```php
<?php
echo "Bonjour";               // le plus courant
echo "A", "B", "C";           // echo accepte plusieurs arguments
print "Bonjour";              // renvoie toujours 1 (utilisable dans une expression)
printf("Total : %d €\n", 42); // affichage formaté (voir la partie sur les chaînes)
$texte = sprintf("Total : %d €", 42); // comme printf mais renvoie la chaîne
```

Dans un fichier mêlant HTML et PHP, on utilise la **balise d’affichage courte** `<?= ?>`, équivalente à `<?php echo ?>` (toujours disponible depuis PHP 5.4) :

```php
<p>Bonjour <?= htmlspecialchars($nom) ?>, il est <?= date('H:i') ?>.</p>
```

## Instructions, expressions et blocs

- Une **expression** produit une valeur : `2 + 2`, `$a`, `strlen("abc")`, `$x = 5` (l’affectation vaut la valeur affectée).
- Une **instruction** est une expression suivie d’un `;`, ou une structure de contrôle.
- Un **bloc** `{ ... }` regroupe plusieurs instructions ; il ne se termine **pas** par `;`.

```php
<?php
$total = ($prixHT * 1.20);   // parenthèses facultatives ici, mais clarifient
$estCher = $total > 100;      // une comparaison est une expression booléenne
```

## Sortir du mode PHP

Tout ce qui est **hors** des balises `<?php ?>` est envoyé tel quel au navigateur. C’est souvent plus lisible que d’empiler des `echo` :

```php
<?php if ($connecte): ?>
    <a href="/deconnexion">Se déconnecter</a>
<?php else: ?>
    <a href="/connexion">Se connecter</a>
<?php endif; ?>
```

## Constantes

Une constante ne change jamais de valeur et s’écrit **sans `$`**. Par convention, son nom est en majuscules.

```php
<?php
const TVA = 0.20;                       // à la compilation, hors de tout bloc
define('CHEMIN_LOGS', '/var/log/app');  // à l’exécution, utilisable partout

echo TVA;
echo PHP_VERSION;      // constante prédéfinie
echo PHP_EOL;          // fin de ligne adaptée au système
```

`const` vs `define()` : `const` est évalué à la compilation (plus rapide, mais impossible dans une condition) ; `define()` est évalué à l’exécution (utilisable dynamiquement).

## Règles de base de la syntaxe

- **Chaque instruction PHP se termine par un point-virgule (`;`)**.
- **Commentaires** :
  - Sur une ligne : `// Ceci est un commentaire`
  - Sur plusieurs lignes :
    ```php
    /* Ceci est
       un commentaire
       sur plusieurs lignes */
    ```
  - Avec un dièse : `# Ceci est aussi un commentaire`
  - Commentaire de documentation (**PHPDoc**), exploité par les IDE et l’analyse statique :
    ```php
    /**
     * Calcule le prix TTC.
     *
     * @param float $ht Montant hors taxe
     * @return float
     */
    ```
- **Respect de la casse** : Les mots-clés PHP sont en minuscules (`if`, `while`, `echo`, etc.).
- **Indentation** : Utilisez 4 espaces pour l’indentation, sans tabulations, pour une meilleure lisibilité.
- **Un seul statement par ligne** : Il ne doit pas y avoir plusieurs instructions sur la même ligne.
- **Fichiers PHP purs** : Il est recommandé d’omettre la balise de fermeture `?>` dans les fichiers ne contenant que du PHP, pour éviter des erreurs d’espaces ou de retours à la ligne accidentels.

### Précisions sur la casse

- **Sensible à la casse** : les noms de variables (`$nom` ≠ `$Nom`) et de constantes.
- **Insensible à la casse** : les mots-clés (`IF`, `While`…), les noms de fonctions (`STRLEN("abc")` fonctionne), ainsi que `true`, `false`, `null`.
- Les noms de classes sont techniquement insensibles à la casse, mais l’autoloading PSR-4 impose de respecter la casse exacte du fichier : traitez-les comme sensibles.

### Le typage strict

Placée en **toute première instruction** du fichier, la directive `declare(strict_types=1)` empêche PHP de convertir silencieusement les types lors des appels de fonctions typées (`"5"` ne devient plus `5` automatiquement). Fortement recommandé dans tout nouveau code :

```php
<?php

declare(strict_types=1);
```

## Exemples de structures de contrôle

```php
<?php
if ($condition) {
    // instructions
} elseif ($autreCondition) {
    // instructions
} else {
    // instructions
}

for ($i = 0; $i < 10; $i++) {
    echo $i;
}

while ($condition) {
    // instructions
}
?>
```
Pour plus de détails sur la syntaxe alternative (avec `:` et `endif;`), voir la documentation officielle.

## Erreurs fréquentes du débutant

| Symptôme | Cause probable |
|----------|----------------|
| `Parse error: syntax error, unexpected ...` | point-virgule manquant, accolade ou parenthèse non fermée |
| `Warning: Undefined variable $x` | variable utilisée avant d’être définie (souvent une faute de frappe dans le nom) |
| Le code PHP s’affiche tel quel dans le navigateur | fichier servi sans passer par PHP (mauvaise extension, ou ouvert en `file://`) |
| `Cannot modify header information – headers already sent` | du texte (espace, BOM, `echo`) a été envoyé avant `header()`, `setcookie()` ou `session_start()` |
| Une page blanche | erreur fatale avec `display_errors` désactivé → consulter le fichier de log |

Conseil : pendant l’apprentissage, démarrer chaque script par
```php
<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');
```

---

## Liens utiles

- [Syntaxe de base PHP (W3Schools)](https://www.w3schools.com/php/php_syntax.asp)
- [Guide de style PSR-12 (PHP-FIG)](https://www.php-fig.org/psr/psr-12/)
- [Les constantes (documentation officielle)](https://www.php.net/manual/fr/language.constants.php)
- [`declare` et `strict_types` (documentation officielle)](https://www.php.net/manual/fr/language.types.declarations.php#language.types.declarations.strict)
- [Échappement de HTML (documentation officielle)](https://www.php.net/manual/fr/language.basic-syntax.phpmode.php)
- [Syntaxe de base et structure (documentation officielle)](https://www.php.net/manual/fr/language.basic-syntax.php)
- [Syntaxe alternative des structures de contrôle (documentation officielle)](https://www.php.net/manual/fr/control-structures.alternative-syntax.php)
