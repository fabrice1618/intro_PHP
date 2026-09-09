# 1. Introduction à PHP

**PHP** est un langage de script open source principalement conçu pour le développement d’applications web dynamiques. Il s’exécute côté serveur : le code PHP est interprété sur le serveur, qui génère ensuite du HTML (ou d’autres formats) envoyé au navigateur de l’utilisateur. Le code source PHP n’est jamais visible par le client, seul le résultat final l’est.

Créé en 1995 par Rasmus Lerdorf, PHP s’est imposé comme l’un des langages les plus utilisés pour le web grâce à sa simplicité, sa large communauté et sa capacité à s’intégrer facilement au HTML. Il est utilisé par de nombreux sites majeurs et des systèmes de gestion de contenu populaires comme WordPress, Drupal ou Joomla.

**Principaux usages de PHP :**
- Génération de pages web dynamiques (contenu personnalisé, gestion de sessions, etc.)
- Interaction avec des bases de données (stockage, récupération et modification de données)
- Traitement de formulaires et gestion des données utilisateur
- Création d’API et de services web

PHP est apprécié pour sa flexibilité, sa compatibilité avec la plupart des serveurs web (Apache, Nginx, IIS…), et sa capacité à fonctionner sur de nombreux systèmes d’exploitation. Aujourd’hui, il reste l’un des langages de programmation côté serveur les plus répandus, utilisé par près de 80 % des sites web dans le monde.

> **Précision sur ce chiffre** : les mesures (W3Techs) portent sur les sites *dont le langage serveur est connu*. PHP y représente environ 75 à 78 %. Cela ne signifie pas que 80 % de « tout le web » est en PHP, mais que PHP domine très largement parmi les langages serveur identifiables.

Pour une explication détaillée, consulter la [documentation officielle sur PHP](https://www.php.net/manual/fr/intro-whatis.php).

## Que signifie « PHP » ?

L’acronyme est *récursif* : **PHP: Hypertext Preprocessor**. À l’origine (1995), il désignait « Personal Home Page Tools », un ensemble de scripts que Rasmus Lerdorf utilisait pour suivre les visites de sa page personnelle. Le langage a ensuite été entièrement réécrit :

- **PHP 3** (1998) : première version réellement diffusée, moteur réécrit par Andi Gutmans et Zeev Suraski.
- **PHP 4** (2000) : moteur *Zend Engine 1*, gain de performances majeur.
- **PHP 5** (2004) : modèle objet moderne, `PDO`, exceptions.
- **PHP 7** (2015) : *Zend Engine 3*, performances doublées par rapport à PHP 5, typage scalaire, `<=>`, `??`.
- **PHP 8.0** (2020) : compilateur **JIT**, `match`, promotion des propriétés du constructeur, attributs, `nullsafe` (`?->`), types union.
- **PHP 8.1 → 8.4** (2021-2024) : `enum`, propriétés `readonly`, `never`, *fibers*, `#[\Override]`, *property hooks* et visibilité asymétrique (8.4).

Chaque version majeure est maintenue **2 ans en support actif** puis **1 an en support sécurité** uniquement. Utiliser une version obsolète (PHP 7.4 et antérieures, aujourd’hui non supportées) expose à des failles non corrigées. Consulter [php.net/supported-versions](https://www.php.net/supported-versions.php).

## Comment PHP fonctionne : le cycle d’une requête

```text
Navigateur  ──HTTP──▶  Serveur web (Apache/Nginx)  ──▶  Interpréteur PHP
                                                            │
                                          exécute le script, interroge
                                          éventuellement une base de données
                                                            │
Navigateur  ◀──HTML──  Serveur web  ◀──────────────────  résultat (HTML/JSON…)
```

1. Le navigateur demande une URL (`index.php`).
2. Le serveur web repère l’extension `.php` et délègue le fichier à l’interpréteur PHP (via un module ou **PHP-FPM**).
3. PHP exécute le script **de zéro à chaque requête** (modèle « *shared nothing* » : aucune donnée ne persiste en mémoire entre deux requêtes, sauf mécanismes explicites comme les sessions ou un cache).
4. Le script produit une sortie (généralement du HTML, parfois du JSON, un PDF, une image…).
5. Le serveur renvoie cette sortie au navigateur. **Le code source PHP n’est jamais transmis.**

Ce fonctionnement « côté serveur » distingue PHP de JavaScript exécuté dans le navigateur (« côté client ») : avec PHP, on peut manipuler des fichiers du serveur, se connecter à une base de données et garder des secrets (mots de passe, clés d’API) hors de portée de l’utilisateur.

## Les différents contextes d’exécution (SAPI)

PHP n’est pas réservé au web. Le même interpréteur s’utilise via différentes **SAPI** (*Server API*) :

| Contexte | Usage |
|----------|-------|
| **CLI** (`php script.php`) | scripts d’administration, tâches planifiées (cron), outils en ligne de commande, tests |
| **PHP-FPM** | mode standard en production derrière Nginx ou Apache |
| **mod_php** | module Apache, plus simple mais moins performant |
| **Serveur intégré** (`php -S`) | développement local uniquement, jamais en production |

## L’écosystème PHP moderne

- **Composer** : gestionnaire de dépendances (équivalent de `npm` pour Node.js). Voir la partie sur les *namespaces et l’autoloading*.
- **Packagist** : dépôt central des bibliothèques PHP ([packagist.org](https://packagist.org)).
- **Frameworks** : **Symfony** et **Laravel** (les deux plus utilisés), Laminas, Slim (micro-framework).
- **PHP-FIG** : groupe qui publie les recommandations **PSR** (PSR-1, PSR-4, PSR-12…) pour uniformiser le style et l’interopérabilité.
- **OPcache** : extension activée par défaut qui met en cache le *bytecode* compilé — indispensable en production.
- **JIT** (*Just-In-Time*, PHP 8+) : compilation en code machine, utile surtout pour le calcul intensif.

---

## Liens utiles

- [Qu’est-ce que PHP ? (documentation officielle)](https://www.php.net/manual/fr/intro-whatis.php)
- [Historique de PHP (documentation officielle)](https://www.php.net/manual/fr/history.php.php)
- [Versions supportées de PHP](https://www.php.net/supported-versions.php)
- [Nouveautés de PHP 8.4](https://www.php.net/releases/8.4/fr.php)
- [Le PHP-FIG et les PSR](https://www.php-fig.org/psr/)
- [Statistiques d’utilisation des langages serveur (W3Techs)](https://w3techs.com/technologies/details/pl-php)
