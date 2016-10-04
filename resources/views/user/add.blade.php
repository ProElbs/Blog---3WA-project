{{--
Formulaire de création d'utilisateur (Bonus: Jquery Mask Plugin)
   + nom +  prénom => regex
   + email => validation d'email + unicité
   + password + repeat password => minimum 6 caractère avec 1 maj et 1 minuscule et 1 chiffres minimum
   + Bonus: Encrypter avec la fonction bcrypt() propre à Laravel
   + phone => valider numéro de portable ou fixe
   + code postal: valider numéro
   + biographie: minimum: 15 caractères (Editeur WYSWYG)
   + ville: regex
   + date de naissance : dd/mm/YYYY
   + date_auth => fixé à maintenant

   + Bonus: Ajouter l'image en bdd et prévoir l'upload de l'image en formulaire (https://laravel.com/docs/5.3/requests#retrieving-uploaded-files)


   + Bonus: Créer une page listant tous les utilisateurs sous une jolie table HTML
--}}
@extends('layout')
@section('css')
  @parent
  <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}" title="datepicker">
  <link rel="stylesheet" href="{{ asset('css/user.css') }}" />
  <script type="text/javascript" src="//cdn.ckeditor.com/4.5.11/basic/ckeditor.js"></script>
@endsection
@section('content')
  <div class="row">
    @if(Session::has('success'))
      <div class="col-xs-offset-1 col-xs-10 alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div>
      <!-- /.col -->
    @endif
    <section class="col-xs-offset-1 col-xs-10 ">
      <form enctype="multipart/form-data" role="form" method="post" action="">
        {{ csrf_field() }}
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-user-plus"></i> Nouvel utilisateur !</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row form-group @if($errors->has('firstName')) has-warning @endif">
              <label for="firstName" class="col-md-2 col-sm-12 control-label"><i class="fa fa-user"></i> Prénom</label>
              <div class="col-md-10 col-sm-12">
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Jane" value="{{ old('firstName') }}">
                @if($errors->has('firstName'))
                  <span class="help-block alert alert-danger">{{ $errors->first('firstName') }}</span>
                @endif
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row form-group -->
            <div class="row form-group @if($errors->has('lastName')) has-warning @endif">
              <label for="lastName" class="col-md-2 col-sm-12 control-label"><i class="fa fa-user"></i> Nom</label>
              <div class="col-md-10 col-sm-12">
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Doe" value="{{ old('lastName') }}">
                @if($errors->has('lastName'))
                  <span class="help-block alert alert-danger">{{ $errors->first('lastName') }}</span>
                @endif
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row form-group -->
            <div class="form-group row @if($errors->has('email')) has-warning @endif">
              <label for="email" class="col-sm-12 col-md-2 control-label"><i class="fa fa-envelope"></i> Email</label>
              <div class="col-sm-12 col-md-10">
                <input type="email" class="form-control" id="email" name="email" placeholder="monemail@gmail.com" value="{{ old('email') }}">
                @if($errors->has('email'))
                  <span class="help-block alert alert-danger">{{ $errors->first('email') }}</span>
                @endif
              </div>
              <!-- /.col -->
            </div>
            <!-- /.form-group row -->
            <div class="form-group row @if($errors->has('password')) has-warning @endif">
              <label for="password" class="col-md-4 col-sm-12 control-label"><i class="fa fa-lock"></i> Mot de passe</label>
              <div class="col-md-8 col-sm-12">
                <input type="password" class="form-control" id="password" name="password">
                @if($errors->has('password'))
                  <span class="help-block alert alert-danger">{{ $errors->first('password') }}</span>
                @endif
              </div>
              <!-- /.col -->
            </div>
            <!-- /.form-group row -->
            <div class="row">
              <div class="col-sm-12">
                <div class="passwordInfo">
                  <p>Sécurité du mot de passe (Au minimum 6 caractères, dont : 1 minuscule, 1 majuscule et 1 chiffre)</p>
                  <div class="passwordLevel ">
                    <span></span><span></span><span></span>
                  </div>
                  <!-- /.passwordLevel -->
                </div>
                <!-- /.passwordInfo -->
              </div>
              <!-- /.col-sm-12 -->
            </div>
            <!-- /.row -->
            <div class="form-group row @if($errors->has('passwordConfirm')) has-warning @endif">
              <label for="passwordConfirm" class="col-md-4 col-sm-12 control-label"><i class="fa fa-lock"></i> Confirmation mot de passe</label>
              <div class="col-md-8 col-sm-12">
                <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm">
                @if($errors->has('passwordConfirm'))
                  <span class="help-block alert alert-danger">{{ $errors->first('passwordConfirm') }}</span>
                @endif
              </div>
              <!-- /.col -->
            </div>
            <!-- /.form-group row -->
            <div class="form-group row @if($errors->has('phone')) has-warning @endif">
              <label for="phone" class="col-sm-12 col-md-2 control-label"><i class="fa fa-phone"></i> Téléphone</label>
              <div class="col-sm-12 col-md-10">
                <input type="phone" class="form-control" id="phone" name="phone" placeholder="XX.XX.XX.XX.XX" value="{{ old('phone') }}">
                @if($errors->has('phone'))
                  <span class="help-block alert alert-danger">{{ $errors->first('phone') }}</span>
                @endif
              </div>
              <!-- /.col -->
            </div>
            <!-- /.form-group row -->
            <div class="row form-group @if($errors->has('postalCode')) has-warning @endif">
              <label for="postalCode" class="col-md-2 col-sm-12 control-label"><i class="fa fa-map-marker"></i> Code postal</label>
              <div class="col-md-10 col-sm-12">
                <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="69009" value="{{ old('postalCode') }}">
                @if($errors->has('postalCode'))
                  <span class="help-block alert alert-danger">{{ $errors->first('postalCode') }}</span>
                @endif
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row form-group -->
            <div class="row form-group @if($errors->has('city')) has-warning @endif">
              <label for="city" class="col-md-2 col-sm-12 control-label"><i class="fa fa-map-marker"></i> Ville</label>
              <div class="col-md-10 col-sm-12">
                <input type="text" class="form-control" id="city" name="city" placeholder="Lyon" value="{{ old('city') }}">
                @if($errors->has('city'))
                  <span class="help-block alert alert-danger">{{ $errors->first('city') }}</span>
                @endif
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row form-group -->
            <div class="form-group row @if($errors->has('biography')) has-warning @endif">
              <label for="biography" class="col-md-3 col-sm-12 control-label"><i class="fa fa-comment"></i> biography</label>
              <div class="col-md-9 col-sm-12">
                <textarea name="biography" id="biography" class="form-control" rows="8" cols="40" placeholder="Bonjour, voici mon message">{{ old('biography') }}</textarea>
                @if($errors->has('biography'))
                  <span class="help-block alert alert-danger">{{ $errors->first('biography') }}</span>
                @endif
              </div>
              <!-- /.col -->
              <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'biography');
                </script>
            </div>
            <!-- /.form-group row -->
            <div class="form-group row @if($errors->has('birthDate')) has-warning @endif" >
              <label for="birthDate" class="col-md-3 col-sm-12 control-label"><i class="fa fa-birthday-cake"></i> Date de naissance</label>
              <div class="col-md-9 col-sm-12">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <!-- /.input-group-addon -->
                  <input type="text" class="form-control pull-right" id="birthDate" name="birthDate" placeholder="31/12/1950" value="{{ old('birthDate') }}">
                </div>
                <!-- /.input-groupe date -->
                @if($errors->has('birthDate'))
                  <span class="help-block alert alert-danger">{{ $errors->first('birthDate') }}</span>
                @endif
              </div>
              <!-- /.col -->
            </div>
            <!-- /.form-group row -->
            <div class="form-group row @if($errors->has('image')) has-warning @endif">
              <label for="image" class="col-sm-12 col-md-2 control-label"><i class="fa fa-image"></i> Image</label>
              <div class="col-sm-12 col-md-10">
                <input type="file" class="form-control" id="image" name="image" accept="image/*" capture>
                @if($errors->has('image'))
                  <span class="help-block alert alert-danger">{{ $errors->first('image') }}</span>
                @endif
              </div>
              <!-- /.col -->
            </div>
            <!-- /.form-group row -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Envoyer</button>
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box box-primary -->
      </form>
    </section>
  </div>
  <!-- /.row -->
  @section('js')
    @parent
    <script type="text/javascript" src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  @endsection
@endsection
