@extends('layout_logout')

@section('content')

  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>Back-end</b>BLOG</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Connectez-vous</p>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
              <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
            </div>
            <!-- /.form-group -->
            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
              <input type="password" name="password" class="form-control" placeholder="Password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
            </div>
            <!-- /.form-group -->
            <div class="form-group">
                <div class="col-xs-6 col-xs-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Se souvenir de moi
                        </label>
                    </div>
                    <!-- /.checkbox -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.form-group -->
            <div class="form-group">
                <div class="col-xs-6 col-xs-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-sign-in"></i> Connexion
                    </button>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.form-group -->
        </form>
        <a href="{{ url('/password/reset') }}">J'ai oublié mon mot de passe</a><br>
        <a href="{{ url('/register') }}" class="text-center">Je n'ai pas encore de compte, je veux m'enregistrer</a>
      </div>
      <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

@endsection
