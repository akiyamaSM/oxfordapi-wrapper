# oxfordapi-wrapper
A PHP/Laravel Wrapper for oxford dictionary API
## How to use

First set up in the env file

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
