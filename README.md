# Let's try to do a light PHP library

## Specifications

- The library should solve this specific problem : tagging a text with specific attributes according to it's content.

Example: 

We have 2 texts:

  - 1 : I love how my kitchen is decorated. My dog loves it to.
  - 2 : I need a new television in my living-room.

- So, tags returned for sentence 1 should be something like : 

```php
[
    'animal',
    'house',
];
```

- And tags for sentence 2 should be something like : 

```php
[
    'house',
    'technology',
];
```

## How did I proceed ? 

First, I created a constant where I put the main Tags and the words that refers to each of them. 
I transformed my string in an array and I looped into it. 
I did the same for my constant and for each correspondance, I put the TagFamily in an empty Array. 

Then I sorted it by alphabtical order and I returned the result. 


