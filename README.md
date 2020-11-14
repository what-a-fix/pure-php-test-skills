# Let's try to do a light PHP library

## Specifications

- The library should solve this specific problem : tagging a text with specific attributes according to it's content.

## What is expected

- [ ] A functional library of course :)

- [ ] The library MUST be tested, so you have to provide unit testing series in the project

## I don't really understand specs !

  - 1 : Cette après-midi je suis allé manger une glace avec mes parents au parc. Puis nous avons fait une grande ballade.
  - 2 : Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.

```php
[
    'family',
    'walk',
];
```

```php
[
    'leak',
    'bathroom',
];
```


## How I tried to solve it
The easiest way:
I made a list of labels[] which contained the matching words.
I looped through the each labels & each matching word.
For each word, using a regex I searched the whole text for a matching word.
If there is a match, the label is added, and the loop skips to the next label.

This technique have a 2 fold complexity, the size of the nb of labels/label[] size, and the size of the text. BigO(n2).

In order to reduce the time constraint in tried an other method:
The labels are organized as following word=>label in order to avoid looping on the labels.
I split the text into words using a regex.
Then loop only on the words of the text. 
For each word if there is a matching label, I add it.
I though it would have a linear complexity. But the time test on a big string (1500x) was 13s, whereas the first solution was about 5-6 seconds.
It also had some big limitations like not recognizing composed words if they were separated by a space.

The actual TextTagger has some room for improvements.
One possibility would be to add a constant for each word to match to indicate the plural management if there is any exception.
For example:
````php
const LABEL_LIST = [
    'school' => [
        ['page'], //default => add 's'
        ['oral', 2], //=> -'l'  + 'ux'
        ['travail', 3] //=>-'il' + 'aux'
    ],
    'boat' => [
        ['bateau', 1] //add 'x'
    ]
];
````
Then add the corresponding plural to match for a finer control. 
