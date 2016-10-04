<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('uploads/'.Auth::user()->image) }}" class="img-circle" alt="User Image">
      </div>
      <!-- /.pull-left -->
      <div class="pull-left info">
        <p>{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
      <!-- /.pull-left -->
    </div>
    <!-- /.user-panel -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
      <!-- /.input-group -->
    </form>
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="treeview"><a href="{{ route('contact')}}"><i class="fa fa-rss"></i><span> Nous contacter</span></a></li>
      <li class="treeview"><a href="{{ route('media')}}"><i class="fa fa-file-video-o"></i><span> Ajout d'un media</span></a></li>
      <li class="treeview">
        <a href=""><i class="fa fa-user"></i><span> Utilisateur</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu" style="display: none;">
          <li><a href="{{ route('useradd')}}"><i class="fa fa-user-plus"></i> Ajouter un utilisateur</a></li>
          <li><a href="{{ route('userlist')}}"><i class="fa fa-dashboard"></i> Gestion des utilisateurs</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href=""><i class="fa fa-pencil"></i><span> Article</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu" style="display: none;">
          <li><a href="{{ route('articlelist')}}"><i class="fa fa-dashboard"></i> Gestion des articles</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href=""><i class="fa fa-comments"></i><span> Commentaires</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu" style="display: none;">
          <li><a href="{{ route('commentlist')}}"><i class="fa fa-dashboard"></i> Gestion des commentaires</a></li>
        </ul>
      </li>
      <li class="treeview"><a href="{{ route('concept')}}"><i class="fa fa-lightbulb-o"></i><span> Concept</span></a></li>
      <li class="treeview"><a href="{{ route('faq')}}"><i class="fa fa-question-circle"></i><span> FAQ</span></a></li>
      <li class="treeview"><a href="{{ route('about')}}"><i class="fa fa-users"></i><span> A propos de nous</span></a></li>
    </ul>
  </section>
</aside>
