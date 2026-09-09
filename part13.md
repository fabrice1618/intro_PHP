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


## Connexion avec PDO (recommandé)

**PDO** (*PHP Data Objects*) est une interface orientée objet unifiée : le même code fonctionne avec MySQL, PostgreSQL, SQLite… C’est l’approche à privilégier pour un nouveau projet.

```php
$dsn = 'mysql:host=localhost;dbname=nom_base;charset=utf8mb4';
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // erreurs -> exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // fetch() -> tableau associatif
    PDO::ATTR_EMULATE_PREPARES   => false,                  // vraies requêtes préparées
];

try {
    $pdo = new PDO($dsn, 'utilisateur', 'motdepasse', $options);
} catch (PDOException $e) {
    error_log($e->getMessage());          // journaliser
    http_response_code(500);
    exit('Service indisponible.');        // message neutre pour l’utilisateur
}
```

- `charset=utf8mb4` dans le DSN : indispensable pour les accents et les emojis.
- Ne stockez **pas** les identifiants dans le code : variables d’environnement (`getenv('DB_PASSWORD')`) ou fichier de config hors du dépôt Git.

## Requêtes préparées : la seule bonne façon d’injecter des données

Une requête préparée sépare le **code SQL** (envoyé une fois) des **valeurs** (envoyées séparément). Le moteur ne peut jamais confondre une donnée avec une instruction : **c’est LA protection contre l’injection SQL**.

### Marqueurs nommés

```php
$stmt = $pdo->prepare(
    'SELECT id, nom, email FROM utilisateurs WHERE ville = :ville AND age >= :age'
);
$stmt->execute([':ville' => $ville, ':age' => $ageMini]);
$utilisateurs = $stmt->fetchAll();
```

### Marqueurs positionnels

```php
$stmt = $pdo->prepare('SELECT * FROM utilisateurs WHERE email = ?');
$stmt->execute([$email]);
$utilisateur = $stmt->fetch();   // une ligne, ou false si aucune
```

### Récupérer les résultats

```php
$stmt->fetch();                       // ligne suivante
$stmt->fetchAll();                    // toutes les lignes
$stmt->fetchColumn();                 // une seule valeur (ex. COUNT(*))
$stmt->fetchAll(PDO::FETCH_KEY_PAIR); // [id => nom]
foreach ($stmt as $ligne) { /* ... */ }
```

### INSERT / UPDATE / DELETE

```php
$stmt = $pdo->prepare('INSERT INTO utilisateurs (nom, email) VALUES (:nom, :email)');
$stmt->execute([':nom' => $nom, ':email' => $email]);
$nouvelId = (int) $pdo->lastInsertId();

$stmt = $pdo->prepare('UPDATE utilisateurs SET actif = 0 WHERE id = ?');
$stmt->execute([$id]);
echo $stmt->rowCount();   // lignes affectées
```

> ⚠️ Un marqueur représente une **valeur**, jamais un nom de table/colonne ni un mot-clé. Pour `ORDER BY $colonne`, valider `$colonne` contre une **liste blanche**.

## Transactions

Regrouper plusieurs écritures en « tout ou rien » :

```php
$pdo->beginTransaction();
try {
    $pdo->prepare('UPDATE comptes SET solde = solde - ? WHERE id = ?')->execute([$m, $src]);
    $pdo->prepare('UPDATE comptes SET solde = solde + ? WHERE id = ?')->execute([$m, $dst]);
    $pdo->commit();
} catch (Throwable $e) {
    $pdo->rollBack();
    throw $e;
}
```

## Et MySQLi ?

MySQLi ne fonctionne qu’avec MySQL/MariaDB et ses requêtes préparées sont plus verbeuses :

```php
$stmt = $mysqli->prepare('SELECT nom FROM utilisateurs WHERE id = ?');
$stmt->bind_param('i', $id);   // 'i' entier, 's' chaîne, 'd' flottant, 'b' blob
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
```


## Requête PDO sans donnée variable

Quand la requête ne contient **aucune** valeur venant de l’extérieur, `query()` (sans préparation) est acceptable :

```php
$sql = "SELECT * FROM utilisateurs";
$stmt = $pdo->query($sql);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['nom'] . "<br>";
}
```

Dès qu’une valeur variable entre en jeu (filtre, identifiant, recherche), repasser obligatoirement par `prepare()` + `execute()`.

## Bonnes pratiques

- **Sécuriser les requêtes** avec des requêtes préparées pour éviter les injections SQL.
- **Fermer la connexion** après utilisation pour libérer les ressources.
- **Gérer les erreurs** avec des messages explicites et des exceptions.

## Liens utiles

- [Documentation officielle PHP : MySQLi](https://www.php.net/manual/fr/book.mysqli.php)
- [Tutoriel Hostinger : Connexion PHP/MySQL](https://www.hostinger.fr/tutoriels/connexion-php-mysql)
- [Tutoriel Pierre Giraud : Connexion MySQLi et PDO](https://www.pierre-giraud.com/php-mysql-apprendre-coder-cours/connexion-bdd/)
- [Documentation officielle PHP : PDO](https://www.php.net/manual/fr/book.pdo.php)
- [Requêtes préparées PDO](https://www.php.net/manual/fr/pdo.prepared-statements.php)
- [Transactions PDO](https://www.php.net/manual/fr/pdo.transactions.php)
- [Choisir une API MySQL (documentation officielle)](https://www.php.net/manual/fr/mysqlinfo.api.choosing.php)
- [PHP The Right Way : Bases de données](https://phptherightway.com/#databases)
