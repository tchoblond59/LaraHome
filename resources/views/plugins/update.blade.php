@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Mise à jour de la liste des plugins</h1><hr>
            <p>{{$nb_packages_discover}} plugins ont été ajouté à la liste des plugins disponibles</p>
        </div>
    </div>
@endsection