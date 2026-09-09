# 16. Dates et heures

La gestion du temps est une source classique de bugs (fuseaux horaires, heure d’été, mois de longueurs différentes, années bissextiles). PHP fournit à la fois des **fonctions procédurales** simples et une **API orientée objet** robuste (`DateTimeImmutable`, `DateTime`, `DateInterval`, `DateTimeZone`), à privilégier dès que l’on fait des calculs.

## Définir le fuseau horaire

À faire **une fois**, au démarrage de l’application (ou dans `php.ini` via `date.timezone`) :

```php
date_default_timezone_set('Europe/Paris');
```

Sans cela, PHP utilise `UTC` et émet un avertissement. En base de données, on stocke généralement en **UTC** et on convertit à l’affichage.

## Fonctions procédurales de base

```php
time();                         // horodatage Unix (secondes depuis le 1er janvier 1970 UTC)
date('Y-m-d H:i:s');            // "2026-09-09 14:30:00"
date('d/m/Y', time());          // date formatée d’un horodatage
mktime(0, 0, 0, 12, 25, 2026);  // horodatage pour une date précise
strtotime('2026-09-09');        // texte -> horodatage
strtotime('+1 week');           // dates relatives en anglais
strtotime('next monday');
checkdate(2, 29, 2025);         // false : 2025 n’est pas bissextile
```

### Principaux caractères de format

| Caractère | Signification | Exemple |
|-----------|---------------|---------|
| `Y` / `y` | année sur 4 / 2 chiffres | `2026` / `26` |
| `m` / `n` | mois avec / sans zéro | `09` / `9` |
| `d` / `j` | jour avec / sans zéro | `09` / `9` |
| `H` / `G` | heure 24 h avec / sans zéro | `08` / `8` |
| `i` / `s` | minutes / secondes | `05` |
| `D` / `l` | jour de semaine court / long (anglais) | `Mon` / `Monday` |
| `N` / `w` | jour de semaine numérique (1=lundi / 0=dimanche) | |
| `W` | numéro de semaine ISO | |
| `U` | horodatage Unix | |

Pour des libellés **en français**, utiliser `IntlDateFormatter` (extension `intl`) :

```php
$fmt = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
echo $fmt->format(new DateTimeImmutable()); // "mercredi 9 septembre 2026"
```

## L’API orientée objet

### Créer un objet date

```php
$maintenant = new DateTimeImmutable();                     // maintenant
$date = new DateTimeImmutable('2026-09-09 14:30');
$date = DateTimeImmutable::createFromFormat('d/m/Y', '09/09/2026');
$date = DateTimeImmutable::createFromTimestamp(1_757_421_000); // PHP 8.4
```

> **`DateTimeImmutable` ou `DateTime` ?** Préférer **`DateTimeImmutable`** : ses méthodes renvoient un nouvel objet au lieu de modifier l’objet courant. Avec `DateTime` (muable), `$a = $b; $a->modify('+1 day');` modifie aussi `$b` — source de bugs.

### Formater

```php
echo $date->format('d/m/Y à H\hi');   // "09/09/2026 à 14h30"
```

### Additionner / soustraire une durée

```php
$demain      = $maintenant->add(new DateInterval('P1D'));   // +1 jour
$ilYaUnMois  = $maintenant->sub(new DateInterval('P1M'));   // -1 mois
$dans2h30    = $maintenant->add(new DateInterval('PT2H30M'));
$plusSimple  = $maintenant->modify('+3 days');
```

Format ISO 8601 des durées : `P` (période) puis `nY nM nD`, `T` (temps) puis `nH nM nS`. Exemple : `P1Y2M10DT2H30M`.

### Calculer un écart

```php
$debut = new DateTimeImmutable('2026-01-01');
$fin   = new DateTimeImmutable('2026-09-09');
$ecart = $debut->diff($fin);           // objet DateInterval

echo $ecart->days;                     // nombre total de jours (251)
echo $ecart->format('%m mois et %d jours'); // "8 mois et 8 jours"
echo $ecart->invert;                   // 1 si $fin est avant $debut
```

### Comparer

```php
if ($dateLimite < new DateTimeImmutable()) {
    echo "Délai dépassé";
}
```

Les objets `DateTimeInterface` se comparent directement avec `<`, `>`, `==`.

### Parcourir une plage de dates

```php
$periode = new DatePeriod(
    new DateTimeImmutable('2026-09-01'),
    new DateInterval('P1D'),
    new DateTimeImmutable('2026-09-08')   // exclu
);
foreach ($periode as $jour) {
    echo $jour->format('Y-m-d'), "\n";
}
```

## Fuseaux horaires

```php
$paris = new DateTimeImmutable('2026-09-09 14:00', new DateTimeZone('Europe/Paris'));
$tokyo = $paris->setTimezone(new DateTimeZone('Asia/Tokyo'));
echo $tokyo->format('H:i');   // "21:00"
```

## Erreurs fréquentes

- Comparer des dates sous forme de **chaînes** `"09/09/2026" < "10/01/2026"` → faux. Comparer des objets ou le format `Y-m-d`.
- Oublier le fuseau : deux serveurs peuvent donner deux résultats.
- Utiliser `strtotime()` sur une date au format `j/m/Y` : il l’interprète en `m/d/Y` (format américain). Passer par `createFromFormat()`.
- Additionner `86400` secondes pour « +1 jour » : faux les jours de changement d’heure. Utiliser `DateInterval`.

---

## Liens utiles

- [Date et heure (documentation officielle)](https://www.php.net/manual/fr/book.datetime.php)
- [`DateTimeImmutable`](https://www.php.net/manual/fr/class.datetimeimmutable.php)
- [Caractères de format de `date()`](https://www.php.net/manual/fr/datetime.format.php)
- [Formats de date et d’heure reconnus](https://www.php.net/manual/fr/datetime.formats.php)
- [Liste des fuseaux horaires supportés](https://www.php.net/manual/fr/timezones.php)
- [`IntlDateFormatter` (localisation)](https://www.php.net/manual/fr/class.intldateformatter.php)
