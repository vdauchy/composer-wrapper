Composer Wrapper
================

How to use:
```php
use VDauchy\ComposerWrapper\Json;
use VDauchy\ComposerWrapper\JsonSections\NameSection;
use VDauchy\ComposerWrapper\JsonSections\RequireSection;
use VDauchy\ComposerWrapper\ProjectBuilder;
/**
 * Create a local project using composer local binary.
 */
$project = (new ProjectBuilder(`~/project/path`))->build();

/**
 * Edit `composer.json`.
 */
$project->json(fn(Json $json) => $json
    ->name(fn(NameSection $nameSection) => $nameSection
        ->put("My new project name"))
    ->require(fn(RequireSection $requireSection) => $requireSection
        ->add("psr/log", "^1.1")
        ->add("ext-json", "*")
        ->remove("ext-ast")));

/**
 * Update the dependencies. 
 */
$project->composer()->update();   
```

Build docker image:
```shell script
docker-compose build;
```

Install dependencies:
```shell script
docker run -v $(pwd):/usr/src/app composer-wrapper:latest composer install;
```

Run Tests:
```shell script
docker run -v $(pwd):/usr/src/app composer-wrapper:latest composer style;
docker run -v $(pwd):/usr/src/app composer-wrapper:latest composer unit;
docker run -v $(pwd):/usr/src/app composer-wrapper:latest composer lint;
docker run -v $(pwd):/usr/src/app composer-wrapper:latest composer infection;
```