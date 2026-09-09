# 15. Bonnes pratiques et sécurité

La **sécurité** en PHP repose sur l’application de bonnes pratiques pour protéger les scripts contre les attaques courantes (injection SQL, XSS, etc.) et garantir la fiabilité des applications. La **validation et le filtrage des données** sont essentiels à chaque étape du traitement.

## Validation et filtrage des données

- **Toujours valider côté serveur** : La validation côté client (HTML/JavaScript) améliore l’expérience utilisateur mais ne suffit pas, car elle peut être contournée. Il faut systématiquement valider et filtrer les données côté serveur avec PHP.
- **Utiliser les filtres PHP** : Les fonctions `filter_var()` et `filter_input()` permettent de valider et nettoyer les entrées (emails, URLs, entiers, etc.).
    ```php
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    ```
- **Échapper les caractères spéciaux** : Utilisez `htmlspecialchars()` pour éviter l’exécution de code malveillant (XSS) lors de l’affichage de données utilisateur.
    ```php
    echo htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    ```

## Protection contre l’injection SQL

- **Toujours utiliser des requêtes préparées** avec PDO ou MySQLi pour séparer le code SQL des données utilisateur et empêcher l’injection SQL.
    ```php
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    ```
- **Ne jamais insérer directement des données utilisateur** dans une requête SQL sans validation et échappement.

## Prévention des attaques XSS (Cross-Site Scripting)

- **Échapper toutes les sorties** de données utilisateur dans le HTML avec `htmlspecialchars()`.
- **Limiter les types de fichiers uploadés** et vérifier leur contenu pour éviter l’exécution de scripts malveillants.

## Gestion des fichiers et des permissions

- **Limiter les droits d’accès** aux fichiers et répertoires utilisés par PHP.
- **Vérifier et nettoyer les chemins de fichiers** fournis par l’utilisateur pour éviter les attaques de type traversée de répertoires.

## Stocker les mots de passe

**Jamais en clair, jamais avec `md5`/`sha1`.** Utiliser les fonctions dédiées, qui gèrent le sel et le coût automatiquement :

```php
// À l’inscription
$hash = password_hash($motDePasse, PASSWORD_DEFAULT);   // stocker $hash (255 caractères conseillés)

// À la connexion
if (password_verify($motDePasse, $hash)) {
    // Ré-hacher si l’algorithme/coût a évolué
    if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
        $nouveau = password_hash($motDePasse, PASSWORD_DEFAULT);
        // ... mettre à jour en base ...
    }
    // connexion réussie
}
```

- `PASSWORD_DEFAULT` = bcrypt aujourd’hui (coût 12 depuis PHP 8.4), susceptible d’évoluer. `PASSWORD_ARGON2ID` si disponible.
- Toujours répondre « identifiant ou mot de passe incorrect » (ne pas révéler lequel).
- Limiter les tentatives (temporisation, verrouillage, captcha) pour freiner le *bruteforce*.

## Aléa cryptographique

Pour les jetons, identifiants de session, clés de réinitialisation :

```php
$jeton = bin2hex(random_bytes(32));   // 256 bits
$code  = random_int(100000, 999999);  // PIN à 6 chiffres
```

`rand()`, `mt_rand()`, `uniqid()` ne sont **pas** cryptographiquement sûrs.

## Sessions

Voir la partie dédiée *Sessions, cookies et authentification*. L’essentiel :

- Cookies de session : `secure`, `httponly`, `samesite=Lax` ou `Strict`.
- `session.use_strict_mode = 1`.
- `session_regenerate_id(true)` **juste après** une élévation de privilège (connexion) → anti-fixation de session.
- Expiration d’inactivité côté serveur.

## Protection CSRF

Toute action modifiant l’état (POST/PUT/DELETE) doit être accompagnée d’un jeton anti-CSRF unique par session, vérifié avec `hash_equals()`. Voir l’exemple complet dans la partie *Formulaires*.

## En-têtes de sécurité HTTP

```php
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');                         // ou Content-Security-Policy: frame-ancestors
header("Content-Security-Policy: default-src 'self'");
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Strict-Transport-Security: max-age=31536000; includeSubDomains'); // HTTPS uniquement
```

## Autres injections à connaître

| Attaque | Vecteur | Défense |
|---------|---------|---------|
| **Injection SQL** | requête concaténée | requêtes préparées |
| **XSS** | sortie HTML non échappée | `htmlspecialchars()` à l’affichage, CSP |
| **Injection de commande** | `system()`, `exec()`, `` ` `` avec entrée utilisateur | éviter ; sinon `escapeshellarg()` + liste blanche |
| **Inclusion de fichier (LFI/RFI)** | `include $_GET['page']` | liste blanche de pages, jamais de chemin utilisateur |
| **Traversée de répertoire** | `readfile("/data/".$_GET['f'])` | `basename()`, vérifier `realpath()` |
| **SSRF** | URL fournie par l’utilisateur passée à `file_get_contents`/cURL | liste blanche de domaines, bloquer les IP internes |
| **Open redirect** | `header("Location: ".$_GET['url'])` | rediriger uniquement vers des chemins internes |
| **En-tête / CRLF** | données utilisateur dans `header()` | PHP bloque déjà les `\n`, valider quand même |

## Gérer les secrets et les dépendances

- Identifiants de base, clés d’API : dans des **variables d’environnement** ou un fichier `.env` **exclu de Git** (`.gitignore`), jamais dans le code.
- `composer audit` : signale les dépendances avec des failles connues. À lancer régulièrement / en CI.
- Retirer `phpinfo()`, les fichiers `.bak`, `.git/` de la racine web en production.

## Autres bonnes pratiques

- **Tenir PHP et ses extensions à jour** pour bénéficier des correctifs de sécurité.
- **Ne jamais afficher d’informations sensibles** (mots de passe, détails de configuration) dans les messages d’erreur en production.
- **Utiliser HTTPS** pour chiffrer les échanges entre le client et le serveur.
- **Limiter les permissions de l’utilisateur web** exécutant les scripts PHP.
- **Respecter les PSR**: 
    - [PSR-1](https://www.php-fig.org/psr/psr-1/)
    - [PSR-12](https://www.php-fig.org/psr/psr-12/)

## Liens utiles

- [Documentation officielle PHP : Sécurité](https://www.php.net/manual/fr/security.php)
- [Sécurisation et validation des formulaires en PHP](https://www.pierre-giraud.com/php-mysql-apprendre-coder-cours/validation-securisation-formulaire/)
- [Filtres de validation PHP](https://www.php.net/manual/fr/filter.filters.validate.php)
- [Bonnes pratiques de sécurité PHP](https://www.exakat.io/fr/les-10-meilleures-pratiques-de-securite-php/)
- [`password_hash` / `password_verify` (documentation officielle)](https://www.php.net/manual/fr/function.password-hash.php)
- [Sécurité des sessions (documentation officielle)](https://www.php.net/manual/fr/session.security.php)
- [OWASP Top Ten](https://owasp.org/www-project-top-ten/)
- [OWASP PHP Configuration Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/PHP_Configuration_Cheat_Sheet.html)
- [`random_bytes` / `random_int`](https://www.php.net/manual/fr/function.random-bytes.php)
