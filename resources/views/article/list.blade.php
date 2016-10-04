<!-- /*
* Route (Groupage) +  Controller + View
* Lister article
* description soit tronqué à 2000 caractères
* affichage de l'image
* affichage de la note sous forme de badge
* visibilité : afficher icon check ou remove si il est visible ou pas
* date de publication: annee
* afficher la date de création  au format : jour / mois / annee à Heure: Minute
*/ -->

@extends('layout')
@section('css')
  @parent
  <link rel="stylesheet" href="{{ asset('css/article.css') }}" >
@endsection
@section('content')
  <div class="row">
    @if(Session::has('success'))
      <div class="col-xs-offset-1 col-xs-10 alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div>
      <!-- /.alert-success -->
    @endif
    @if(Session::has('danger'))
      <div class="col-xs-offset-1 col-xs-10 alert alert-danger">
        <p>{{ Session::get('danger') }}</p>
      </div>
      <!-- /.alert-danger -->
    @endif
    <div class="col-xs-12">
      <div class="small-box bg-aqua">
        <div class="inner">
          {{-- Compte le nombre d'utilisateur dans la table --}}
          <h3>{{ $count }}</h3>
          <p>Articles</p>
        </div>
        <!-- /.inner -->
        <div class="icon">
          <i class="ion ion-person"></i>
        </div>
        <!-- /.icon -->
        <a class="btn small-box-footer" href="#articleTable">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
      <!-- /.small-box bg-aqua -->
      <div id="articleTable">
        <div class="well">
          <table class="table table-striped table-condensed table-hover table-responsive">
            <thead>
              <tr>
                <th></th>
                <th></th>
                <th>titre</th>
                <th>Résumé</th>
                <th>Note</th>
                <th>Année Publication</th>
                <th>Visibilité</th>
                <th>date de création</th>
              </tr>
            </thead>
            <tbody>
              @foreach($articles as $article)
                <tr>
                  <td>
                    <div class="delete">
                      <a href="{{ route('articledelete', ['id' => $article->id]) }}"><i class="fa fa-trash-o fa-2x"></i></a>
                    </div>
                    <!-- /.delete -->
                  </td>
                  <td>
                    <div class="favorite">
                      @if(\App\Article::favoriteOrNot($article->id))
                        <a href="{{ route('articlefavorite', ['id' => $article->id, 'titre' => $article->titre]) }}"><i class="fa fa-heart fa-2x"></i></a>
                      @else
                        <a href="{{ route('articlefavorite', ['id' => $article->id, 'titre' => $article->titre]) }}"><i class="fa fa-heart-o fa-2x"></i></a>
                      @endif
                    </div>
                    <!-- /.favorite -->
                  </td>
                    <td>
                        @if($article->titre === NULL OR $article->titre === '')
                          <div class="alert alert-danger">
                            Pas de titre
                          </div>
                          <!-- /.alert-danger -->
                        @else
                          <a href="{{ route('articledetail', ['id' => $article->id]) }}">
                          {{ $article->titre }}
                        </a>
                        @endif
                    </td>
                    <td>
                      @if($article->resume === NULL OR $article->resume === '')
                        <div class="alert alert-danger">
                          Pas de résumé
                        </div>
                        <!-- /.alert-danger -->
                      @else
                        {{ mb_strimwidth($article->resume, 0, 50, "...") }}
                      @endif
                    </td>
                    <td>
                      @if($article->note === NULL OR $article->note === '')
                        <div class="alert alert-danger">
                          Pas de note
                        </div>
                        <!-- /.alert-danger -->
                      @else
                        <span class="badge">{{ $article->note }} / 20</span>
                      @endif
                    </td>
                    <td>
                      @if($article->annee_publication === NULL OR $article->annee_publication === '')
                        <div class="alert alert-danger">
                          Année de publication indéfinie
                        </div>
                        <!-- /.alert-danger -->
                      @else
                        {{ $article->annee_publication }}
                      @endif
                    </td>
                    <td>
                      @if($article->visibilite)
                        <a href="{{ route('articlevisibilite', ['id' => $article->id, 'visibilite' => $article->visibilite]) }}"><i class="fa fa-check"></i></a>
                      @else
                        <a href="{{ route('articlevisibilite', ['id' => $article->id, 'visibilite' => $article->visibilite]) }}"><i class="fa fa-close"></i></a>
                      @endif
                    </td>
                    <td>
                      <?php $date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->date_creation); ?>
                      {{ $date->format('d/m/Y H:i') }}
                    </td>
                </tr>
              @endforeach
            </tbody>
            {{-- Compte le nombre de page restante et affiche previous / next--}}
            {{ $articles->links() }}
          </table>
        </div>
        <!-- /.well -->
      </div>
      <!-- /.carticleTable -->
    </div>
    <!-- /.col-xs-12-->
  </div>
  <!-- /.row -->
@endsection
