@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Création d'un nouvel utilisateur </h1><hr>
                <form class="form-horizontal" action="{{url('/user/create')}}" method="post">
                    <fieldset>
                        {{csrf_field()}}
                        <!-- Form Name -->
                        <legend>Nouveau Utilisateur</legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">Email</label>
                            <div class="col-md-4">
                                <input id="email" name="email" placeholder="mail@example.com" class="form-control input-md" required="" type="text">
                                <span class="help-block">L'adresse email est utilisé pour se connecter</span>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">Nom</label>
                            <div class="col-md-4">
                                <input id="name" name="name" placeholder="Jean Dujardin" class="form-control input-md" required="" type="text">
                                <span class="help-block">Le prénom et le nom</span>
                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="password">Password</label>
                            <div class="col-md-4">
                                <input id="password" name="password" placeholder="" class="form-control input-md" required="" type="password">

                            </div>
                        </div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-default pull-right">Valider</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
    </div>
@endsection