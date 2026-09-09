# 10. Gestion des formulaires et des données utilisateur

La **gestion des formulaires** en PHP permet de récupérer et traiter les données envoyées par les utilisateurs via des formulaires HTML. Les deux méthodes principales sont **GET** et **POST**, accessibles via les superglobales `$_GET` et `$_POST`.

## Création d’un formulaire HTML

Un formulaire HTML se compose de champs de saisie et d’un bouton de soumission. L’attribut `method` définit la méthode d’envoi :

```html
<form action="traitement.php" method="POST">
  Nom : <input type="text" name="nom"><br>
  Email : <input type="text" name="email"><br>
  <input type="submit" value="Envoyer">
</form>
```
- **action** : fichier PHP qui traitera les données.
- **method** : "POST" ou "GET".

## Récupération des données en PHP

### Méthode POST

Les données envoyées en POST sont accessibles via la superglobale `$_POST` :

```php
$nom = $_POST['nom'];
$email = $_POST['email'];
echo "Nom : " . $nom . "<br>";
echo "Email : " . $email;
```


### Méthode GET

Les données envoyées en GET sont accessibles via la superglobale `$_GET` :

```php
$nom = $_GET['nom'];
$email = $_GET['email'];
echo "Nom : " . $nom . "<br>";
echo "Email : " . $email;
```


- Avec GET, les données apparaissent dans l’URL :  
  `traitement.php?nom=Jean&email=jean@example.com`.

## Exemple complet (POST)

```html
<!-- formulaire.html -->
<form action="traitement.php" method="POST">
  Nom : <input type="text" name="nom"><br>
  Email : <input type="text" name="email"><br>
  <input type="submit">
</form>
```

```php
<!-- traitement.php -->
<?php
$nom = $_POST['nom'];
$email = $_POST['email'];
echo "Bienvenue " . htmlspecialchars($nom) . "<br>";
echo "Votre email : " . htmlspecialchars($email);
?>
```


## GET ou POST ?

| | GET | POST |
|--|-----|------|
| Où passent les données | dans l’URL (`?a=1&b=2`) | dans le corps de la requête |
| Visible / partageable / mis en cache | oui | non |
| Taille | limitée (~2 Ko) | grande |
| Usage | recherche, filtres, pagination (actions **sans effet de bord**) | création, modification, suppression, connexion |
| Idempotent | doit l’être | non |

Un envoi de fichier impose `method="POST"` **et** `enctype="multipart/form-data"`.

## Distinguer validation et nettoyage

- **Valider** = vérifier que la donnée respecte une règle (format d’e-mail, nombre entre 1 et 100, champ non vide). Si invalide → on refuse et on affiche un message.
- **Nettoyer / échapper** = transformer la donnée pour un contexte précis :
  - affichage HTML → `htmlspecialchars()`
  - requête SQL → **requête préparée** (jamais d’échappement manuel)
  - en-tête HTTP, JSON, shell → fonctions dédiées

On valide **à l’entrée**, on échappe **à la sortie**, selon la destination.

## Valider avec `filter_input` / `filter_var`

```php
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$age   = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 0, 'max_range' => 150],
]);
$site  = filter_input(INPUT_POST, 'site', FILTER_VALIDATE_URL);

if ($email === false || $email === null) {
    $erreurs['email'] = "Adresse e-mail invalide.";
}
```

`filter_var` renvoie la valeur filtrée, ou `false` si elle est invalide (`null` si la clé est absente avec `filter_input`).

## Champs multiples : cases à cocher et listes

```html
<input type="checkbox" name="langues[]" value="php">   PHP
<input type="checkbox" name="langues[]" value="js">    JavaScript
```

```php
$langues = $_POST['langues'] ?? [];   // tableau, éventuellement vide
foreach ($langues as $langue) { /* ... */ }
```

## Exemple complet : formulaire auto-réaffiché et sécurisé

```php
<?php
declare(strict_types=1);
session_start();

// Jeton anti-CSRF
$_SESSION['csrf'] ??= bin2hex(random_bytes(32));

$erreurs = [];
$nom = $email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Vérifier le jeton CSRF
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
        http_response_code(400);
        exit('Requête invalide.');
    }

    // 2. Récupérer et normaliser
    $nom   = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');

    // 3. Valider
    if ($nom === '') {
        $erreurs['nom'] = 'Le nom est obligatoire.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = 'E-mail invalide.';
    }

    // 4. Traiter si tout est bon, puis rediriger (pattern Post/Redirect/Get)
    if (!$erreurs) {
        // ... enregistrer en base ...
        header('Location: merci.php');
        exit;
    }
}

// Aide à l’affichage : échappe pour le HTML
function e(string $v): string {
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}
?>
<form method="POST">
    <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">

    <label>Nom :
        <input type="text" name="nom" value="<?= e($nom) ?>">
    </label>
    <?php if (isset($erreurs['nom'])): ?>
        <span class="erreur"><?= e($erreurs['nom']) ?></span>
    <?php endif; ?>

    <label>E-mail :
        <input type="email" name="email" value="<?= e($email) ?>">
    </label>
    <?php if (isset($erreurs['email'])): ?>
        <span class="erreur"><?= e($erreurs['email']) ?></span>
    <?php endif; ?>

    <button type="submit">Envoyer</button>
</form>
```

Points clés : jeton **CSRF** vérifié avec `hash_equals()` (comparaison à temps constant), valeurs **réaffichées échappées**, **redirection** après succès pour éviter le renvoi du formulaire lors d’un rafraîchissement.

## Téléverser un fichier

```php
$f = $_FILES['photo'] ?? null;

if ($f && $f['error'] === UPLOAD_ERR_OK) {
    if ($f['size'] > 2_000_000) {
        exit('Fichier trop volumineux.');
    }
    // Ne jamais se fier à l’extension : détecter le type réel
    $type = (new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);
    $extensions = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    if (!isset($extensions[$type])) {
        exit('Format non autorisé.');
    }
    $nomSur = bin2hex(random_bytes(8)) . '.' . $extensions[$type];
    move_uploaded_file($f['tmp_name'], __DIR__ . '/uploads/' . $nomSur);
}
```

Règles : stocker les fichiers **hors** de la racine web si possible, ne jamais exécuter un fichier téléversé, renommer avec un nom généré, limiter la taille côté serveur.

## Sécurité et validation

- **Validation** : Toujours vérifier et valider les données reçues (ex : vérifier que le champ n’est pas vide).
- **Sécurisation** : Utiliser `htmlspecialchars()` pour éviter les failles XSS lors de l’affichage des données utilisateur.
- **Méthode POST** : Préférée pour les données sensibles, car elles ne transitent pas dans l’URL.

## Bonnes pratiques

- Vérifier la méthode d’envoi :
  ```php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Traitement des données
  }
  ```
- Toujours filtrer et valider les entrées utilisateur avant traitement ou affichage.

## Liens utiles

- [Gestion des formulaires en PHP (documentation officielle)](https://www.php.net/manual/fr/tutorial.forms.php)
- [PHP Form Handling (W3Schools)](https://www.w3schools.com/php/php_forms.asp)
- [Envoi et récupération des données de formulaire (MDN)](https://developer.mozilla.org/fr/docs/Learn/Forms/Sending_and_retrieving_form_data)
- [`filter_input` et `filter_var` (documentation officielle)](https://www.php.net/manual/fr/function.filter-input.php)
- [Filtres de validation disponibles](https://www.php.net/manual/fr/filter.filters.validate.php)
- [Téléversement de fichiers (documentation officielle)](https://www.php.net/manual/fr/features.file-upload.php)
- [Cross-Site Request Forgery — OWASP](https://owasp.org/www-community/attacks/csrf)
