NeoWsClient
===========

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

Usage
-----
in-progress

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
