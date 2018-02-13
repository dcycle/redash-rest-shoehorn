Redash API shoehorn
=====

This is just a **proof-of-concept**.

[Redash](https://redash.io) is business intelligence software which brings together several data sources.

Among those data sources are REST API URLs, for example [Star Wars characters](https://swapi.co/api/people/?format=json) or [Cities' air quality](https://api.openaq.org/v1/cities).

However, results need to be [Redash's specific format](http://help.redash.io/article/120-using-a-url-as-a-data-source), so we need some of translating our data sources to what is expected from Redash.

This is what this project attempts to do.

Usage
-----

Make sure you have a public server, for example at 1.2.3.4, and run this:

    docker run -d -v "$(pwd)":/var/www/html -p 9999:80 php:apache

Make sure the following URLs return valid info:

* http://1.2.3.4:9999/?source=https%3A%2F%2Fapi.openaq.org%2Fv1%2Fcities
* http://1.2.3.4:9999/?source=https://swapi.co/api/people/?_format=json

Go to your Redash app and add a new URL data source with base path http://1.2.3.4:9999/

Create a new query "Star Wars Characters" with:

* index.php?source=https%3A%2F%2Fapi.openaq.org%2Fv1%2Fcities

Create a new query "Cities with air quality info" with:

* index.php?source=https%3A%2F%2Fswapi.co%2Fapi%2Fpeople%2F%3F_format%3Djson

**Make sure you URL encode the source, or Redash will not accept your queries**.

Create a dashboard with these two data sources.
