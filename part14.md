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
