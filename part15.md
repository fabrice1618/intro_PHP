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
