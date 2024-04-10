.PHONY: help install start build composer console run-unit-test run-integration-test

help: ##- Show this help.
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m\033[0m\n"} /^[$$()% a-zA-Z0-9_-]+:.*?##/ { printf "  \033[36m%-35s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)

build: ##- build docker image
	@docker-compose build --parallel --pull --force-rm --no-cache

install: ##- install app
	@docker-compose up -d
	@docker-compose exec web composer install --prefer-dist
	@touch var/data.db var/data-test.db
	@chmod 666 var/data.db var/data-test.db
	@docker-compose exec web php bin/console d:s:u --force
	@docker-compose exec web php bin/console --env=test d:s:u --force

start: ##- start app on http://127.0.0.1:8089/
	@docker-compose up -d --force-recreate

composer: ##- composer (make composer CMD=install)
	@docker-compose exec web composer ${CMD}

console: ##- symfony console (make console CMD=clear:cache)
	@docker-compose exec web php bin/console ${CMD}

run-unit-test: ##- execute unit test suit
	@docker-compose exec web bin/phpunit --testsuite Unit

run-integration-test: ##- execute integration test suit
	@docker-compose exec web bin/phpunit --testsuite Integration

run-e2e-test: ##- execute e2e test suit
	@docker-compose exec web bin/phpunit --testsuite E2E

run-test: run-unit-test run-integration-test run-e2e-test ##- execute all test suit




