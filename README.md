# API Platform + Vue.js client demo app

This is a demo application, showing the possibilities of using Symfony 6 + Platform 3 API ( OpenAPI & Swagger & JSON+LD with Hydra & View.js SPA client ).

## Prerequirements

- Docker desktop v.4.x (engine 20)

## How to setup

Clone this repo and enter project directory

```sh
git clone https://github.com/mattPiratt/api-platform-demo.git sf-api-demo-test/

cd sf-api-demo-test/
```

Build docker images and then start services

```sh
docker compose build --no-cache --pull

SERVER_NAME="app.localhost" docker compose up --wait -d
```

Create Sqlite DB schema and load example data

```sh
docker exec -it sf-api-php-1 bin/console doctrine:fixtures:load -n
```

Now setup frontend API CLient Single Page Application. Enter application directory and instaling node packages

```sh
docker exec -it --workdir /srv/app/vueapp/ sf-api-php-1 npm i
```

Run the Client SPA

```sh
docker exec -it --workdir /srv/app/vueapp/ sf-api-php-1 npm run dev
```

Finaly open in the internet browser:

`https://app.localhost/api` - to see Swagger API panel

`http://localhost:5173/messages` - to see Vue.js client

## How this API server was build from scratch (set of commands)

```
$ symfony new sf-api

$ composer require api

$ symfony composer require symfony/uid

$ symfony composer require maker --dev

$ symfony composer require orm-fixtures --dev

$ symfony composer require debug --dev

$ symfony console make:entity Message # + defining entity here manually

$ symfony server:start -d

$ symfony console make:migration

$ symfony console doctrine:migrations:migrate

$ symfony console make:fixtures MessageFixture # + defining example data manualy

$ symfony console doctrine:fixtures:load

$ symfony composer require nesbot/carbon

# adding docker env: https://github.com/dunglas/symfony-docker/blob/main/docs/existing-project.md
```

## How this API client was build from scratch (set of commands)

```
npm init vue@latest -- --typescript --router --pinia --eslint-with-prettier vueapp

cd vueapp

npm install dayjs qs @types/qs

npm install -D tailwindcss postcss autoprefixer

npx tailwindcss init -p

npm init @api-platform/client http://localhost/api/ src/ -- --generator vue

# + adjusting Vue.js app: routes,  forms, config, styles

npm run dev
```
