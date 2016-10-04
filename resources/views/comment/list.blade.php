<!-- /*
* Route (Groupage) +  Controller + View
* Lister article
* description soit tronqué à 2000 caractères
* affichage de l'image
* affichage de la note sous forme de badge
* visibilité : afficher icon check ou remove si il est visible ou pas
* date de publication:
*/ -->

@extends('layout')
@section('content')
  <div class="row">
    @if(Session::has('success'))
      <div class="col-xs-offset-1 col-xs-10 alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div>
      <!-- /.col -->
    @endif
    <div class="col-xs-12">
      <div class="small-box bg-aqua">
        <div class="inner">
          {{-- Compte le nombre d'utilisateur dans la table --}}
          <h3>{{ $count }}</h3>
          <p>Commentaires</p>
        </div>
        <!-- /.inner -->
        <div class="icon">
          <i class="ion ion-person"></i>
        </div>
        <!-- /.icon -->
        <a class="btn small-box-footer" href="#commentTable">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
      <!-- /.small-box bg-aqua -->
      <div id="commentTable">
        <div class="well">
          <table class="table table-striped table-condensed table-hover table-responsive">
            <thead>
              <tr>
                <th>Ecrit par</th>
                <th>Article</th>
                <th>Contenu</th>
                <th>Note</th>
                <th>Date de création</th>
                <th>Etat</th>
              </tr>
            </thead>
            <tbody>
              @foreach($comments as $comment)
                <tr>
                  <td>
                    {{ App\User::infoUser(['prenom'], $comment->user_id)->prenom }}
                    {{ App\User::infoUser(['nom'], $comment->user_id)->nom }}                  </td>
                  <td>
                    @if(App\Article::detailArticle(['titre'], $comment->article_id) !== NULL)
                      {{ App\Article::detailArticle(['titre'], $comment->article_id)->titre }}
                    @endif
                  </td>
                  <td>
                    @if($comment->content === NULL OR $comment->content === '')
                      <div class="alert alert-danger">Pas de contenu </div>
                    @else
                      {{ mb_strimwidth($comment->content, 0, 100, "...") }}
                    @endif
                  </td>
                  <td>
                    @if($comment->note === NULL OR $comment->note === '')
                      <div class="alert alert-danger">Pas de note</div>
                    @else
                      <span class="badge">{{ $comment->note }} / 20</span>
                    @endif
                  </td>
                  <td>
                    @if($comment->created_at === NULL OR $comment->created_at === '')
                      <div class="alert alert-danger">Date de création indéfinie </div>
                    @else
                      {{ $comment->created_at }}
                    @endif
                  </td>
                  <td>
                    <a href=" {{ route('commentetat', ['id' => $comment->id]) }}">
                      @if($comment->etat === 0) <i class="fa fa-circle-o text-red"></i> @endif
                      @if($comment->etat === 1) <i class="fa fa-circle-o text-yellow"></i> @endif
                      @if($comment->etat === 2) <i class="fa fa-circle-o text-green"></i> @endif
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
            {{-- Compte le nombre de page restante et affiche previous / next--}}
            {{ $comments->links() }}
          </table>
        </div>
        <!-- /.well -->
      </div>
      <!-- /.commentTable -->
    </div>
    <!-- /.col-xs-12-->
  </div>
  <!-- /.row -->
  {{-- Etat Commentaire --}}
  <div class="row">
    <div class="col-md-4 col-xs-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Etat des commentaires</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: block;">
          <i class="fa fa-circle-o text-green"></i> En ligne
          <span class="label label-primary pull-right">{{ (\App\Comment::where('etat', 2)->count()) }}</span><br>
          <i class="fa fa-circle-o text-yellow"></i> En relecture
          <span class="label label-primary pull-right">{{ (\App\Comment::where('etat', 1)->count()) }}</span><br>
          <i class="fa fa-circle-o text-red"></i> A Supprimer
          <span class="label label-primary pull-right">{{ (\App\Comment::where('etat', 0)->count()) }}</span>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box box-default -->
    </div>
    <!-- /.col -->
    {{-- Widget de Suppression --}}
    <div class="col-md-4 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-trash-o"></i></span>
        <div class="info-box-content">
          <div id="slimScrollDiv3">
            <span class="info-box-text">Suppression définitive
              <span class="label bg-red pull-right">{{ \App\Comment::where('etat', "0")->count() }}</span>
            </span>
            @foreach(\App\Comment::where('etat', '0')->get() as $comment)
              <span class="info-box-number">
                {{ $comment->id }} <i class="fa fa-hand-o-right animated shake" aria-hidden="true"></i>
                  <a href="{{ route('commentdelete', [ "id" => $comment->id]) }}"><i class="fa fa-trash-o"></i></a>
              </span>
            @endforeach
          </div>
          <!-- /#slimScrollDiv3 -->
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
@endsection
@section('js')
  @parent
  <!-- Slimscroll -->
  <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
@endsection
