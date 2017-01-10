# Flypay

A technical test for FlyPay. The following demonstrates a basic `GET` / `POST` microservice, allowing consumers to register their apps and store dummy payment data.

## Pre-Requisites

The below assumes docker is installed on the local machine. If not, visit https://docs.docker.com/engine/installation/ and follow the instructions.

Docker has been used locally for the following.

- Composer
- PHP 7.x
- MySQL 5.7

Use the following commands to install and run containers.

_Note: docker-compose has not been utilized._

### Composer

We're going to pull `composer/composer` for the moment, and we'll use this container to install ours deps.

```
docker pull composer/composer
```

### MySQL 5.7

We'll pull the `5.7` version of the MySQL docker container. The container hasn't been modifided (unlike `php:7.0`), so we'll run the container as a daemon, passing our chosen root password (modify `YOUR_ROOT_PASSWORD`).

```
docker pull mysql:5.7
docker run --name flypay-db -p 3306:3306 -e MYSQL_ROOT_PASSWORD=YOUR_ROOT_PASSWORD -d mysql:5.7
```

### PHP 7.0

We've customized the `php:7.0` container by installing `pdo` and `xdebug` by default. Build the container and run with the following commands.

```
docker build -t flypay .
docker run --name flypay -p:8881:8881 -v $(pwd):/app -w /app --link flypay-db:mysql -d flypay php -S 0.0.0.0:8881 -t public
```

Docker should now show 2 running containers, `flypay` and `flypay-db`.

## Getting Started

First off, we'll need to clone the repository.

```
git clone https://github.com/steadweb/FlyPay.git
```

Next, install depending with `composer`, using the docker container we pulled earlier.

```
docker run -i --rm -v ~/.ssh:/root/.ssh -v $(pwd):/app composer/composer install
```

In order to setup the DB, you'll need to setup your `.env` and create the database. The `.env` file should be located within the root of the project, and should contain the following values:

_Note: Find the IP of the `flypay-db` container using `docker inspect <container_id>`._

```
DB_HOST=IP_ADDRESS_OF_THE_MYSQL_CONTAINER
DB_NAME=flypay_steadweb
DB_USER=root
DB_PASS=YOUR_ROOT_PASSWORD
```

_Note: I understand it's bad practice using the `root` user, but this is for a technical task / development purposes, hence the usage of `.env`._

You will need to create the database, migrations won't do this for you. Create a database, using docker, with the following command:

```
docker run -it --link flypay-db:mysql --rm mysql sh -c 'exec mysql -h"$MYSQL_PORT_3306_TCP_ADDR" -P"$MYSQL_PORT_3306_TCP_PORT" -uroot -p"$MYSQL_ENV_MYSQL_ROOT_PASSWORD" -e "create database flypay_steadweb;"'
```

Once the database has been created, run the migrations.

```
docker run --rm -v $(pwd):/app -w /app --link flypay-db:mysql flypay php vendor/bin/doctrine-migrations migrations:migrate --configuration configuration.yml
```

The microserivce has now been installed with demo data.

### Authentication

The microservice leverages JWT to auth an app against the API. Out of the box, 1 app is registered, but it's suggested for an app to register it's own `public_key` using the `/client/register` endpoint.

Without relying on this micoservice to provide a JWT, it's put the reliance on the application itself, storing the  `public_key` and validating the signature within middleware.

You can use the following JWT when testing the app.

```
eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvZmx5cGF5LnN0ZWFkd2ViLmNvbSIsImF1ZCI6Imh0dHBzOlwvXC9mbHlwYXkuc3RlYWR3ZWIuY29tIn0.J6yRvezHHJwM-9_nyHd-2PmcRDIAtqmJlHKcgEEuWxP1A6--A5K7bvm0Khy_527QlC3-0NpuEfev_yRt2MIxOVgoSsn_jDt2Ny3wDUNFWdaAWwme6TeTm5TVtszTcj1hI1JXoFfxbkY1kIzafKQCZFLIKNh08HoKjk2PHrZV2J6k7PUTnzxoZ-Fv6UpsbbV9_e4XbPbjVtrY23-OlYeM8gldQif2EMaFTY8SIDuN6OtBVDJoGG--rsHOFfI1nGjzBDnFAvfLJixGZLPT_DC4YhRK--H2kJLwcLUOzxKB63b5gWHHdCddSWADLgQ-nOZsA8LyHQcCJqY7C1QumhBhLQ
```

The following JSON object is the correct payload for the `/client/register` endpoint. You'll notice the `public_key` is base64 encoded, this is _required_ and the endpoint will fail if it detects a malformed `public_key`.

```
{
  "domain" : "https://your.domain.tld",
  "public_key" : base64_encode($your_public_key)
}
```

The response should be the `uuid` of the entity which has been created. You don't have to note this down, it's just confirmation the `public_key` was registered correctly.

```
{
  "id" : "randomly_generated_uuid"
}
```

### Basic Example

You can request data from any of the endpoints mentioned below. Out of the box, the microservice supplies demo data. The JWT needs to be set as a header for each request (apart from registering a client).

#### Request

```
GET /api/v1/payments
Host: http://localhost:8881
Content-Type: application/json
token: eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvZmx5cGF5LnN0ZWFkd2ViLmNvbSIsImF1ZCI6Imh0dHBzOlwvXC9mbHlwYXkuc3RlYWR3ZWIuY29tIn0.J6yRvezHHJwM-9_nyHd-2PmcRDIAtqmJlHKcgEEuWxP1A6--A5K7bvm0Khy_527QlC3-0NpuEfev_yRt2MIxOVgoSsn_jDt2Ny3wDUNFWdaAWwme6TeTm5TVtszTcj1hI1JXoFfxbkY1kIzafKQCZFLIKNh08HoKjk2PHrZV2J6k7PUTnzxoZ-Fv6UpsbbV9_e4XbPbjVtrY23-OlYeM8gldQif2EMaFTY8SIDuN6OtBVDJoGG--rsHOFfI1nGjzBDnFAvfLJixGZLPT_DC4YhRK--H2kJLwcLUOzxKB63b5gWHHdCddSWADLgQ-nOZsA8LyHQcCJqY7C1QumhBhLQ
```

#### Response

```
[
  {
    "id": "f3a50212-d35d-11e6-872b-0242ac110002",
    "amount": 9000,
    "gratuity": null,
    "reference": "ADS67dgftyt5fytsdTYF",
    "card": {
      "id": "d18d7f82-d35d-11e6-872b-0242ac110002",
      "last4": "6482",
      "type": "AMEX"
    },
    "tables": [
      {
        "id": "d63cc628-d35d-11e6-872b-0242ac110002",
        "seats": 4
      }
    ],
    "location": {
      "id": "d8e62678-d35d-11e6-872b-0242ac110002",
      "title": "Foo",
      "address": "1 Bar Road, Baz Town",
      "latitude": "12318297812712",
      "longitude": "-12735162537123"
    },
    "created": {
      "date": "2017-01-05 15:45:15.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "updated": null
  }
]
```

### Endpoints

All endpoints can be found [here](http://docs.steadwebflypay.apiary.io/#).

## Tests

Unit tests are run using `phpunit` via the `php:7.0` container.

```
docker run --rm -v $(pwd):/app -w /app --link flypay-db:mysql flypay php vendor/bin/phpunit tests -c phpunit.xml.dist
```
