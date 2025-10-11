# 13. Connexion à une base de données

La **connexion à une base de données** (ex : MySQL) en PHP permet d’interagir avec les données stockées, d’exécuter des requêtes et de traiter les résultats. Les deux principales extensions utilisées sont **MySQLi** et **PDO**.

## Connexion avec MySQLi

Définissez les paramètres de connexion :

```php
$servername = "localhost";
$username = "utilisateur";
$password = "motdepasse";
$database = "nom_base";
```

Établissez la connexion :

```php
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}
echo "Connexion réussie";
```


Fermez la connexion :

```php
mysqli_close($conn);
```


## Exécution d’une requête SQL

Pour exécuter une requête (ex : sélection de données) :

```php
$sql = "SELECT * FROM utilisateurs";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo $row['nom'] . "<br>";
}
```


## Connexion avec PDO

PDO est une interface orientée objet, compatible avec plusieurs bases de données.

```php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=nom_base", "utilisateur", "motdepasse");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
```


Exécution d’une requête avec PDO :

```php
$sql = "SELECT * FROM utilisateurs";
$stmt = $pdo->query($sql);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['nom'] . "<br>";
}
```


## Bonnes pratiques

- **Sécuriser les requêtes** avec des requêtes préparées pour éviter les injections SQL.
- **Fermer la connexion** après utilisation pour libérer les ressources.
- **Gérer les erreurs** avec des messages explicites et des exceptions.

## Liens utiles

- [Documentation officielle PHP : MySQLi](https://www.php.net/manual/fr/book.mysqli.php)
- [Tutoriel Hostinger : Connexion PHP/MySQL](https://www.hostinger.fr/tutoriels/connexion-php-mysql)
- [Tutoriel Pierre Giraud : Connexion MySQLi et PDO](https://www.pierre-giraud.com/php-mysql-apprendre-coder-cours/connexion-bdd/)
