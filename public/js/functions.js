/**
 * Functions
 */
function areDifferentById(a, b) {
 var idA = a.map(function(x) { return x.id; }).sort();
 var idB = b.map(function(x) { return x.id; }).sort();
 return (idA.join(',') !== idB.join(','));
}
