# Light PHP library

## How it works

  - The method getTags() in the class TextTagger.php is the entry point of the Sentence. **It will output one tag (called Theme in the project) or many tags in an array depending on the keywords of the sentence.**

  - The others methods are described in the Interfaces.

  - The tests are using separate xml files to avoid any conflict, tests methods require a parameter $env="test" to load the correct xml folder.


## Configure Data

  - The data can be added by creating a xml file in the themes folder, it is preferable that the name of the file is the same as the theme tag inside.

  - Then add your words for the theme.

  - Configure plural words. Exemple:
    - "**patate**" will have position at **0** with a **s**, it will give us **patates**.
      -     <word><text>patate</text><pluriel>s</pluriel><position>0</position></word>
    - "**animal**" will have position at **-1** with **ux**, it will give us **animaux**.
      -     <word><text>animal</text><pluriel>ux</pluriel><position>-1</position></word>

  - The xml files are auto loaded so no need to declare them inside the code.

## Input

  - 1 : Hier je suis allé au parc avec mon ordinateur portable, ainsi que mes chiens et mon chat.
  - 2 : Internet et le HTML sont vraiment formidables! C'est fou comment le web a révolutionné le monde.

## Output

- Tags returned for sentence 1 : 

  ```php
  [
      'informatique',
      'animaux',
  ];
  ```
- *matched words are:*
**parc**, **ordinateur** for "informatique",
**chiens** and **chat** for "animaux"

- Tags returned for sentence 2 : 

  ```php
  [
      'informatique'
  ];
  ```
- *matched words are:*
**Internet**, **HTML**, **web** for "informatique"

## Run tests
- `vendor/bin/phpunit --color=always tests` in the project directory.

## Possible improvements
  - Better XML
  - Verbs
  - Ignore accents
  - Find closest word after typing error (ex: Ord**o**nateur instead of Ordinateur)
## Contact

E-mail: lantranbaptiste@gmail.com
