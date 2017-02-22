# oxfordapi-wrapper
A PHP/Laravel Wrapper for oxford dictionary API
## Installation

First, install the package through Composer.
```php
composer require inani/oxfordapi-wrapper
```
Then include the service provider inside config/app.php.
```php
'providers' => [
    ...
    Inani\OxfordApiWrapper\OxfordWrapperServiceProvider::class,
    ...
];
```
At least set up in the env file

```php
OXFORD_API_BASE_URI = 
OXFORD_APP_ID = 
OXFORD_APP_KEY = 
```
make a new instance

```php
// Make it or pass it as argument
$oxford = app(Inani\OxfordApiWrapper\OxfordWrapper::class);
```
## How to use

### Translation
```php
// look for the translation from a language to an other, returns a parser
$parser =$oxford->lookFor('balablabla')
                ->from('en')
                ->to('es')
                ->translate();
                
// get array of translations
$translations = $parser->get();

// get array of [example => [translations]]
$examples = $parser->getExamples();

```
### Definitions
```php
// look for the definitions of a word, returns a parser
$parser =$oxford->lookFor('balablabla')
                ->define();
                
// get array of definitions
$definitions = $parser->get();

```
### Examples
```php
// look for the examples of a word, returns a parser
$parser =$oxford->lookFor('balablabla')
                ->examples();
                
// get array of examples
$definitions = $parser->get();
```
### Thesaurus
```php
// You can try all combinations
$res = $oxford->lookFor('happy')
               ->synonym()
               ->antonym()
               ->fetch();
                
// results will be related to (syno or anto)
// get synonyms and/or antonyms 
$res->get();
// get only antonyms or null if not specfied in fetch
$res->antonyms();
//get only synonyms or null if not specfied in fetch
$res->synonyms();
```
### Phonetics
```php

$res = $oxford->lookFor('ace')
               ->talk();
                
// get the array of result
$res->get();
// get the link to the audio file of pronunciation
$res->speak();
//get the spelling
$res->spell();
//get the notation
$res->notation();
```
