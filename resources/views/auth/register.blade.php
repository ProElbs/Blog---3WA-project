@extends('layout_logout')

@section('content')

  </body>
  <div class="register-box">
    <div class="register-logo">
      <a href="../../index2.html"><b>Back-End</b>BLOG</a>
    </div>
    <!-- /.register-logo -->
    <div class="register-box-body">
      <p class="login-box-msg">Enregistrez-vous !</p>
      <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
          {{ csrf_field() }}
          <div class="form-group has-feedback{{ $errors->has('firstName') ? ' has-error' : '' }}">
            <input type="text" name="firstName" class="form-control" placeholder="Prénom" value="{{ old('firstName') }}">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if ($errors->has('firstName'))
                <span class="help-block">
                    <strong>{{ $errors->first('firstName') }}</strong>
                </span>
            @endif
          </div>
          <!-- /.form-group -->
          <div class="form-group has-feedback{{ $errors->has('lastName') ? ' has-error' : '' }}">
            <input type="text" name="lastName" class="form-control" placeholder="Nom" value="{{ old('lastName') }}">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if ($errors->has('lastName'))
                <span class="help-block">
                    <strong>{{ $errors->first('lastName') }}</strong>
                </span>
            @endif
          </div>
          <!-- /.form-group -->
          <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
          <!-- /.form-group -->
          <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
          <!-- /.form-group -->
          <div class="form-group has-feedback{{ $errors->has('passwordConfirm') ? ' has-error' : '' }}">
            <input type="password" name="passwordConfirm" class="form-control" placeholder="Confirmation mot de passe">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            @if ($errors->has('passwordConfirm'))
                <span class="help-block">
                    <strong>{{ $errors->first('passwordConfirm') }}</strong>
                </span>
            @endif
          </div>
          <!-- /.form-group -->
          <div class="form-group has-feedback{{ $errors->has('phone') ? ' has-error' : '' }}">
            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Téléphone" value="{{ old('phone') }}">
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
          </div>
          <!-- /.form-group -->
          <div class="form-group has-feedback{{ $errors->has('postalCode') ? ' has-error' : '' }}">
            <input type="tel" name="postalCode" class="form-control" placeholder="Code postal" value="{{ old('postalCode') }}">
            <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
            @if ($errors->has('postalCode'))
                <span class="help-block">
                    <strong>{{ $errors->first('postalCode') }}</strong>
                </span>
            @endif
          </div>
          <!-- /.form-group -->
          <div class="form-group has-feedback{{ $errors->has('biography') ? ' has-error' : '' }}">
              <textarea name="biography" id="biography" class="form-control" rows="8" cols="40" placeholder="Bonjour, voici mon message">{{ old('biography') }}</textarea>
              @if($errors->has('biography'))
                <span class="help-block">
                  <strong>{{ $errors->first('biography') }}</strong>
                  </span>
              @endif
          </div>
          <!-- /.form-group -->
          <script type="text/javascript" src="//cdn.ckeditor.com/4.5.11/basic/ckeditor.js"></script>
          <script>
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace( 'biography');
          </script>
          <div class="form-group has-feedback{{ $errors->has('city') ? ' has-error' : '' }}">
            <input type="text" name="city" class="form-control" placeholder="Ville" value="{{ old('city') }}">
            <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
            @if ($errors->has('city'))
                <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
            @endif
          </div>
          <!-- /.form-group -->
          <div class="form-group has-feedback{{ $errors->has('birthDate') ? ' has-error' : '' }}">
            <input type="text" name="birthDate" class="form-control" placeholder="Date de naissance" value="{{ old('birthDate') }}">
            <span class="glyphicon glyphicon-gift form-control-feedback"></span>
            @if ($errors->has('birthDate'))
                <span class="help-block">
                    <strong>{{ $errors->first('birthDate') }}</strong>
                </span>
            @endif
          </div>
          <!-- /.form-group -->
          <div class="form-group has-feedback{{ $errors->has('image') ? ' has-error' : '' }}">
            <label for="image" class="control-label"><i class="fa fa-image"></i> Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" capture />
            @if($errors->has('image'))
              <span class="help-block">
                <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif
          </div>
          <!-- /.form-group -->
          <div class="form-group">
              <div class="col-xs-12">
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="cgu"> J'accepte les CGU
                      </label>
                  </div>
                  <!-- /.checkbox -->
              </div>
              <!-- /.col -->
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <div class="col-xs-6 col-xs-offset-3">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Enregistrer</button>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.form-group -->
      </form>
      <div class="row">
        <div class="col-xs-12">
          <a href="{{ url('/login') }}" class="text-center">J'ai déjà un compte</a>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.register-box-body -->
  </div>
  <!-- /.register-box -->

@endsection
