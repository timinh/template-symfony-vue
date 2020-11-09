APP_ENV := $$(grep APP_ENV= .env.local | cut -d '=' -f2-)

.PHONY: help install-php install-js install consume clear

help: ## Affiche cette aide
	@clear
	@echo 'Liste des commandes disponibles : '
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install-php: ## Installation des dépendances via composer
	@composer install

install-js: ## Installation des dépendances js (utile seulement en prod)
	@yarn && yarn build

install: install-php install-js ## Lance les commandes 'install-php' puis 'install-js'

consume: ## Démarre les services messenger
	php bin/console messenger:consume async

## -- Maintenance --
clear: ## Vide le cache
	@php bin/console cache:clear --env=$(APP_ENV)