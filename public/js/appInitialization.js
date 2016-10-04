var app = angular.module('app', ['firebase']); // initialisation de l'app (et du module externe firebase)

// Configuration de l'affichage de nos données de la scope
app.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('##').endSymbol('##');
  });
