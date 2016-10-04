@extends('layout')
@section('css')
  @parent
  <link rel="stylesheet" href="{{ asset('css/detail.css') }}" media="screen" title="no title">
@endsection
@section('content')
  <div class="row">
    <div class="col-md-2 col-xs-12">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h5>Id de l'article</h5>
          @if($article->id === null OR $article->id === '')
            <div class="alert-danger">
              Pas d'id
            </div>
            <!-- /.alert-danger -->
          @else
            <p>{{ $article->id }}</p>
          @endif
        </div>
        <!-- /.inner -->
      </div>
      <!-- /.small-box bg-aqua -->
    </div>
    <!-- /.col-md col-xs-12-->
    <div class="col-md-2 col-xs-12">
      <div class="small-box bg-green">
        <div class="inner">
          <h5>Visibilité</h5>
          @if($article->visibilite === null OR $article->visibilite === '')
            <div class="alert-danger">
              Visibilité non défini
            </div>
            <!-- /.alert-danger -->
          @else
            <p>{{ $article->visibilite }}</p>
          @endif
        </div>
        <!-- /.inner -->
      </div>
      <!-- /.small-box bg-aqua -->
    </div>
    <!-- /.col-md col-xs-12-->
    <div class="col-md-2 col-xs-12">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h5>Note</h5>
          @if($article->note === null OR $article->note === '')
            <div class="alert-danger">
              Pas de note
            </div>
            <!-- /.alert-danger -->
          @else
            <p>{{ $article->note }}</p>
          @endif
        </div>
        <!-- /.inner -->
      </div>
      <!-- /.small-box bg-aqua -->
    </div>
    <!-- /.col-md col-xs-12-->
    <div class="col-md-2 col-xs-12">
      <div class="small-box bg-red">
        <div class="inner">
          <h5>Date de création</h5>
          @if($article->date_creation === null OR $article->date_creation === '')
            <div class="alert-danger">
              Date de création non définie
            </div>
            <!-- /.alert-danger -->
          @else
            <p>{{ $article->date_creation }}</p>
          @endif
        </div>
        <!-- /.inner -->
      </div>
      <!-- /.small-box bg-aqua -->
    </div>
    <!-- /.col-md col-xs-12-->
    <div class="col-md-2 col-xs-12">
      <div class="small-box bg-blue">
        <div class="inner">
          <h5>Date de modification</h5>
          @if($article->date_modification === null OR $article->date_modification === '')
            <div class="alert-danger">
              Date de modification non défini
            </div>
            <!-- /.alert-danger -->
          @else
            <p>{{ $article->date_modification }}</p>
          @endif
        </div>
        <!-- /.inner -->
      </div>
      <!-- /.small-box bg-aqua -->
    </div>
    <!-- /.col-md col-xs-12-->
    <div class="col-md-2 col-xs-12">
      <div class="small-box bg-purple">
        <div class="inner">
          <h5>Année de publication</h5>
          @if($article->annee_publication === null OR $article->annee_publication === '')
            <div class="alert-danger">
              Année de publication non défini
            </div>
            <!-- /.alert-danger -->
          @else
            <p>{{ $article->annee_publication }}</p>
          @endif
        </div>
        <!-- /.inner -->
      </div>
      <!-- /.small-box bg-aqua -->
    </div>
    <!-- /.col-md col-xs-12-->
  </div>
  <!-- /.row -->
  @if($article->titre === null OR $article->titre === '')
    <div class="alert alert-danger">
      Pas de titre
    </div>
    <!-- /.alert-danger -->
  @else
    <h2>{{ $article->titre }}</h2>
  @endif
  <p>Ecrit par:
    @if(App\User::infoUser(['prenom'], $article->user_id) === null)
      Rédacteur inconnu
    @else
      {{ App\User::infoUser(['prenom'], $article->user_id)->prenom }}
      {{ App\User::infoUser(['nom'], $article->user_id)->nom }}
    @endif
    <span class="pull-right">Catégorie: {{ App\Categorie::infoCategorie(['titre'], $article->categorie_id)->titre }}</span></p>
  <p>{{ $article->resume}}</p>
  @if($article->image === null OR $article->image === '')
    <div class="alert alert-danger">
      Pas d'image
    </div>
    <!-- /.alert-danger -->
  @else
    <img src="{{ $article->image }}" alt="{{ $article->titre }}" title ="{{ $article->titre }}" />
  @endif
  @if($article->description === null OR $article->description === '')
    <div class="alert alert-danger">
      Pas de description rédigé
    </div>
    <!-- /.alert-danger -->
  @else
    <p>{{ $article->description}}</p>
  @endif

  <a href="{{ route('articleexportPdf', ['id' => $article->id]) }}" id="exportPdf" class="btn btn-primary">Export PDF</a>

@endsection
