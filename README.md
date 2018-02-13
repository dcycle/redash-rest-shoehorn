Redash API shoehorn
=====

This is just a **proof-of-concept**.

[Redash](https://redash.io) is business intelligence software which brings together several data sources.

Among those data sources are REST API URLs, for example [Star Wars characters](https://swapi.co/api/people/?format=json) or [Cities' air quality](https://api.openaq.org/v1/cities).

However, results need to be [Redash's specific format](http://help.redash.io/article/120-using-a-url-as-a-data-source), so we need some of translating our data sources to what is expected from Redash.

This is what this project attempts to do.

Usage
-----

Make sure you have a public server, and run this:

    docker run -d -v "$(pwd)":/var/www/html -p 9999:80 php:apache
