/*
 * Controller chatController
 */
app.controller('ChatController', function ChatController($scope, $http, $interval) {
// $http permet d'interroger une URL et de retourner les données en JSON
// $interval permet d'exécuter une finction à travers un interval de temps

  $scope.titre = "Mon super chat";
  $scope.messages = [];
  $scope.take = 10;

  //evenement quand je scroll
  $('#slimScrollDiv').scroll(function() {
    // il recupère la position depuis top de mon element slimScrollDiv
    if ($('#slimScrollDiv').scrollTop() >= 125) {
      $scope.take += 10; // augmente le take de 10
    }
  });

  // Je charge mes données en JSON avec le module $http
  $interval(function() {
    $http.get('/admin/chat/' + $scope.take).then(function(response) {
      if (areDifferentById($scope.messages, response.data)) {
        $scope.messages = response.data;
      }
      // response.data sont les données renvoyées du serveur
    });
  }, 3000);

  $scope.add = function () {

    if ($scope.content !== undefined && $scope.content.length > 0) {
      // Request en post via $http
      $http.post('/admin/chat-add',
      { 'content' : $scope.content.trim() })
      // content c'est le name de l'input-group
      // $scope.content c'est la value de l'input
      // envoies des données

      .then(function(response) {
        $scope.content = '';
      });
    }
  };

// End of controller
});
