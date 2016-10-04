@extends('layout')
@section('css')
  @parent
  <link rel="stylesheet" href="{{ asset('css/payment.css') }}" media="screen" title="no title">
@endsection
@section('content')
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      @if(Session::has('success'))
        <div class="col-xs-offset-1 col-xs-10 alert alert-success">
          <p>{{ Session::get('success') }}</p>
        </div>
        <!-- /.alert-success -->
      @endif
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Admin | BLOG, Inc.
          <small class="pull-right">Date: {{ Carbon\Carbon::now('Europe/Paris')->format('d/m/Y') }}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>Admin, Inc.</strong><br>
          24 Rue Emile Corps<br>
          69100, Villeurbanne<br>
          Phone: (804) 123-5432<br>
          Email: info@almasaeedstudio.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</strong><br>
          {{ Auth::user()->code_postal }} {{ Auth::user()->ville }}<br>
          Téléphone: {{ Auth::user()->telephone }}<br>
          Email: {{ Auth::user()->email }}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #007612</b><br>
        <br>
        <b>Order ID:</b> 4F3S8J<br>
        <b>Payment Due:</b> 2/22/2014<br>
        <b>Account:</b> 968-34567
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Article</th>
            <th>Couverture</th>
            <th>Résumé</th>
            <th>Prix</th>
          </tr>
          </thead>
          <tbody>
            @foreach(\App\Article::allFavorite() as $key => $favorite)
              <tr>
                <td>{{ App\Article::find($key)->id }}</td>
                <td>{{ App\Article::find($key)->titre }}</td>
                <td><img src="{{ App\Article::find($key)->image }}" alt="{{ App\Article::find($key)->titre }}" style="border-radius:10%; width:150px;" /></td>
                <td>{{ mb_strimwidth(App\Article::find($key)->resume, 0, 300, "...") }}</td>
                <td>{{ App\Article::find($key)->price }} €</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="lead">Payment Methods:</p>
        <img src="{{ asset('img/credit/visa.png') }}" alt="Visa">
        <img src="{{ asset('img/credit/mastercard.png') }}" alt="Mastercard">
        <img src="{{ asset('img/credit/american-express.png') }}" alt="American Express">
        <img src="{{ asset('img/credit/paypal2.png') }}" alt="Paypal">
        <form id="payment-form" class="text-muted well well-sm no-shadow" style="margin-top: 10px;" action="" method="post">
          {{ csrf_field() }}
          <span class="alert-danger payment-errors"></span>
          <div class="form-group">
            <label for="cardNumber">Numéro de carte</label>
            <input type="tel" class="form-control card-number" id="cardNumber" data-stripe="number" placeholder="XXXX.XXXX.XXXX.XXXX" required>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label for="expiration">Date d'expiration (Mois & Année)</label>
            <input type="tel" class="form-control card-expiry-month" id="expiJour" data-stripe="exp_month" placeholder="01" required>
            <input type="tel" class="form-control card-expiry-year" id="expiMois" data-stripe="exp_year" placeholder="2000" required>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label for="cryptogramme">Cryptogramme</label>
            <input type="tel" class="form-control card-cvc" data-stripe="cvc" id="cryptogramme" placeholder="123" required>
          </div>
          <!-- /.form-group -->
          <div class="form-group clearfix">
            <button type="submit" id="send" class="btn btn-info pull-right"><i class="fa fa-credit-card"></i> Payer</button>
          </div>
          <!-- /.form-group -->
          {{-- A NE SURTOUT PAS FAIRE, CE N'EST PAS SECURE --}}
          {{-- <input type="hidden" name="amount" value="{{ $somme + $somme*0.2 }}"> --}}
        </form>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Amount Due 2/22/2014</p>

        <div class="table-responsive">
          <table class="table">
            <tbody><tr>
              <th style="width:50%">Total HT:</th>
              <td>{{ round($somme, 2) }}€</td>
            </tr>
            <tr>
              <th>Tax (20%):</th>
              <td>{{ round($somme*0.2, 2) }}€</td>
            </tr>
            <tr>
              <th>Total TTC:</th>
              <td>{{ round($somme + $somme*0.2, 2) }}€</td>
            </tr>
          </tbody></table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-xs-12">
        <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
          <i class="fa fa-download"></i> Generate PDF
        </button>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row no-print -->
  </section>
@endsection
@section('js')
  @parent
  <!-- API en JS de stripe -->
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <!-- Stripe JS local -->
  <script type="text/javascript" src="{{ asset('js/stripe.js') }}"></script>
@endsection
