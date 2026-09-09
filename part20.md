# 20. Expressions régulières (PCRE)

Une **expression régulière** (*regex*) décrit un motif de texte : elle sert à **valider** un format (e-mail, code postal), **rechercher**, **extraire** ou **remplacer** dans une chaîne. PHP utilise la syntaxe **PCRE** (compatible Perl), via les fonctions `preg_*`.

> Avant d’écrire une regex, vérifier qu’une fonction dédiée n’existe pas : `filter_var($x, FILTER_VALIDATE_EMAIL)`, `str_contains()`, `str_starts_with()`, `explode()`… sont plus lisibles et plus sûrs.

## Délimiteurs

Le motif est encadré par un délimiteur (souvent `/`, parfois `#` ou `~` quand le motif contient des `/`) :

```php
'/^[0-9]{5}$/'      // 5 chiffres exactement
'#^https?://#'      // délimiteur # pour éviter d’échapper les /
'/motif/i'          // options après le délimiteur fermant
```

Options fréquentes : `i` (insensible à la casse), `m` (multiligne : `^` et `$` par ligne), `s` (`.` inclut les sauts de ligne), `u` (mode **UTF-8**, indispensable avec des accents), `x` (ignore les espaces du motif, pour le commenter).

## Briques de base

| Élément | Signifie |
|---------|----------|
| `.` | n’importe quel caractère (sauf saut de ligne) |
| `\d` `\w` `\s` | chiffre / caractère de mot (`[A-Za-z0-9_]`) / espace |
| `\D` `\W` `\S` | leurs négations |
| `[abc]` | a, b **ou** c | 
| `[^abc]` | tout **sauf** a, b, c |
| `[a-z0-9]` | intervalle |
| `^` `$` | début / fin de chaîne (ou de ligne avec `m`) |
| `\b` | frontière de mot |
| `a\|b` | a **ou** b |
| `(...)` | groupe capturant |
| `(?:...)` | groupe **non** capturant |
| `(?<nom>...)` | groupe nommé |

### Quantificateurs

| | Répétition |
|--|-----------|
| `*` | 0 ou plus |
| `+` | 1 ou plus |
| `?` | 0 ou 1 |
| `{3}` | exactement 3 |
| `{2,5}` | entre 2 et 5 |
| `{2,}` | au moins 2 |

Par défaut les quantificateurs sont **gourmands** (prennent le maximum). Ajouter `?` les rend **paresseux** : `<.+?>` s’arrête à la première balise fermante.

Caractères à échapper avec `\` s’ils sont littéraux : `. * + ? ( ) [ ] { } ^ $ | \ /`.

## `preg_match()` — tester / extraire

Renvoie `1` (correspondance), `0` (aucune) ou `false` (erreur).

```php
if (preg_match('/^\d{5}$/', $codePostal)) {
    // valide
}

// Extraction avec groupes
if (preg_match('#^(\d{4})-(\d{2})-(\d{2})$#', $date, $m)) {
    [$tout, $annee, $mois, $jour] = $m;
}

// Groupes nommés
if (preg_match('/(?<annee>\d{4})-(?<mois>\d{2})/', $s, $m)) {
    echo $m['annee'];
}
```

## `preg_match_all()` — toutes les occurrences

```php
preg_match_all('/#(\w+)/', "Suivez #php et #web", $m);
// $m[0] = ['#php', '#web']   (correspondances complètes)
// $m[1] = ['php', 'web']     (groupe 1)
```

## `preg_replace()` / `preg_replace_callback()`

```php
// Masquer un numéro
echo preg_replace('/\d(?=\d{4})/', '*', '0612345678');  // "******5678"

// Référence à un groupe : $1 ou \1
echo preg_replace('/(\d{2})\/(\d{2})\/(\d{4})/', '$3-$2-$1', '09/09/2026'); // "2026-09-09"

// Traitement dynamique
echo preg_replace_callback('/\d+/', fn($m) => $m[0] * 2, 'a3 b10'); // "a6 b20"
```

## `preg_split()` — découper avec un motif

```php
preg_split('/\s*,\s*/', "a, b ,c ,  d");   // ['a', 'b', 'c', 'd']
preg_split('/(\d)/', 'a1b2', flags: PREG_SPLIT_DELIM_CAPTURE); // garde les séparateurs
```

## Exemples courants

```php
// Slug d’URL
$slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $titre), '-'));

// Validation d’un identifiant : lettre puis lettres/chiffres/_ , 3 à 20 caractères
preg_match('/^[a-z][a-z0-9_]{2,19}$/i', $pseudo);

// Numéro de téléphone français (souple)
preg_match('/^(?:\+33|0)\s?[1-9](?:[\s.-]?\d{2}){4}$/', $tel);
```

## Pièges

- **Accents** : sans l’option `u`, `\w` et `[a-z]` ne couvrent pas `é`, ` à`, `ç`. Avec `u` : `\p{L}` = « toute lettre Unicode ».
- **Valider un e-mail par regex** est notoirement difficile et fragile : utiliser `FILTER_VALIDATE_EMAIL`.
- **Ne jamais analyser du HTML avec une regex** : utiliser `Dom\HTMLDocument` (PHP 8.4) ou `DOMDocument`.
- **`preg_quote()`** : échapper une variable insérée dans un motif (`preg_quote($recherche, '/')`).
- **Catastrophic backtracking** : des motifs comme `(a+)+$` sur une longue chaîne peuvent bloquer le script. Rester simple, ancrer avec `^`/`$`, préférer les quantificateurs bornés.
- Toujours vérifier `preg_match(...) === false` si le motif peut être invalide.

---

## Liens utiles

- [Expressions régulières PCRE (documentation officielle)](https://www.php.net/manual/fr/book.pcre.php)
- [Syntaxe des motifs PCRE](https://www.php.net/manual/fr/reference.pcre.pattern.syntax.php)
- [`preg_match`](https://www.php.net/manual/fr/function.preg-match.php) · [`preg_replace`](https://www.php.net/manual/fr/function.preg-replace.php) · [`preg_split`](https://www.php.net/manual/fr/function.preg-split.php)
- [regex101.com — testeur interactif (choisir « PCRE2 / PHP »)](https://regex101.com/)
- [Classes de caractères Unicode `\p{...}`](https://www.php.net/manual/fr/regexp.reference.unicode.php)
