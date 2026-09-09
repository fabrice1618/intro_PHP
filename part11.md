# 11. Gestion des fichiers

La **gestion des fichiers** en PHP permet de lire, écrire et manipuler des fichiers sur le serveur. Cela inclut l'ouverture, la lecture, l'écriture, la modification et la suppression de fichiers. PHP propose plusieurs fonctions pour ces opérations, notamment `fopen()`, `fread()`, `fwrite()`, `fclose()`, et bien d'autres.

## La méthode simple : `file_get_contents` / `file_put_contents`

Pour la majorité des besoins, pas besoin de `fopen`/`fread`/`fclose`. Ces deux fonctions ouvrent, lisent ou écrivent, puis ferment le fichier en une seule opération :

```php
// Lire tout le fichier dans une chaîne
$contenu = file_get_contents(__DIR__ . '/data.txt');

// Écrire (écrase le contenu). Renvoie le nombre d’octets écrits, ou false.
file_put_contents(__DIR__ . '/data.txt', "Bonjour\n");

// Ajouter à la fin, avec verrou pour éviter les écritures concurrentes
file_put_contents(__DIR__ . '/journal.log', "$message\n", FILE_APPEND | LOCK_EX);

// Lire ligne par ligne dans un tableau
$lignes = file(__DIR__ . '/liste.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
```

`fopen` reste utile pour les **gros fichiers** (traitement en flux, sans tout charger en mémoire) ou les accès en lecture/écriture entrelacés.

## Chemins de fichiers

- `__DIR__` : dossier du fichier courant. `__FILE__` : chemin complet du fichier.
- Toujours construire les chemins à partir de `__DIR__` plutôt qu’en relatif : le *répertoire de travail* dépend de la façon dont le script est lancé.
- `realpath()`, `dirname()`, `basename()`, `pathinfo()` pour manipuler les chemins.

> ⚠️ **Traversée de répertoire** : ne jamais concaténer une entrée utilisateur dans un chemin (`"/data/" . $_GET['fichier']` permet `../../etc/passwd`). Valider avec une liste blanche, ou vérifier que `realpath()` du résultat commence bien par le dossier autorisé.

## JSON dans un fichier

```php
// Écrire
file_put_contents($f, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Lire
$data = json_decode(file_get_contents($f), true, flags: JSON_THROW_ON_ERROR);
```

## CSV

```php
$h = fopen('export.csv', 'w');
fputcsv($h, ['id', 'nom', 'email']);
fputcsv($h, [1, 'Alice', 'alice@example.com']);
fclose($h);

$h = fopen('import.csv', 'r');
$entetes = fgetcsv($h);
while (($ligne = fgetcsv($h)) !== false) {
    $enreg = array_combine($entetes, $ligne);
}
fclose($h);
```

## Vérifier avant d’agir

```php
file_exists($p)   // fichier OU dossier
is_file($p)       // fichier régulier
is_dir($p)
is_readable($p) / is_writable($p)
filesize($p) / filemtime($p) / mime_content_type($p)
```

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

Plus simple aujourd’hui :

```php
foreach (scandir(__DIR__) as $entree) {
    if ($entree === '.' || $entree === '..') continue;
    // ...
}

// Motif glob
foreach (glob(__DIR__ . '/*.php') as $fichier) { /* ... */ }

// Parcours récursif avec la SPL
$it = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator(__DIR__, FilesystemIterator::SKIP_DOTS)
);
foreach ($it as $fichier) {
    if ($fichier->getExtension() === 'php') {
        echo $fichier->getPathname(), "\n";
    }
}

mkdir(__DIR__ . '/cache', 0755, recursive: true);
```

## Gérer les erreurs d’accès

En cas d’échec, ces fonctions renvoient `false` **et** émettent un *warning*. Deux approches :

```php
// 1. Vérifier la valeur de retour
$contenu = @file_get_contents($url);
if ($contenu === false) {
    // gérer l’erreur
}

// 2. Transformer les warnings en exceptions (recommandé) — voir la partie "Gestion des erreurs"
```

## Envoyer un fichier au navigateur (téléchargement)

```php
$chemin = __DIR__ . '/factures/facture-42.pdf';
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="facture-42.pdf"');
header('Content-Length: ' . filesize($chemin));
readfile($chemin);
exit;
```

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
- [`file_get_contents`](https://www.php.net/manual/fr/function.file-get-contents.php) · [`file_put_contents`](https://www.php.net/manual/fr/function.file-put-contents.php)
- [Fonctions sur les systèmes de fichiers](https://www.php.net/manual/fr/ref.filesystem.php)
- [SplFileObject et les itérateurs de répertoire (SPL)](https://www.php.net/manual/fr/class.splfileobject.php)
