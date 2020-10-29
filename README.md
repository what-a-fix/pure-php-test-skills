# Let's try to do a light PHP library

## Specifications

- The library should solve this specific problem : tagging a text with specific attributes according to it's content.

## At your disposal to start the project

- [x] Interface that define the public library API

## What we expect

- [ ] A functional library of course :)

- [ ] The library MUST be tested, so you have to provide unit testing series in the project

## I don't really understand specs !

Ok, let me show you an example :

- Let's say we've got two text (french text) :

  - 1 : Cette après-midi je suis allé manger une glace avec mes parents au parc. Puis nous avons fait une grande ballade.
  - 2 : Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.

- So, tags returned for sentence 1 should be something like : 

```php
[
    'family',
    'walk',
];
```

- And tags for sentence 2 should be something like : 

```php
[
    'leak',
    'bathroom',
];
```

This is a proof of concept , you don't have to create the whole scope for any kind of thematics tag. Keep focus about one or two thematics, and make it works and detect well...

## How to submit ?

To introduce your project, please start by forking this repo and submit a pull request when you think it is OK.

Please do not forget to write a README other than this one, fill it with any information you feel is relevant.

## Need extra information ? Questions about the project ? ...

For any further question, contact me by email - 2m@whatafix.com
