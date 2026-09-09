# 14 - gestion des erreurs et le débogage

La **gestion des erreurs et le débogage** en PHP reposent sur plusieurs méthodes : configuration du rapport d’erreurs, gestionnaires personnalisés, exceptions, et outils spécialisés pour le suivi et l’analyse des erreurs.

## Types d’erreurs en PHP

- **Erreur fatale** (*Fatal error*) : interrompt l’exécution du script.
- **Avertissement** (*Warning*) : n’interrompt pas le script, mais signale un problème.
- **Notice** : indique une mauvaise pratique ou une variable non initialisée.
- **Exception** : erreur gérée explicitement via le mécanisme try/catch.

## Affichage et configuration des erreurs

- Utilisez `error_reporting(E_ALL)` pour afficher toutes les erreurs.
- `ini_set('display_errors', 1)` permet d’afficher les erreurs à l’écran (à utiliser uniquement en développement).
- Le fichier `php.ini` permet de configurer le niveau de rapport d’erreurs et l’enregistrement dans un fichier log.

## Gestionnaires d’erreurs personnalisés

- La fonction `set_error_handler()` permet de définir une fonction personnalisée pour traiter les erreurs.
- Exemple :

```php
function monGestionnaireErreur($errno, $errstr, $errfile, $errline) {
    error_log("Erreur [$errno] : $errstr dans $errfile à la ligne $errline", 3, "/var/log/php_errors.log");
    echo "Une erreur est survenue. Veuillez réessayer plus tard.";
}
set_error_handler('monGestionnaireErreur');
```


- Attention : certains types d’erreurs (ex : E_ERROR, E_PARSE) ne peuvent pas être interceptés par ce mécanisme.

## La hiérarchie des erreurs depuis PHP 7

Presque tout ce qui peut être « lancé » implémente l’interface `Throwable` :

```text
Throwable
├── Error                     (erreurs du moteur : bugs de programmation)
│   ├── TypeError             (mauvais type d’argument/retour)
│   ├── ValueError            (valeur hors domaine, PHP 8)
│   ├── ArithmeticError → DivisionByZeroError
│   └── AssertionError
└── Exception                 (conditions applicatives que l’on gère)
    ├── LogicException → InvalidArgumentException, DomainException, LengthException…
    ├── RuntimeException → OutOfBoundsException, UnexpectedValueException…
    ├── JsonException
    └── PDOException
```

Pour tout attraper (rare, mais utile en dernier recours) : `catch (\Throwable $e)`.

## Gestion des exceptions

- Utilisez les blocs `try { ... } catch (Exception $e) { ... }` pour capturer et traiter les exceptions.
- Exemple :

```php
try {
    // Code susceptible de générer une exception
    throw new Exception("Erreur personnalisée !");
} catch (Exception $e) {
    echo "Exception capturée : " . $e->getMessage();
}
```


### `try` / `catch` / `finally` et multi-catch

```php
try {
    $data = json_decode($json, true, flags: JSON_THROW_ON_ERROR);
    $pdo->prepare('INSERT ...')->execute($data);
} catch (JsonException $e) {
    http_response_code(400);
    echo "JSON invalide.";
} catch (PDOException | RuntimeException $e) {   // plusieurs types, même traitement
    error_log($e->getMessage());
    http_response_code(500);
    echo "Erreur interne.";
} finally {
    // exécuté dans tous les cas (succès, exception, return)
    $verrou?->relacher();
}
```

### Créer sa propre exception

```php
final class SoldeInsuffisantException extends RuntimeException {}

if ($montant > $this->solde) {
    throw new SoldeInsuffisantException("Retrait de $montant refusé.");
}
```

### Chaînage d’exceptions

Conserver la cause d’origine tout en relançant une exception plus parlante :

```php
try {
    $client->appeler();
} catch (HttpException $e) {
    throw new PaiementException('Le paiement a échoué', previous: $e);
}
// Plus tard : $e->getPrevious() donne l’exception initiale
```

### `throw` comme expression (PHP 8)

```php
$user = $repo->find($id) ?? throw new NotFoundException("Utilisateur $id introuvable");
```

### Informations d’une exception

```php
$e->getMessage();  $e->getCode();
$e->getFile();     $e->getLine();
$e->getTrace();    $e->getTraceAsString();
$e->getPrevious();
```

## Transformer les erreurs PHP en exceptions

Beaucoup de fonctions natives (`file_get_contents`, `fopen`…) émettent un *warning* plutôt qu’une exception. On peut uniformiser :

```php
set_error_handler(static function (int $niveau, string $message, string $fichier, int $ligne): bool {
    if (!(error_reporting() & $niveau)) {
        return false; // erreur masquée par @ ou la config
    }
    throw new ErrorException($message, 0, $niveau, $fichier, $ligne);
});
```

## Capturer ce qui échappe au `try/catch`

```php
// Exceptions non attrapées
set_exception_handler(function (Throwable $e): void {
    error_log((string) $e);
    http_response_code(500);
    echo "Une erreur est survenue.";
});

// Erreurs fatales (E_ERROR, épuisement mémoire, dépassement de temps…)
register_shutdown_function(function (): void {
    $err = error_get_last();
    if ($err && in_array($err['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
        error_log("Fatale : {$err['message']} ({$err['file']}:{$err['line']})");
    }
});
```

## Journaliser

```php
error_log("Paiement refusé pour la commande $id");            // vers le log configuré
error_log(print_r($donnees, true));                            // inspecter une variable
```

En vrai projet, on utilise **Monolog** (standard PSR-3 `LoggerInterface`) avec des niveaux (`debug`, `info`, `warning`, `error`, `critical`).

## Déboguer efficacement

- `var_dump()` / `var_export()` — inspection rapide. `die(var_dump($x))` pour arrêter net.
- **Xdebug** : débogueur pas-à-pas intégré aux IDE, points d’arrêt, *stack traces* lisibles, profilage. L’outil de référence.
- `debug_print_backtrace()` — d’où vient l’appel ?
- `assert()` — vérifier une invariant en développement (désactivable en production via `zend.assertions=-1`).
- En CLI : `php -a` (mode interactif), `php -l fichier.php` (vérifier la syntaxe sans exécuter).

## Outils et bibliothèques de débogage

- **Whoops** : affiche des pages d’erreur détaillées et conviviales en développement.
- **Monolog** : journalisation avancée des erreurs et intégration avec des services externes.
- **Sentry, Rollbar** : suivi des erreurs en temps réel et notifications.
- **PHP Error** : améliore l’affichage des messages d’erreur en développement.

## Bonnes pratiques

- Afficher les erreurs uniquement en environnement de développement.
- Enregistrer les erreurs dans un fichier log pour analyse.
- Utiliser des gestionnaires personnalisés pour adapter la réaction aux erreurs selon le contexte.
- Préférer les exceptions pour les erreurs critiques et les flux de contrôle complexes.

## Liens utiles

- [Documentation officielle PHP : Gestion des erreurs](https://www.php.net/manual/fr/language.errors.php)
- [Guide complet sur la gestion des erreurs et exceptions en PHP](https://grafikart.fr/tutoriels/error-exception-php-2156)
- [Bonnes pratiques de gestion des erreurs](https://www.pierre-giraud.com/php-mysql-apprendre-coder-cours/gestion-erreur/)
- [Les exceptions (documentation officielle)](https://www.php.net/manual/fr/language.exceptions.php)
- [Hiérarchie des exceptions SPL](https://www.php.net/manual/fr/spl.exceptions.php)
- [`Throwable`, `Error`, `Exception`](https://www.php.net/manual/fr/class.throwable.php)
- [Xdebug — documentation](https://xdebug.org/docs/)
- [PSR-3 : interface de journalisation](https://www.php-fig.org/psr/psr-3/)
