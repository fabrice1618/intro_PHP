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
- **Respect de la casse** : Les mots-clés PHP sont en minuscules (`if`, `while`, `echo`, etc.).
- **Indentation** : Utilisez 4 espaces pour l’indentation, sans tabulations, pour une meilleure lisibilité.
- **Un seul statement par ligne** : Il ne doit pas y avoir plusieurs instructions sur la même ligne.
- **Fichiers PHP purs** : Il est recommandé d’omettre la balise de fermeture `?>` dans les fichiers ne contenant que du PHP, pour éviter des erreurs d’espaces ou de retours à la ligne accidentels.

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

---

## Liens utiles

- [Syntaxe de base PHP (W3Schools)](https://www.w3schools.com/php/php_syntax.asp)
- [Guide de style PSR-2 (PHP-FIG)](https://www.php-fig.org/psr/psr-2/)
- [Syntaxe de base et structure (documentation officielle)](https://www.php.net/manual/fr/language.basic-syntax.php)
- [Syntaxe alternative des structures de contrôle (documentation officielle)](https://www.php.net/manual/fr/control-structures.alternative-syntax.php)
