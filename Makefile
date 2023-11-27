serve:
	@php artisan serve

lint:
	@.\vendor\bin\pint
	@.\vendor\bin\phpstan analyse . --memory-limit=521M

test:
	@.\vendor\bin\phpunit --coverage-html reports/ ./tests/

gen-client:
	docker run --rm -v "$(CURDIR)/app/ApiClients/Fanbase:/local/out/php" openapitools/openapi-generator-cli generate -i http://host.docker.internal:3000/api-json -g php -o /local/out/php --invoker-package FanbaseApiClient
	@composer dump-autoload
	@composer install
