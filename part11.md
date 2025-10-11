# 11. Gestion des fichiers

La **gestion des fichiers** en PHP permet de lire, écrire et manipuler des fichiers sur le serveur. Cela inclut l'ouverture, la lecture, l'écriture, la modification et la suppression de fichiers. PHP propose plusieurs fonctions pour ces opérations, notamment `fopen()`, `fread()`, `fwrite()`, `fclose()`, et bien d'autres.

## Ouvrir un fichier

Pour manipuler un fichier, il faut d'abord l'ouvrir avec `fopen()`. Cette fonction prend deux arguments : le chemin du fichier et le mode d'ouverture.

```php
$fichier = fopen("exemple.txt", "r");
```
- **Modes d'ouverture** :
  - `r` : Lecture seule.
  - `w` : Écriture seule, efface le contenu existant.
  - `a` : Ajout à la fin du fichier.
  - `r+`, `w+`, `a+` : Lecture et écriture.

## Lire un fichier

Une fois le fichier ouvert, on peut le lire avec `fread()` ou `fgets()`.

```php
// Lecture complète
$contenu = fread($fichier, filesize("exemple.txt"));
echo $contenu;

// Lecture ligne par ligne
while (($ligne = fgets($fichier)) !== false) {
    echo $ligne;
}
```


## Écrire dans un fichier

Pour écrire dans un fichier, utilisez `fwrite()`.

```php
$fichier = fopen("exemple.txt", "w");
fwrite($fichier, "Bonjour, monde !");
```


## Fermer un fichier

Après manipulation, il est important de fermer le fichier avec `fclose()`.

```php
fclose($fichier);
```


## Supprimer un fichier

Utilisez `unlink()` pour supprimer un fichier.

```php
unlink("exemple.txt");
```


## Copier et renommer un fichier

- **Copier** : `copy("source.txt", "destination.txt")`
- **Renommer** : `rename("ancien_nom.txt", "nouveau_nom.txt")`

## Gestion des répertoires

- **Ouvrir un répertoire** : `opendir()`
- **Lire un répertoire** : `readdir()`
- **Fermer un répertoire** : `closedir()`

## Exemple complet

```php
// Création d'un fichier
$fichier = fopen("exemple.txt", "w");
fwrite($fichier, "Bonjour, monde !");
fclose($fichier);

// Lecture du fichier
$fichier = fopen("exemple.txt", "r");
$contenu = fread($fichier, filesize("exemple.txt"));
echo $contenu;
fclose($fichier);

// Suppression du fichier
unlink("exemple.txt");
```


## Bonnes pratiques

- Toujours vérifier si le fichier existe avant de le manipuler.
- Utiliser des chemins absolus pour éviter les erreurs.
- Fermer les fichiers après utilisation pour libérer les ressources.

## Liens utiles

- [Fonction fopen() - PHP.net (documentation officielle)](https://www.php.net/manual/fr/function.fopen.php)
- [Fonctions sur les fichiers - PHP.net](https://www.php.net/manual/fr/ref.filesystem.php)
- [Manipulation de fichiers en PHP - Conseil Webmaster](https://www.conseil-webmaster.com/formation/php/10-manipuler-fichier-php.php)
- [Gestion des fichiers en PHP - Developpez.com](https://antoine-herault.developpez.com/tutoriels/php/gestionnaire/)
