# 19. JSON et introduction aux API web

Le **JSON** (*JavaScript Object Notation*) est le format d’échange dominant sur le web : entre un serveur PHP et une page JavaScript, entre deux services, avec une API tierce. PHP sait le produire et le lire nativement.

## Encoder : `json_encode()`

```php
$data = [
    'id'      => 42,
    'nom'     => 'Alice',
    'actif'   => true,
    'roles'   => ['admin', 'editeur'],
    'adresse' => null,
];

echo json_encode($data);
// {"id":42,"nom":"Alice","actif":true,"roles":["admin","editeur"],"adresse":null}

echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
```

Options utiles :
- `JSON_PRETTY_PRINT` : indenté (débogage).
- `JSON_UNESCAPED_UNICODE` : garde les accents lisibles (`é` au lieu de `é`).
- `JSON_UNESCAPED_SLASHES` : n’échappe pas les `/`.
- `JSON_THROW_ON_ERROR` : lève une `JsonException` en cas de problème (recommandé).

Correspondance des types :

| PHP | JSON |
|-----|------|
| `array` séquentiel (`[0,1,2]`) | tableau `[...]` |
| `array` associatif ou `object` | objet `{...}` |
| `string` / `int` / `float` / `bool` / `null` | équivalents |
| tableau vide `[]` | `[]` (et non `{}`) |

Un objet peut contrôler sa sérialisation en implémentant `JsonSerializable` :

```php
class Produit implements JsonSerializable
{
    public function __construct(private string $nom, private int $prixCentimes) {}

    public function jsonSerialize(): array
    {
        return ['nom' => $this->nom, 'prix' => $this->prixCentimes / 100];
    }
}
```

## Décoder : `json_decode()`

```php
$json = '{"nom":"Alice","roles":["admin"]}';

$obj = json_decode($json);                       // -> stdClass : $obj->nom
$arr = json_decode($json, associative: true);    // -> tableau  : $arr['nom']

// Version robuste
try {
    $data = json_decode($json, true, flags: JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
    http_response_code(400);
    exit('JSON invalide');
}
```

## Produire une réponse API en PHP

```php
<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');

$produits = $pdo->query('SELECT id, nom, prix FROM produits')->fetchAll();

echo json_encode(
    ['data' => $produits],
    JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE
);
```

## Lire le corps d’une requête JSON entrante

`$_POST` n’est rempli **que** pour les formulaires (`application/x-www-form-urlencoded` ou `multipart/form-data`). Pour un corps JSON (`Content-Type: application/json`), lire le flux brut :

```php
$brut = file_get_contents('php://input');
$entree = json_decode($brut, true, flags: JSON_THROW_ON_ERROR);
```

## Notions d’API REST

Une API REST expose des **ressources** via des URL, manipulées avec les **verbes HTTP** :

| Verbe | Usage | Idempotent |
|-------|-------|-----------|
| `GET /articles` | lister | oui |
| `GET /articles/42` | lire un élément | oui |
| `POST /articles` | créer | non |
| `PUT /articles/42` | remplacer | oui |
| `PATCH /articles/42` | modifier partiellement | non |
| `DELETE /articles/42` | supprimer | oui |

### Codes de statut courants

| Code | Sens |
|------|------|
| `200 OK` | succès |
| `201 Created` | ressource créée |
| `204 No Content` | succès sans corps (ex. DELETE) |
| `400 Bad Request` | requête malformée |
| `401 Unauthorized` | non authentifié |
| `403 Forbidden` | authentifié mais non autorisé |
| `404 Not Found` | ressource inexistante |
| `422 Unprocessable Entity` | validation échouée |
| `500 Internal Server Error` | erreur serveur |

```php
http_response_code(201);
header('Content-Type: application/json');
echo json_encode(['id' => $nouvelId]);
```

### Routage minimal (sans framework)

```php
$methode = $_SERVER['REQUEST_METHOD'];
$chemin  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

match (true) {
    $methode === 'GET'  && $chemin === '/articles'      => listerArticles(),
    $methode === 'POST' && $chemin === '/articles'      => creerArticle(),
    $methode === 'GET'  && preg_match('#^/articles/(\d+)$#', $chemin, $m) => lireArticle((int) $m[1]),
    default => (function () {
        http_response_code(404);
        echo json_encode(['erreur' => 'Route inconnue']);
    })(),
};
```

En pratique, on utilise un routeur (Slim, Symfony Routing…) plutôt que ce `match`.

## Consommer une API externe

`file_get_contents()` suffit pour un GET simple :

```php
$contexte = stream_context_create([
    'http' => ['header' => "Accept: application/json\r\n", 'timeout' => 5],
]);
$reponse = file_get_contents('https://api.example.com/v1/taux', context: $contexte);
$data = json_decode($reponse, true, flags: JSON_THROW_ON_ERROR);
```

Pour des besoins réels (POST, en-têtes, erreurs HTTP, HTTPS fin), utiliser l’extension **cURL** ou un client comme **Guzzle** / le composant **Symfony HttpClient** (standard PSR-18).

## Sécurité

- Toujours `Content-Type: application/json` sur les réponses JSON.
- Valider les données entrantes comme celles d’un formulaire (jamais de confiance).
- Ne pas exposer de messages d’exception internes dans les réponses de production.
- Pour les API publiques : authentification par jeton (`Authorization: Bearer`), limitation de débit (*rate limiting*), CORS maîtrisé.

---

## Liens utiles

- [Fonctions JSON (documentation officielle)](https://www.php.net/manual/fr/book.json.php)
- [`json_encode`](https://www.php.net/manual/fr/function.json-encode.php) · [`json_decode`](https://www.php.net/manual/fr/function.json-decode.php)
- [`JsonSerializable`](https://www.php.net/manual/fr/class.jsonserializable.php)
- [Méthodes HTTP (MDN)](https://developer.mozilla.org/fr/docs/Web/HTTP/Methods)
- [Codes de statut HTTP (MDN)](https://developer.mozilla.org/fr/docs/Web/HTTP/Status)
- [PSR-7 (messages HTTP) et PSR-18 (client HTTP)](https://www.php-fig.org/psr/)
