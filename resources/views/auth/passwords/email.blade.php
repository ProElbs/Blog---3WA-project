@extends('layout_logout')
@section('content')
  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>Back-end</b>BLOG</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Reste de votre mot de passe</p>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}
            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="control-label">Adresse mail :</label>
              <input type="email" name="email" class="form-control" placeholder="Email">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
            </div>
            <!-- /.form-group -->
            <div class="form-group">
                <div class="col-xs-6 col-xs-offset-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-envelope"></i> Envoyer un lien de reset
                    </button>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.form-group -->
        </form>
        <a href="{{ url('/login') }}" class="text-center">Je me souviens finalement</a>
      </div>
      <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection
