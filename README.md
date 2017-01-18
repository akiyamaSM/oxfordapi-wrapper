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
$oxford = app(Inani\OxfordApiWrapper\OxfordWrapper::class);
```

```php
// look for the translation from a language to an other
$oxford->lookFor('balablabla')
               ->from('en')
               ->to('es')
               ->translate();
// grab result object
$result = $oxford->get();

// get array of translations
$translations = $result->getTranslations();

// get array of [example => [translations]]
$examples = $result->getExamples();

```
