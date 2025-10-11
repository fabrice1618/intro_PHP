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


## Configuration de l’environnement

- **Fichier de configuration `php.ini` :**  
  Ce fichier permet d’ajuster de nombreux paramètres (affichage des erreurs, extensions, limites de mémoire, etc.).
- **Modules et extensions :**  
  Installez les extensions nécessaires selon vos besoins (ex : `php-mysql` pour MySQL).

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

