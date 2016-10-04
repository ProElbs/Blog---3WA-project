// demarrage de Jquery
$(function(){


  // connection à notre Compte par la clef primaire (identifiant)
  Stripe.setPublishableKey(getenv('STRIPE_SECRET'));

  $form =  $('#payment-form');
  // submit : quand je soumet mon formulaire
  $form.submit(function(event) {

    // Disable the submit button to prevent repeated clicks:
    $(this).find('#send').attr('disabled');

    // Request a token from Stripe:
    Stripe.card.createToken({
       number: $('.card-number').val(),
       cvc: $('.card-cvc').val(),
       exp_month: $('.card-expiry-month').val(),
       exp_year: $('.card-expiry-year').val()
     }, function (status, response) {
       if (response.error) { // Ah une erreur !
         // On affiche les erreurs
         $form.find('.payment-errors').text(response.error.message);
         $form.find('button').prop('disabled', false); // On réactive le bouton
       } else { // Le token a bien été créé
         var token = response.id; // On récupère le token
         console.log(token);
         // Cacher le boutton
         $form.find('#send').hide();
         // On crée un champs cachée qui contiendra notre token
         $form.append($('<input type="hidden" name="stripeToken" />').val(token));
         $form.get(0).submit(); // On soumet le formulaire
       }
     });

    // Prevent the form from being submitted:
    return false;
  });
});
