@extends('layout')
@section('css')
  @parent
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <link rel="stylesheet" href="{{ asset('/css/homepage.css') }}" media="screen" title="no title">
@endsection
@section('content')
<main>
    <div class="row">
      @if(Session::has('success'))
        <div class="col-xs-offset-1 col-xs-10 alert alert-success">
          <p>{{ Session::get('success') }}</p>
        </div>
        <!-- /.alert-success -->
      @endif
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Articles en ligne</span>
            <span class="info-box-number">{{ $nbArticle }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Catégories remplies</span>
            <span class="info-box-number">{{ $nbCategorie }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Médias utilisés</span>
            <span class="info-box-number">{{ $nbMedia }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Commentaires actifs</span>
            <span class="info-box-number">{{ $nbComment }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Répartition des articles par catégorie</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
            <!-- /.box-tools-->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <canvas id="articles-chart" data-url="{{ route('statsCategories') }}" style="height: 182px; width: 365px;" height="182" width="365"></canvas>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col-6 -->
      <div class="col-sm-6 col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Commentaires par article</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body chart-responsive">
            <div class="chart" id="comments-chart" data-url="{{ route('statsArticles') }}" style="height: 300px; position: relative;">
            </div>
            <!-- /.chart -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-sm-12 col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Commentaires sur les 5 dernières années</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body chart-responsive">
            <div id="comment-chart-5-year" data-url="{{ route('statsComments') }}" style="height: 250px;">
            </div>
            <!-- /.comment-chart -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-sm-12 col-xs-12" ng-controller="ChatController">
        <div class="box box-success">
          <div class="box-header with-border" style="cursor: move;">
            <i class="fa fa-comments-o"></i>
            <h3 class="box-title">##titre##</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="slimScrollDiv">
              <!-- chat item -->
              <div class="item" ng-repeat="message in messages">
                <div class="row">
                  {{-- <img src="dist/img/user4-128x128.jpg" alt="user image" class="online" /> --}}
                  <div class="col-xs-8">
                    <p class="chatMessage">##message.content##</p>
                  </div>
                  <!-- /.col -->
                  <div class="col-xs-4">
                    ##message.created_at|ago##
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.item -->
            </div>
            <!-- /.slimScrollDiv -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="item">
              <form ng-submit="add()">
                {{ csrf_field() }}
                <input ng-model="content" class="form-control" placeholder="Votre message...">
              </form>
            </div>
            <!-- /.item -->
          </div>
          <!-- /.box-header -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12" ng-controller="ArticleController">
        <div class="box box-warning">
          <div class="box-header with-border">
            <div class="user-block">
              <h3 class="username" data-article="{{ $oneRandomArticle->id }}">{{ $oneRandomArticle->titre }}</h3>
              <span class="description">Categorie : {{ $categorieRandomArticle }}</span>
            </div>
            <!-- /.user-block -->
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body chart-responsive">
            <p>{{ $oneRandomArticle->resume }}</p>
            <div class="attachment-block clearfix">
              <img src="{{ $oneRandomArticle->image }}" alt="{{ $oneRandomArticle->titre }}" title="{{ $oneRandomArticle->titre }}" />
              <a href="" data-toggle="modal" data-target="#articleModal">En lire plus</a>
              <!-- Modal -->
              <div class="modal fade" id="articleModal" tabindex="-1" role="dialog" aria-labelledby="articleModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="articleModalLabel">{{ $oneRandomArticle->titre }}</h4>
                    </div>
                    <!-- /.modal-header -->
                    <div class="modal-body">
                      <img src="{{ $oneRandomArticle->image }}" alt="{{ $oneRandomArticle->titre }}" title="{{ $oneRandomArticle->titre }}" />
                      <p>{{ $oneRandomArticle->description }}</p>
                    </div>
                    <!-- /.modal-body -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                      <a href="{{ route('articledetail', ['id' => $oneRandomArticle->id]) }}" type="button" class="btn btn-default">En lire plus</a>
                    </div>
                    <!-- /.modal-footer -->
                  </div>
                  <!-- /.modal-content -->
                </div>
              </div>
              <!-- /.modal fade -->
            </div>
            <!-- /.attachment-block clearfix -->
            <!-- Social sharing buttons -->
            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
            @if($nbCommentOfArticle != 0)
                <span class="pull-right text-muted">{{ $nbCommentOfArticle }} commentaires</span>
          </div>
          <!-- /.box-body-->
          <div class="box-footer box-comments">
            <div id="slimScrollDiv2">
              <div class="box-comment" ng-repeat="comment in comments">
                <img class="img-circle img-sm" src="uploads/##comment.image##" alt="##comment.prenom## ##comment.nom##">
                <div class="comment-text">
                  <span class="username">
                    ##comment.prenom## ##comment.nom##
                    <span class="text-muted pull-right">##comment.created_at|ago##
                      <a href=" {{ route('commentetat', ['id' => '##comment.id##']) }}">
                        <span ng-if="comment.etat == 0"><i class="fa fa-circle-o text-red"></i></span>
                        <span ng-if="comment.etat == 1"><i class="fa fa-circle-o text-yellow"></i></span>
                        <span ng-if="comment.etat == 2"><i class="fa fa-circle-o text-green"></i></span>
                      </a>
                    </span>
                  </span><!-- /.username -->
                  ##comment.content##
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
            </div>
            <!-- /.slimScrollDiv2 -->
          </div>
          @elseif($nbCommentOfArticle == 0)
              <span class="pull-right text-muted">Pas encore de commentaires</span>
          </div>
          <!-- /.box-body -->
        @endif
        <div class="box-footer">
          <form>
            {{ csrf_field() }}
            <label for="content">Commentaire</label>
            <input ng-model="content" id="content" class="form-control" placeholder="Votre commentaire..." />
            <label for="note">Note</label>
            <input ng-model="note" id="note" class="form-control" placeholder="Votre note..." />
            <button ng-click="add()" type="button" name="button" class="btn btn-primary">Valider</button>
          </form>
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box-->
    </div>
    <!-- /.col-->
    <div ng-controller="VideoController">
      <div class="col-xs-6" ng-repeat="data in datas">
        <div class="box box-info" >
          <div class="box-header with-border">
            <i class="fa fa-video-camera"></i>##data.titre##
            <span class="pull-right">##data.created_at|ago##</span>
          </div>
          <!-- /.box-header -->
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="##formattage(data.url)##" frameborder="0" allowfullscreen></iframe>
            <p>##data.description##</p>
          </div>
          <!-- /.embed-responsive -->
          <div class="box-footer">
            <p class="pull-right"><i ng-click="remove(data)" class="fa fa-times"></i></p>
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-xs-12">
        <div class="box ">
          <div class="box-header">
              <h3><i class="fa fa-video-camera"></i> Créer une vidéo</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form >
              <input class="form-control" type="text" ng-model="titre" required placeholder="Titre">
              <textarea class="form-control"  ng-model="description" required placeholder="Description.."></textarea>
              <input class="form-control" type="url" ng-model="url" required placeholder="Url: youtube, dailymotion">
              <input class="form-control" type="text" ng-model="annee" required placeholder="Année de sortie">
              <input class="form-control" type="text" ng-model="created_at" required placeholder="Date de sortie">
              <button ng-click="add()" type="submit" class="btn btn-primary" name="button"><i class="fa fa-check"></i>Ajouter la vidéo</button>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Mes twittos</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
            <!-- /.box-tools-->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            @foreach($tweets as $key => $tweet)
              <div class="row" style="display:flex;align-items:center;justify-content:center;">
                <div class="col-xs-2">
                  <img src="{{ $tweet->user->profile_image_url }}" style="border-radius:50%;height:auto" alt="{{ $tweet->user->name }}">
                </div>
                <div class="col-xs-10">
                  <h4><a href="{!! Twitter::linkUser($tweet->user->name) !!}">{{ $tweet->user->name }}</a></h4>
                  <p><small>{{ Twitter::ago($tweet->created_at) }}</small></p>
                  <p>{!! Twitter::linkify($tweet->text) !!}</p>
                </div>
              </div>
            @endforeach
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <form class="" action="{{ route('addTweet') }}" method="post">
              {{ csrf_field() }}
              <textarea name="tweet" class="form-control" required rows="3" cols="10" pattern="/^.{3,}$/i"></textarea>
              <button type="submit" class="btn btn-info" name="tweeter"><i class="fa fa-pencil-square-o"></i> Tweeter</button>
            </form>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col-6 -->
    </div>
    <!-- /.ng-controller -->
  </div>
  <!-- /.row -->
</main>
@endsection
@section('js')
  @parent
  <!-- ChartJS 1.0.1 -->
  <script src=" {{ asset('plugins/chartjs/Chart.min.js') }}"></script>
  <!-- Morris.js charts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="../../plugins/morris/morris.min.js"></script>
  <script src="{{ asset('js/charts.js') }}"></script>
  <!-- Initialisation app -->
  <script type="text/javascript" src="{{ asset('js/appInitialization.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/filters.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
  <!-- ChatController -->
  <script type="text/javascript" src="{{ asset('js/ChatController.js') }}"></script>
  <!-- ArticleController -->
  <script type="text/javascript" src="{{ asset('js/ArticleController.js') }}"></script>
  <!-- VideoController -->
  <script type="text/javascript" src="{{ asset('js/VideoController.js') }}"></script>
  <!-- Moment -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment-with-locales.min.js">

  </script>
@endsection
