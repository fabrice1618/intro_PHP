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
