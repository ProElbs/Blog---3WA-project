/*
 * Controller articleController
 */
app.controller('ArticleController', function ArticleController($scope, $http, $interval) {
  $scope.idArticle = $("h3.username").data("article");
  $scope.comments = [];

  $interval(function() {
    $http.get('/admin/comment-article/' + $scope.idArticle).then(function(response) {
      if (areDifferentById($scope.comments, response.data)) {
        $scope.comments = response.data;
        // response.data sont les données renvoyées du serveur
      }
    });
  }, 3000);

  $scope.add = function () {

    if ($scope.content !== undefined && $scope.content.length > 0 && $scope.note !== undefined && $scope.note.length > 0) {
      // Request en post via $http
      $http.post('/admin/comment-add/' + $scope.idArticle,
      { 'content' : $scope.content.trim(),
        'note' : $scope.note.trim()
      })
      // content c'est le name de l'input
      // $scope.content c'est la value de l'input
      // envoies des données

      .then(function(response) {
        $scope.content = '';
        $scope.note = '';
      });
    }
  };

// End of controller
});
