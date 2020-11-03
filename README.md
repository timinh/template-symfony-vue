# template-symfony-vue

Un starter-kit symfony 5 / vue 3
Ce projet comprend : 
 Coté symfony :
 - un exemple de template qui inclue une app vue 3,
 - un service permettant l'envoi de mail via le composant messenger (et rabbitmq)
 - un service permettant de générer des vignettes à partir de fichiers images ou de streams
    (via des urls /images/width/height/nomImage.jpeg ou /images/stream/width/height/nomImage.jpeg)
 Coté vue :
 - une app vue 3 avec un routeur 2 pages exemples,
 - un exemple d'appel à une api publique (Rick & Morty rest api), 
 - un composant card (bootstrap),
 - des exemples d'utilisation "d'api de composition",
 - un système de notifications,
 - un exemple de récupération de variables d'env (cf webpack.config.js et exemple commenté dans Card.vue)
 
 Pour avoir une stack déja configurée, voir https://github.com/timinh/template-docker-symfony
 
 
