@extends('layout')
@section('content')
  <div class="row">
    <div class="col-xs-10 col-xs-offset-1">
      <div class="small-box bg-aqua">
        <div class="inner">
          {{-- Compte le nombre d'utilisateur dans la table --}}
          <h3>{{ $count }}</h3>
          <p>Utilisateurs</p>
        </div>
        <!-- /.inner -->
        <div class="icon">
          <i class="ion ion-person"></i>
        </div>
        <!-- /.icon -->
        <a class="btn small-box-footer" role="button" data-toggle="collapse" href="#collapseTable" aria-expanded="false" aria-controls="collapseTable">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
      <!-- /.small-box bg-aqua -->
      <div class="collapse" id="collapseTable">
        <div class="well">
          <table class="table table-striped table-condensed table-hover table-responsive">
            <thead>
              <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              {{-- $users est la variable disponible en vue  --}}
              @foreach($users as $user)
                <tr>
                  <td>{{ $user->nom }}</td>
                  <td>{{ $user->prenom }}</td>
                  <td>{{ $user->email }}</td>
                </tr>
              @endforeach
            </tbody>
            {{-- Compte le nombre de page restante et affiche previous / next--}}
            {{ $users->links() }}
          </table>
        </div>
        <!-- /.well -->
      </div>
      <!-- /.collapse #collapseTable -->
    </div>
    <!-- /.col-xs-10 col-xs-offset-1 -->
  </div>
  <!-- row -->


@endsection
