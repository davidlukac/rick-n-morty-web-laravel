# Rick and Morty - Web - Laravel

Laravel-based simple web application that utilizes [The Rick and Morty API](https://rickandmortyapi.com).

## Motivation

This simple application,based on generated Laravel started plate, is a brief demonstration of PHP and Laravel skills,  covering
following requirements:

> Create a simple application (~2hrs) that will demonstrate a knowledge of a modern Layered Architecture. It should
meet the following requirements:
>
> 1. Connect to public API as the datasource.
> 2. Create routes for Rick and Morty characters, episodes, and locations
> 3. Present the data in a table or grid format (does not have to be pretty).
>   1. Allow for filters to be applied
>   2. Use pagination for the results
> 4. A service that will create a PDF for a character profile.
> 5. Integrate with a separate NestJS-based CRUD service to store the following:
>   1. Favourite / Unfavourite: characters, locations, & episodes
>   2. Review and rate episodes
>
> ### Headless CRUD Service
> 1. Favourite characters, locations, & episodes
>    1. Review and rate episodes
>    2. Include text
>    3. Star rating (1-5)
> 2. Create open API definition for your schema (OAS3).
> 3. Write unit tests and show coverage report

## Running the app

1. Check out the repository.
2. Create `.env` from `.env.example` and generate `APP_KEY` (`php artisan key:generate`).
3. Install dependencies - `composer install.`.
4. Generate Backend cli:
   1. See [Fanbase repository](https://github.com/davidlukac/rick-n-morty-fanbase-nestjs) for instructions to make Swagger endpoint available.
   2. Once the Swagger endpoint is available, generate Fanbase client: `make gen-client`.
5. Run the app: `make serve`
6. Navigate to http://localhost:8000/.

### Linters and Formatting

Run `make lint`.

### Tests

Run `make test`.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
