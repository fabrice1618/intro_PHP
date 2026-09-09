# 2. Installation et configuration de PHP

Installer PHP est possible sur la plupart des systèmes d’exploitation (Linux, Windows, macOS). Cette étape est essentielle pour développer et exécuter des scripts PHP en local ou sur un serveur.

## Installation sur Linux (ex : Ubuntu)

- **Mettre à jour le système :**
  ```bash
  sudo apt-get update
  sudo apt-get upgrade
  ```
- **Installer PHP :**
  ```bash
  sudo apt-get install php
  ```
- **Vérifier l’installation :**
  ```bash
  php -v
  ```
  Cette commande affiche la version de PHP installée.

- **Serveur de développement intégré :**  
  Pour tester vos scripts localement sans serveur web externe, utilisez :
  ```bash
  php -S localhost:8000
  ```
  Cela lance un serveur local accessible sur [http://localhost:8000](http://localhost:8000).


### Installer une version précise (PPA ondrej/php)

Les dépôts Ubuntu ne fournissent pas toujours la dernière version. Le PPA de Ondřej Surý fait référence :

```bash
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install php8.4 php8.4-cli php8.4-mbstring php8.4-xml php8.4-curl php8.4-mysql
```

On peut faire cohabiter plusieurs versions et basculer avec :

```bash
sudo update-alternatives --config php
```

## Installation sur macOS

- **Homebrew** (recommandé) :
  ```bash
  brew install php
  brew services start php   # si on veut PHP-FPM en service
  php -v
  ```
- macOS a historiquement livré PHP, mais **plus depuis macOS Monterey (12)**. Passer par Homebrew.

## Installation sur Windows

- **Manuellement** : télécharger le ZIP « *Thread Safe* » sur [windows.php.net](https://windows.php.net/download/), le décompresser dans `C:\php`, ajouter ce dossier au `PATH`, copier `php.ini-development` en `php.ini`.
- **Environnements tout-en-un** (Apache + PHP + MySQL préconfigurés) :
  - **Laragon** (léger, moderne, recommandé sous Windows)
  - **XAMPP** (multiplateforme, très répandu)
  - **WampServer**
- **WSL2** : installer une distribution Linux dans Windows et suivre la procédure Ubuntu ci-dessus — c’est l’approche la plus proche d’un serveur de production.

## Avec Docker (multiplateforme)

Utile pour reproduire exactement l’environnement de production et éviter de « polluer » sa machine :

```bash
docker run --rm -it -v "$PWD":/app -w /app -p 8000:8000 php:8.4-cli \
  php -S 0.0.0.0:8000
```

Pour un vrai projet, on écrit un `Dockerfile` et un `docker-compose.yml` (PHP-FPM + Nginx + base de données).

## Installer Composer

**Composer** est le gestionnaire de dépendances de l’écosystème PHP. Sous Linux/macOS :

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
php -r "unlink('composer-setup.php');"
composer --version
```

## Configuration de l’environnement

- **Fichier de configuration `php.ini` :**  
  Ce fichier permet d’ajuster de nombreux paramètres (affichage des erreurs, extensions, limites de mémoire, etc.).
- **Modules et extensions :**  
  Installez les extensions nécessaires selon vos besoins (ex : `php-mysql` pour MySQL).

### Où se trouve le bon `php.ini` ?

PHP utilise un fichier différent selon la SAPI (CLI, FPM, Apache). Pour savoir lequel :

```bash
php --ini
```

Il existe habituellement deux modèles fournis :
- `php.ini-development` : affichage des erreurs activé, réglages permissifs — pour **développer**.
- `php.ini-production` : erreurs masquées à l’écran mais journalisées — pour **déployer**.

### Directives à connaître

| Directive | Rôle | Dev | Production |
|-----------|------|-----|-----------|
| `display_errors` | affiche les erreurs dans la page | `On` | `Off` |
| `error_reporting` | niveau de détail des erreurs | `E_ALL` | `E_ALL` |
| `log_errors` | écrit les erreurs dans un fichier | `On` | `On` |
| `error_log` | chemin du fichier de log | | `/var/log/php/error.log` |
| `memory_limit` | mémoire max par script | `128M` | `128M`–`256M` |
| `max_execution_time` | durée max d’un script (s) | `30` | `30` |
| `upload_max_filesize` / `post_max_size` | taille max des envois de fichiers | `2M` / `8M` | selon besoin |
| `date.timezone` | fuseau horaire par défaut | `Europe/Paris` | `Europe/Paris` |
| `opcache.enable` | cache du bytecode | `1` | `1` |

Après toute modification de `php.ini`, **redémarrer** le serveur web (ou PHP-FPM) : `sudo systemctl restart php8.4-fpm`.

### Modifier un réglage sans toucher au `php.ini`

- Ponctuellement, dans un script (uniquement pour les directives modifiables à l’exécution) :
  ```php
  ini_set('display_errors', '1');
  error_reporting(E_ALL);
  ```
- En ligne de commande : `php -d memory_limit=512M script.php`
- Lister les extensions chargées : `php -m`

## Choisir un éditeur

- **VS Code** + extension *PHP Intelephense* (ou *PHP* de DEVSENSE) : autocomplétion, navigation, détection d’erreurs.
- **PhpStorm** (JetBrains, payant) : l’IDE de référence pour PHP.
- Outils complémentaires : **PHP_CodeSniffer** (`phpcs`/`phpcbf`) pour vérifier le style PSR-12, **PHPStan** ou **Psalm** pour l’analyse statique.

## Vérification de l’installation

- **En ligne de commande :**  
  `php -v` affiche la version de PHP.
- **Via un script :**  
  Créez un fichier `info.php` contenant :
  ```php
  <?php phpinfo(); ?>
  ```
  Ouvrez-le dans votre navigateur pour afficher la configuration complète de PHP.

---

## Liens utiles

- [Installation et configuration de PHP (documentation officielle)](https://www.php.net/manual/fr/install.php)
- [Le serveur web intégré (documentation officielle)](https://www.php.net/manual/fr/features.commandline.webserver.php)
- [Liste des directives `php.ini` (documentation officielle)](https://www.php.net/manual/fr/ini.list.php)
- [Installation de Composer](https://getcomposer.org/download/)
- [Images Docker officielles PHP](https://hub.docker.com/_/php)
- [PPA ondrej/php (Ubuntu)](https://launchpad.net/~ondrej/+archive/ubuntu/php)

