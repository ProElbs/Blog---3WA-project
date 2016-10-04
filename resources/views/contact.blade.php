@section('css')
  @parent
  <link rel="stylesheet" href="{{ asset('css/contact.css') }}" media="screen" title="no title">
@endsection
@extends('layout')
@section('content')

  <div class="row">
    @if(Session::has('success'))
      <div class="col-xs-offset-1 col-xs-10 alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div>
    @endif
    <section class="col-xs-offset-1 col-xs-10 ">
      <form role="form" method="post" action="">
        {{ csrf_field() }}
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-feed"></i> Contactez-nous !</h3>
            <!-- /.box-header -->
          </div>
          <div class="box-body">
            <div class="form-group row @if($errors->has('name')) has-warning @endif">
              <label for="name" class="col-sm-3 col-md-2 col-xs-12 control-label"><i class="fa fa-user"></i> Nom</label>
              <div class="col-sm-9 col-md-10 col-xs-12">
                <input type="text" class="form-control" id="name" name="name" placeholder="Doe" value="{{ old('name') }}">
                @if($errors->has('name'))
                  <span class="help-block alert alert-danger">{{ $errors->first('name') }}</span>
                @endif
              </div>
              <!-- /.form-group row -->
            </div>
            <div class="form-group row @if($errors->has('optionSex')) has-warning @endif">
              <label for="gender" class="col-sm-3 col-md-2 col-xs-12 control-label"><i class="fa fa-venus"></i> <i class="fa fa-mars"></i> Sexe</label>
              <div class="col-sm-9 col-md-10 col-xs-12">
                <div class="radio">
                  <label>
                    <input type="radio" name="optionSex" id="male" value="male" @if (old('optionSex') == "male") checked @endif> Homme
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="optionSex" id="female" value="female" @if (old('optionSex') == "female") checked @endif> Femme
                  </label>
                </div>
                @if($errors->has('optionSex'))
                  <span class="help-block alert alert-danger">{{ $errors->first('optionSex') }}</span>
                @endif
              </div>
              <!-- /.form-group row -->
            </div>
            <div class="form-group row @if($errors->has('email')) has-warning @endif">
              <label for="email" class="col-sm-3 col-md-2 col-xs-12 control-label"><i class="fa fa-envelope"></i> Email</label>
              <div class="col-sm-9 col-md-10 col-xs-12">
                <input type="email" class="form-control" id="email" name="email" placeholder="monemail@gmail.com" value="{{ old('email') }}">
                @if($errors->has('email'))
                  <span class="help-block alert alert-danger">{{ $errors->first('email') }}</span>
                @endif
              </div>
              <!-- /.form-group row -->
            </div>
            <div class="form-group row @if($errors->has('website')) has-warning @endif">
              <label for="website" class="col-sm-3 col-md-2 col-xs-12 control-label"><i class="fa fa-desktop"></i> Site web</label>
              <div class="col-sm-9 col-md-10 col-xs-12">
                <input type="text" class="form-control" id="website" name="website" placeholder="http://www.monsupersite.com" value="{{ old('website') }}">
                @if($errors->has('website'))
                  <span class="help-block alert alert-danger">{{ $errors->first('website') }}</span>
                @endif
              </div>
              <!-- /.form-group row -->
            </div>
            <div class="form-group row @if($errors->has('subject')) has-warning @endif">
              <label for="subject" class="col-sm-3 col-md-2 col-xs-12 control-label"><i class="fa fa-list-alt"></i> Sujet</label>
              <div class="col-sm-9 col-md-10 col-xs-12">
                <select class="form-control" name="subject" id="subject">
                  <option value="contact" @if (old('subject') == "contact") selected="selected" @endif>Prise de contact</option>
                  <option value="article" @if (old('subject') == "article") selected="selected" @endif>Rédaction d'un article</option>
                  <option value="partnership" @if (old('subject') == "partnership") selected="selected" @endif>Demande de partenariat</option>
                  <option value="other" @if (old('subject') == "other") selected="selected" @endif>Autre</option>
                </select>
              </div>
              <!-- /.form-group row -->
            </div>
            <div class="form-group row" id="meeting">
              <label for="dateContact" class="col-sm-3 col-md-2 col-xs-12 control-label">Prise de contact</label>
              <div class="col-sm-9 col-md-10 col-xs-12">
                <input type="date" name="dateContact" id="dateContact" class="form-control">
              </div>
              <!-- /.form-group row -->
            </div>
            <div class="form-group row @if($errors->has('message')) has-warning @endif">
              <label for="message" class="col-sm-3 col-md-2 col-xs-12 control-label"><i class="fa fa-comment"></i> Message</label>
              <div class="col-sm-9 col-md-10 col-xs-12">
                <textarea name="message" id="message" class="form-control" rows="8" cols="40" placeholder="Bonjour, voici mon message">{{ old('message') }}</textarea>
                @if($errors->has('message'))
                  <span class="help-block alert alert-danger">{{ $errors->first('message') }}</span>
                @endif
              </div>
              <!-- /.form-group row -->
            </div>
            <div class="form-group row">
              <div class="col-sm-9 col-md-10 col-sm-offset-2 col-xs-12">
                <label class="control-label">
                  <input type="checkbox" name="generalTerms"/> Conditions générales d'utilisations
                </label>
                @if($errors->has('generalTerms'))
                  <span class="help-block alert alert-danger">{{ $errors->first('generalTerms') }}</span>
                @endif
              </div>
              <!-- /.form-group row -->
            </div>
            <!-- /.box-body -->
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Envoyer</button>
          </div>
          <!-- /.box box-primary -->
        </div>

        {{-- Affiche toutes les erreurs par rapport au champ rempli en groupe --}}
        {{-- @if(count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif --}}
        {{-- Fin d'affichage des erreurs groupé --}}
        <!-- /.box-body -->
      </form>
    </section>
  </div>
@endsection
