{{--
+ Créer une page avec un formulaire de création de Media
les pages sont les suivante:
* Titre du média (regex)
* Liste déroulante avec page existante
* Vidéo (url de dailymotion , youtube ou vimeo)
* Visibilité (Oui ou Non)
+ Date d'activation (Format d/m/Y à valider et la date doit etre supérieur a aujourd'hui)
--}}
@extends('layout')
@section('css')
  @parent
  <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}" title="datepicker">
@endsection
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
            <h3 class="box-title"><i class="fa fa-file-video-o"></i> Formulaire media !</h3>
          </div>
          <div class="box-body">
            <div class="form-group row @if($errors->has('title')) has-warning @endif">
              <label for="title" class="col-sm-3 col-md-2 col-xs-12 control-label"><i class="fa fa-video-camera"></i> Titre</label>
              <div class="col-sm-9 col-md-10 col-xs-12">
                <input type="text" class="form-control" id="title" name="title" placeholder="Video de laravel en action" value="{{ old('title') }}">
                @if($errors->has('title'))
                  <span class="help-block alert alert-danger">{{ $errors->first('title') }}</span>
                @endif
              </div>
              <!-- /.form-group row -->
            </div>
            <div class="form-group row @if($errors->has('page')) has-warning @endif">
              <label for="page" class="col-sm-3 col-md-2 col-xs-12 control-label"><i class="fa fa-paperclip"></i> Page</label>
              <div class="col-sm-9 col-md-10 col-xs-12">
                <select class="form-control" name="page" id="page">
                  @foreach(App\Page::all() as $key => $value)
                    <option value="{{ $value->id }}" @if (old('page') == $value->id) selected="selected" @endif>{{ $value->titre }}</option>
                  @endforeach
                </select>
              </div>
              <!-- /.form-group row -->
            </div>
            <div class="form-group row @if($errors->has('url')) has-warning @endif">
              <label for="url" class="col-sm-3 col-md-2 col-xs-12 control-label"><i class="fa fa-link"></i> URL</label>
              <div class="col-sm-9 col-md-10 col-xs-12">
                <input type="text" class="form-control" id="url" name="url" placeholder="http://www.monsupersite.com" value="{{ old('url') }}">
                @if($errors->has('url'))
                  <span class="help-block alert alert-danger">{{ $errors->first('url') }}</span>
                @endif
              </div>
              <!-- /.form-group row -->
            </div>
            <div class="form-group row @if($errors->has('visibility')) has-warning @endif">
              <label for="visibility" class="col-sm-3 col-md-2 col-xs-12 control-label"><i class="fa fa-eye"></i></i> Visibilité</label>
              <div class="col-sm-9 col-md-10 col-xs-12">
                <div class="radio">
                  <label>
                    <input type="radio" name="visibility" id="yes" value="1" @if (old('visibility') == "1") checked @endif> Oui
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="visibility" id="no" value="0" @if (old('visibility') == "0") checked @endif> Non
                  </label>
                </div>
                @if($errors->has('visibility'))
                  <span class="help-block alert alert-danger">{{ $errors->first('visibility') }}</span>
                @endif
              </div>
              <!-- /.form-group row -->
            </div>
            <div class="form-group row @if($errors->has('activatedAt')) has-warning @endif" >
              <label for="activatedAt" class="col-sm-3 col-md-2 col-xs-12 control-label"><i class="fa fa-plug"></i> Date d'activation</label>
              <div class="col-sm-9 col-md-10 col-xs-12">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="activatedAt" name="activatedAt" value="{{ old('activatedAt') }}">
                </div>
                @if($errors->has('activatedAt'))
                  <span class="help-block alert alert-danger">{{ $errors->first('activatedAt') }}</span>
                @endif
              </div>
              <!-- /.form-group row -->
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Envoyer</button>
            </div>
            <!-- /.box box-primary -->
          </div>
        </div>
      </form>
    </section>
  </div>
  @section('js')
    @parent
    <script type="text/javascript" src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  @endsection
@endsection
