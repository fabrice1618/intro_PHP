# Sommaire : Les bases indispensables de PHP

1. **[Introduction à PHP](part1.md)**

   Présente ce qu'est PHP, ses usages principaux, et pourquoi il est largement utilisé pour le développement web dynamique.

2. **[Installation et configuration de PHP](part2.md)**

   Explique comment installer PHP sur différents systèmes, configurer un environnement de développement local, et vérifier l'installation.

3. **[Syntaxe de base et structure d'un script PHP](part3.md)**

   Décrit la structure d'un fichier PHP, l'utilisation des balises PHP, et les règles de base de la syntaxe (instructions, commentaires, etc.).

4. **[Variables et types de données](part4.md)**

   Présente la déclaration des variables, les différents types de données (chaînes, nombres, booléens, tableaux, objets), et les règles de typage.

5. **[Opérateurs](part5.md)**

   Résume les principaux opérateurs arithmétiques, logiques, de comparaison et d'affectation utilisés en PHP.

6. **[Structures de contrôle](part6.md)**

   Explique l'utilisation des conditions (if, else, switch) et des boucles (while, for, foreach) pour contrôler le flux d'exécution.

7. **[Fonctions](part7.md)**

   Décrit comment déclarer et utiliser des fonctions, la portée des variables, et l'utilisation des paramètres et valeurs de retour.

8. **[Tableaux](part8.md)**

   Présente la création, la manipulation et les fonctions principales pour travailler avec les tableaux en PHP.

9. **[Gestion des chaînes de caractères](part9.md)**

   Explique comment manipuler les chaînes de caractères, concaténer, rechercher, remplacer et utiliser les fonctions courantes.

10. **[Gestion des formulaires et des données utilisateur](part10.md)**

    Montre comment récupérer et traiter les données envoyées par les utilisateurs via des formulaires HTML (méthodes GET et POST).

11. **[Gestion des fichiers](part11.md)**

    Explique comment lire, écrire et manipuler des fichiers sur le serveur avec PHP.

12. **[Introduction à la programmation orientée objet (POO)](part12.md)**

    Présente les concepts de base de la POO en PHP : classes, objets, propriétés, méthodes, héritage.

13. **[Connexion à une base de données](part13.md)**

    Explique comment se connecter à une base de données (ex : MySQL), exécuter des requêtes et traiter les résultats.

14. **[Gestion des erreurs et débogage](part14.md)**

    Présente les méthodes pour gérer les erreurs, afficher les messages d'erreur et utiliser les outils de débogage.

15. **[Bonnes pratiques et sécurité](part15.md)**

    Résume les bonnes pratiques de développement et les notions de base pour sécuriser ses scripts PHP (validation des données, injection SQL, XSS, etc.).

16. **[Dates et heures](part16.md)**

    Manipulation du temps avec les fonctions procédurales et l'API objet (`DateTimeImmutable`, `DateInterval`), fuseaux horaires et pièges courants.

17. **[Sessions, cookies et authentification](part17.md)**

    Conserver un état entre les requêtes : cookies, sessions serveur, schéma d'authentification minimal et protection contre le vol et la fixation de session.

18. **[Organisation du code : inclusions, namespaces et autoloading](part18.md)**

    Découper un projet en fichiers, éviter les collisions de noms avec les espaces de noms, et charger les classes automatiquement avec Composer (PSR-4).

19. **[JSON et introduction aux API web](part19.md)**

    Produire et consommer du JSON, notions d'API REST (verbes HTTP, codes de statut), lecture d'un corps de requête et routage minimal.

20. **[Expressions régulières (PCRE)](part20.md)**

    Décrire des motifs de texte pour valider, extraire et remplacer : syntaxe PCRE, fonctions `preg_*`, exemples courants et pièges.

21. **[Introduction aux tests automatisés](part21.md)**

    Pourquoi et comment tester son code avec PHPUnit : assertions, jeux de données, doublures, et outils complémentaires (analyse statique, CI).

---

## Ressources générales

- [Documentation officielle PHP (français)](https://www.php.net/manual/fr/)
- [PHP The Right Way](https://phptherightway.com/) — panorama des bonnes pratiques modernes
- [Nouveautés de PHP 8.4](https://www.php.net/releases/8.4/fr.php)
- [Recommandations PSR (PHP-FIG)](https://www.php-fig.org/psr/)
- [Exercices progressifs](exercices/readme.md) · [Test de connaissances](test.md)

> Ce cours cible **PHP 8.4**. Les fonctionnalités apparues dans une version récente sont signalées (ex. « PHP 8.1 »).
