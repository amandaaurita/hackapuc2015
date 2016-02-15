# Aposta Ai API
API para o aplicativo do Aposta Ai

## Dependencies
* [PHP](https://www.php.net/)
* [Composer](https://getcomposer.org)

## Installing
1. Clone this repo
2. Install [composer](https://getcomposer.org/download/)
3. Configure [conf/propel.json.default](conf/propel.json.default) with the db information and remove the .default
extension
4. Run `composer install`

## Other Commands
### Propel
* `composer build-schema` to generate a schema from a database (requires propel.json configuration)
* `composer build-models` to build propel models from schema
* `composer generate-config` to generate `conf/config.php` from `conf/propel.json`

## Stack
* [Slim 3](http://www.slimframework.com/) for routing/middleware/services [(docs)](http://www.slimframework.com/docs/)
* [Propel](http://propelorm.org/) ORM [(docs)](http://propelorm.org/documentation/)