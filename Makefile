.PHONY: help install

help: ## Affiche cette aide
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install-php: ##Installation des dépendances via composer
	@composer install

install-js: ##Installation des dépendances js (utile seulement en prod)
	@yarn && yarn build

install: install-php install-js ##Lance les commandes 'install-php' puis 'install-js'

consume: #Démarre les services messenger
	php bin/console messenger:consume async