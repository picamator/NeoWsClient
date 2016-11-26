NeoWsClient
===========

[![PHP 7 ready](http://php7ready.timesplinter.ch/picamator/NeoWsClient/dev/badge.svg)](https://travis-ci.org/picamator/NeoWsClient)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/b3e8fdb6-87cf-4988-80da-1b8b21b450f2/mini.png)](https://insight.sensiolabs.com/projects/b3e8fdb6-87cf-4988-80da-1b8b21b450f2)
Master
------
[![Build Status](https://travis-ci.org/picamator/NeoWsClient.svg?branch=master)](https://travis-ci.org/picamator/NeoWsClient)
[![Coverage Status](https://coveralls.io/repos/github/picamator/NeoWsClient/badge.svg?branch=master)](https://coveralls.io/github/picamator/NeoWsClient?branch=master)

Dev
---
[![Build Status](https://travis-ci.org/picamator/NeoWsClient.svg?branch=dev)](https://travis-ci.org/picamator/NeoWsClient)
[![Coverage Status](https://coveralls.io/repos/github/picamator/NeoWsClient/badge.svg?branch=dev)](https://coveralls.io/github/picamator/NeoWsClient?branch=dev)


NeoWsClient - client for NASA Open Api "[Near Earth Object Web Service](https://api.nasa.gov/neo/?api_key=DEMO_KEY)" or "NeoWs" in short.
All NeoWs data is from the [NASA JPL Asteroid team](http://neo.jpl.nasa.gov/).

NeoWsClient supports NeoWs v1 with resources:

* feed
* neo
* stats

Requirements
------------
* [PHP 5.6](http://php.net/manual/en/migration56.new-features.php) or [PHP 7.0](http://php.net/manual/en/migration70.new-features.php)

Installation
------------
Update to your `composer.json` with:

```json
{
    "require": {
        "picamator/neo-ws-client": "~1.0"
    }
}
```

Examples
--------
To run examples please create parameters.yml in config directory using as a template [parameters.yml.dist](config/parameters.yml.dist).
The `DEMO_KEY` is a valid api token. It has limitation as requests per hour, per day.
More information in [NASA official documentation](https://api.nasa.gov/api.html#authentication).

Example list:

* Statistics: [GET /rest/v1/stats](doc/example/statistics.php)
* Neo: [GET /rest/v1/neo/{asteroid_id}](doc/example/neo.php)
* Neo browse: [GET /rest/v1/neo/browse](doc/example/neo.browse.php)
* Feed: [GET /rest/v1/feed](doc/example/feed.php)
* Feed detailed: [GET /rest/v1/feed](doc/example/feed.detailed.php)
* Feed today: [GET /rest/v1/feed/today](doc/example/feed.today.php)
* Feed today detailed: [GET /rest/v1/feed/today](doc/example/feed.today.detailed.php)
* Wrong resource 404: [GET /rest/v1/wrong-resource](doc/example/wrong.resource.php)
* Wrong api token 403: [GET /rest/v1/wrong-resource](doc/example/wrong.api.key.php)

Arbitrary precision math
------------------------
NeoWsClient formats only Date to DateTime object all others keeps original API's.
NeoWs uses string for long precision float like e.g. `.6304873017364636` execution `floatval` on them would removes last two digits.
Therefore NeoWsClient does not convert strings to `int` or `float`. To make any math with `string floats` please use [BCMath](http://php.net/manual/en/book.bc.php).
BCMath takes care of arbitrary precision mathematics. 

Technical specification
-----------------------
That section describes extension and configuration points.

### Dependency injection
NeoWsClient uses [Symfony DI](https://symfony.com/doc/current/components/dependency_injection.html).
It's configuration in [services.yml](config/services.yml).

### Data mapping
NeoWsClient works with data mapping to create objects based on Api response.
To make customization or build objects from API response it's need to create mapper repository object.
Mapper repository object is a simple data storage over schema with implementation `Mapper\Api\RespositoryInterface`.

The schema contains:

 Name                   | Is required   | Description 
 ---                    | ---           | ---
 source                 | yes           | Key in API response
 destination            | yes           | Property inside NeoWsClient value object
 destinationContainer   | yes           | Name of NeoWsClient object where `destination` property is located
 schema                 | no            | Sub schema
 collectionOf           | no            | Interface name of NeoWsClient objects that will be present inside collection. It's an interface of  `destinationContainer` in `sub-schema`.
 filter                 | no            | Name of NeoWsClient filter object, tha runs over API's data

### Errors
There are three different error types:

* Response HTTP codes: 401, 403, 404
* Response HTTP code 200 with empty body
* Exception

#### Response HTTP codes: 401, 403, 404
In case of getting HTTP codes: 401, 403, 404 or any unsuccessful one application return empty response.
Empty response means valid `Response` object where:

* code: is a http code
* data: `stdClass` over body response string
* rateLimit: valid rate limit object with data if they are present in API's header

#### Response HTTP code 200 with empty body
If API returns empty body with HTTP code 200 with several simultaneously requests. The NeoWsClient Manager rise exception `ManagerException` in that case.
Because HTTP code 200 means OK, but body is wrong therefore NeoWsClient can not distinguish valid/invalid data by HTTP code.

That exception SHOULD be catch without putting any logic like resend, wait 3 sec. then resend again etc.
Instead it's better to have cache over API.

#### Exception
The full exception list that NeoWsClient rises is in [Exception](src/Exception) folder.
If exception rise it means that application can not proceed request, it does not have any business logic in it.

Documentation
-------------
* UML class diagram: [class.diagram.png](doc/uml/class.diagram.png)
* Generated documentation: [phpdoc](doc/phpdoc), please build it following [instruction](dev/phpdoc)

Developing
----------
To configure developing environment please:

1. Follow [install and run Docker container](dev/docker/README.md)
2. Run inside project root in the Docker container `composer install` 

Contribution
------------
If you find this project worth to use please add a star. Follow changes to see all activities.
And if you see room for improvement, proposals please feel free to create an issue or send pull request.
Here is a great [guide to start contributing](https://guides.github.com/activities/contributing-to-open-source/).

Please note that this project is released with a [Contributor Code of Conduct](http://contributor-covenant.org/version/1/4/).
By participating in this project and its community you agree to abide by those terms.

License
-------
NeoWsClient is licensed under the MIT License. Please see the [LICENSE](LICENSE.txt) file for details.
