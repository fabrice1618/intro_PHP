# 12. Introduction à la programmation orientée objet (POO)

La **programmation orientée objet (POO)** en PHP est un paradigme qui organise le code autour d’**objets** issus de **classes**, permettant une structure modulaire, réutilisable et facile à maintenir.

## Concepts de base

- **Classe** : Modèle ou plan définissant les propriétés (variables) et méthodes (fonctions) communes à tous les objets créés à partir de cette classe.
- **Objet** : Instance concrète d’une classe, possédant ses propres valeurs pour les propriétés et pouvant exécuter les méthodes définies dans la classe.
- **Propriété** : Variable associée à un objet, représentant ses données ou son état.
- **Méthode** : Fonction associée à un objet, définissant ses comportements ou actions.

## Exemple simple

```php
class Voiture {
    public $marque;
    public $couleur;

    public function demarrer() {
        echo "La voiture démarre";
    }
}

// Création d’un objet (instance)
$maVoiture = new Voiture();
$maVoiture->marque = "Renault";
$maVoiture->couleur = "rouge";
$maVoiture->demarrer(); // Affiche : La voiture démarre
```


## Principes fondamentaux de la POO

- **Encapsulation** : Les propriétés et méthodes sont regroupées dans une même entité (l’objet), ce qui protège les données et limite les accès directs grâce à des niveaux de visibilité (`public`, `private`, `protected`).
- **Héritage** : Une classe peut hériter des propriétés et méthodes d’une autre classe (classe parente), facilitant la réutilisation et l’extension du code.
    ```php
    class Vehicule {
        public $marque;
    }

    class Voiture extends Vehicule {
        public $couleur;
    }
    ```
- **Abstraction** : Permet de définir des classes ou méthodes abstraites qui servent de modèles sans être instanciées directement.
- **Polymorphisme** : Capacité à manipuler des objets de différentes classes dérivées via une interface ou une classe parente commune.

## Avantages de la POO

- **Modularité** : Le code est organisé en entités indépendantes et réutilisables.
- **Maintenance facilitée** : Les modifications sont localisées et n’impactent pas l’ensemble du code.
- **Réutilisation** : Les classes et objets peuvent être réutilisés dans différents projets ou contextes.

## Liens utiles

- [Documentation officielle PHP : Programmation orientée objet](https://www.php.net/manual/fr/language.oop5.php)
- [Tutoriel complet sur la POO en PHP](https://nouvelle-techno.fr/articles/maitriser-la-poo-en-php)
- [Introduction à la POO en PHP](https://www.pierre-giraud.com/php-mysql-apprendre-coder-cours/programmation-orientee-objet-presentation/)
