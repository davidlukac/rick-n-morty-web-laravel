# Rick and Morty - Web - Laravel

Laravel-based simple web application that utilizes [The Rick and Morty API](https://rickandmortyapi.com).

## Motivation

This simple application, based on generated [Laravel started plate](https://laravel.com/docs/10.x#creating-a-laravel-project),
is a brief demonstration of PHP and Laravel skills, covering following requirements:

> Simple application (~2-3 hours of effort) that will demonstrate a knowledge of a modern Layered Architecture. It
> should meet the following requirements:
>
> 1. Connect to public API as the datasource.
> 2. Create routes for Rick and Morty characters, episodes, and locations
> 3. Present the data in a table or grid format (does not have to be pretty).
>    1. Allow for filters to be applied
>    2. Use pagination for the results
> 4. A service that will create a PDF for a character profile.
> 5. Integrate with a separate [NestJS-based CRUD service](https://github.com/davidlukac/rick-n-morty-fanbase-nestjs) to
>    store the following:
>    1. Favourite / Un-favourite: characters, locations, & episodes
>    2. Review and rate episodes
>
> ### Headless CRUD Service
>
> 1. Favourite characters, locations, & episodes.
> 2. Review and rate episodes:
>    1. Include text.
>    2. Star rating (1-5).
> 3. Create open API definition for your schema (OAS3).
> 4. Write unit tests and show coverage report.

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
