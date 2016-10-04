@extends('layout')
@section('content')
    <h3>La foire aux questions... L'endroit ou un âne pourrait avoir le savoir du monde entier</h3>
    <div class="">
      <img src="{{ asset('img/questionMark.png')}}" alt="Point d'interrogation" titre="Point d'interrogation" width="257" height="360"/>
    </div>
    <a href="{{ route('homepage')}}">Retour</a>
@endsection
