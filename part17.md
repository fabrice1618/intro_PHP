# 17. Sessions, cookies et authentification

HTTP est un protocole **sans état** : chaque requête est indépendante, le serveur ne « se souvient » de rien. Les **cookies** et les **sessions** servent à conserver une information d’une requête à l’autre (utilisateur connecté, panier, préférences).

## Cookies

Un cookie est une petite donnée envoyée par le serveur, stockée par le navigateur, et **renvoyée automatiquement** à chaque requête suivante vers le même site.

```php
// Écrire un cookie — AVANT toute sortie HTML
setcookie('theme', 'sombre', [
    'expires'  => time() + 30 * 24 * 3600, // 30 jours
    'path'     => '/',
    'secure'   => true,      // envoyé uniquement en HTTPS
    'httponly' => true,      // inaccessible au JavaScript (anti-XSS)
    'samesite' => 'Lax',     // limite l’envoi lors de requêtes cross-site (anti-CSRF)
]);

// Lire (disponible à la requête SUIVANTE)
$theme = $_COOKIE['theme'] ?? 'clair';

// Supprimer : ré-émettre avec une date passée
setcookie('theme', '', ['expires' => time() - 3600, 'path' => '/']);
```

Limites : ~4 Ko, modifiables par l’utilisateur → **ne jamais y stocker de donnée sensible ou de confiance** (ni `is_admin=1`, ni un identifiant non signé).

## Sessions

La session stocke les données **côté serveur** (dans un fichier ou un cache). Le navigateur ne reçoit qu’un identifiant de session, transporté par un cookie.

```php
session_start();               // à appeler avant toute sortie, sur chaque page

$_SESSION['panier'][] = $produitId;
$_SESSION['user_id'] = 42;

echo $_SESSION['user_id'] ?? 'visiteur';

// Fin de session (déconnexion)
$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(session_name(), '', ['expires' => time() - 42000] + $p);
}
session_destroy();
```

### Configuration sûre

Dans `php.ini`, ou avant `session_start()` :

```php
session_start([
    'cookie_secure'   => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
    'use_strict_mode' => true,   // rejette un identifiant de session non généré par le serveur
    'gc_maxlifetime'  => 1800,
]);
```

## Authentification : le schéma minimal

### Connexion

```php
session_start();

$stmt = $pdo->prepare('SELECT id, mot_de_passe FROM utilisateurs WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($motDePasse, $user['mot_de_passe'])) {
    session_regenerate_id(true);          // NOUVEL identifiant -> anti-fixation de session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['derniere_activite'] = time();
    header('Location: /tableau-de-bord.php');
    exit;
}

// Réponse volontairement identique que l’e-mail existe ou non
$erreur = "Identifiant ou mot de passe incorrect.";
```

### Vérifier l’accès sur chaque page protégée

```php
session_start();

if (empty($_SESSION['user_id'])) {
    header('Location: /connexion.php');
    exit;
}

// Expiration après 30 min d’inactivité
if (time() - ($_SESSION['derniere_activite'] ?? 0) > 1800) {
    session_unset();
    session_destroy();
    header('Location: /connexion.php?expire=1');
    exit;
}
$_SESSION['derniere_activite'] = time();
```

Bonne pratique : centraliser ce contrôle dans un fichier `auth.php` inclus en tête des pages protégées, ou dans un middleware si l’on utilise un framework.

## Menaces et parades

| Menace | Description | Parade |
|--------|-------------|--------|
| **Vol de session** (*hijacking*) | un attaquant récupère l’identifiant de session | HTTPS partout, `httponly`, `samesite` |
| **Fixation de session** | l’attaquant impose un identifiant connu de lui | `session_regenerate_id(true)` à la connexion, `use_strict_mode` |
| **CSRF** | une page tierce déclenche une action authentifiée | jeton anti-CSRF, `samesite` |
| **Session éternelle** | un poste public reste connecté | expiration d’inactivité + bouton de déconnexion |

## « Se souvenir de moi »

Ne pas allonger la durée de la session. Émettre un cookie séparé contenant un **jeton aléatoire** (`random_bytes`), stocker en base son **hash** associé à l’utilisateur et une date d’expiration, le régénérer à chaque usage, et le révoquer à la déconnexion.

## Alternatives

Pour les API sans état, on n’utilise pas de session serveur mais des **jetons** (JWT, jetons opaques) transmis dans l’en-tête `Authorization: Bearer ...`. Voir la partie *JSON et introduction aux API web*.

---

## Liens utiles

- [Sessions (documentation officielle)](https://www.php.net/manual/fr/book.session.php)
- [Sécurité des sessions (documentation officielle)](https://www.php.net/manual/fr/session.security.php)
- [`setcookie` (documentation officielle)](https://www.php.net/manual/fr/function.setcookie.php)
- [`session_regenerate_id`](https://www.php.net/manual/fr/function.session-regenerate-id.php)
- [OWASP Session Management Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/Session_Management_Cheat_Sheet.html)
- [Attribut de cookie `SameSite` (MDN)](https://developer.mozilla.org/fr/docs/Web/HTTP/Headers/Set-Cookie/SameSite)
