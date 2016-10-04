  <header class="main-header">
    <!-- Logo -->
    <a href="{{ route('homepage')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li><a href="{{ route('langue', ['locale' => 'fr']) }}">Fr</a></li>
          <li><a href="{{ route('langue', ['locale' => 'en']) }}">En</a></li>
          <li><a href="{{ route('langue', ['locale' => 'al']) }}">Al</a></li>
          <!-- Cart of articles like -->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-heart-o"></i>
              <span class="label label-danger">{{count(App\Article::allFavorite())}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Vous avez {{count(App\Article::allFavorite())}} @if(count(App\Article::allFavorite())>1) favoris @else favori @endif</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  @if(session()->has('favoriteArticle'))
                    @foreach(\App\Article::allFavorite() as $key => $favorite)
                      <li><!-- start message -->
                          <div class="pull-left">
                            <a href="{{ route('articleclearFavorite', ['id' => $key]) }}"><i class="fa fa-close fa-2x"></i></a>
                          </div>
                          <!-- /.pull-left -->
                            <a href="{{ route('articledetail', ['id' => $key]) }}">{{ $favorite }}</a>
                      </li>
                    @endforeach
                  @endif
                </ul>
              </li>
              @if(session()->has('favoriteArticle') && count(session('favoriteArticle', [])) > 0)
                <li><a href="{{ route('articleclearFavorite') }}" class=""><i class="fa fa-trash-o"></i> Tout supprimer</a></li>
                <li><a href="{{ route('articlesummaryPayment') }}"><i class="fa fa-credit-card"></i> Passer au payement</a></li>
              @endif

            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('uploads/'.Auth::user()->image) }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('uploads/'.Auth::user()->image) }}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
                  <small>Inscrit {{ Auth::user()->created_at->diffForHumans() }}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <!-- /.col -->
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <!-- /.col -->
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profil</a>
                </div>
                <!-- /.pull-left -->
                <div class="pull-right">
                  <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Déconnexion</a>
                </div>
                <!-- /.pull-left -->
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
      <!-- /.navbar-custom-menu -->
    </nav>
  </header>
