/*
 * Filters
 */
app.filter('ago', function() {

  return function(input) {
    moment.locale('fr'); // initialisation moment in french
    var dateTime = new Date(input);
    dateTime = moment(dateTime).fromNow();
    // fromNow() : transformer en format humains
    return dateTime;
  };

});
