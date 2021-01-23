# Let's try to do a light PHP library

## Specifications

- The library should solve this specific problem : tagging a text with specific attributes according to it's content.

as an example :

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
## description of my attempt as a solution

- create of a new class : TextTaggerClass 

- define a constant of class which is an array associating each different theme tag with an array of related words.

- In the getTags method, different operations are performed in that order :
    - remove punctuation (preg_replace)
    - split the text into an array of words (explode)
    - for each word (3 embedding loops) :
         - compare it with each related word of each tag theme 
         - count each time a tag word has matched and stock that data into a new associative array
    - sort this new array by frequency of tag in descending order (arsort)
    - keep the 2 more frequently matched tags and return them as an array
    
 
