# API Platform + Vue.js client demo app

This is a demo application, showing the possibilities of using Symfony 6 + Platform 3 API ( OpenAPI & Swagger & JSON+LD with Hydra & View.js SPA client ).

# How to setup

Clone this repo and enter project directory

```sh
git clone https://github.com/mattPiratt/api-platform-demo.git sf-api-demo-test/

cd sf-api-demo-test/
```

Install composer packages

```sh
composer install
```

Create Sqlite DB schema and load example data

```sh
symfony console doctrine:migrations:migrate

symfony console doctrine:fixtures:load
```

Start local web server, and **remember the API Server URL**

```sh
server:start -d
```

Now setup frontend API CLient Single Page Application, by entering application directory and instaling node packages

```sh
cd vueapp/

npm i
```

Setup correct API Server URL, you have remembered above by editing this file (save changes)

```sh
vi src/utils/config.ts
```

Run the Client SPA

```sh
npm run dev
```

Finaly open in the internet browser
`http://localhost:5173/messages` (check if the port 5173 is correct)

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
```

## How this API client was build from scratch (set of commands)

```
npm init vue@latest -- --typescript --router --pinia --eslint-with-prettier vueapp

cd vueapp

npm install dayjs qs @types/qs

npm install -D tailwindcss postcss autoprefixer

npx tailwindcss init -p

npm init @api-platform/client http://127.0.0.1:8004/api/ src/ -- --generator vue

# + adjusting Vue.js app: routes,  forms, config, styles

npm run dev
```
