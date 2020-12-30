# Light PHP library

## How it works

  - The method getTags() in the class TextTagger.php is the entry point of the Sentence. It will output one tag (called Theme in the project) or many tags in an array, depending on the accuracy of the keywords in the Sentence.

  - The others methods are described in the Interfaces.

  - The tests are using separate xml files to avoid any conflict, tests methods require a parameter $env="test" to load the correct xml folder.

## What is the accuracy

  - The accuracy defined in the class Accuracy.php will give us 3 variables.

  - These variables are either ACCURACY_LOW, ACCURACY_MEDIUM or ACCURACY_HIGH. 

  - No keyword found, we get an error message.

  - ACCURACY_LOW means that only 1 keyword have been found in a Theme. We will display potential themes. (As a word can be found in many themes like "glace", "espace", "rayon")

  - ACCURACY_MEDIUM means that 2 keywords were found. We will display 1 theme (or more if its a tie with other themes)

  - ACCURACY_HIGH means that 3 keywords were found. We will display 1 theme. (or more if its a tie with other themes)

## Where to find the Data

  - The data can be added by creating a xml file in the themes folder, it is preferable that the name of the file is the same as the theme tag inside.

  - Then add your words for the theme.

  - The xml files are auto loaded so no need to declare them inside the code.

## The Input

  - 1 : Hier je suis allé au parc avec mon ordinateur portable, ainsi que mon chien et mon chat.
  - 2 : Internet et le HTML sont vraiment formidables! C'est fou comment le web a révolutionné le monde.

## The Output

- Tags returned for sentence 1 : 

  ```php
  [
      'informatique',
      'animaux',
  ];
  ```
- **matched words are:**
*parc*, *ordinateur* for "informatique"
*chien*, *chat* for "animaux"

- Tags returned for sentence 2 : 

  ```php
  [
      'informatique'
  ];
  ```
- **matched words are:**
*Internet*, *HTML*, *web* for "informatique"

## Possible improvements

  - Adding plurial
  - Ignore accents
  - Find closest word after typing error (ex: Ord**o**nateur instead of Ordinateur)
  - Separate ThemesGenerator.php logic into methods for better readability
## Contact

E-mail: lantranbaptiste@gmail.com
