@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{url('/dashboard/create')}}">
                    <fieldset>
                    {{csrf_field()}}
                    <!-- Form Name -->
                        <legend>Nouveau tableau de bord</legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">Nom</label>
                            <div class="col-md-4">
                                <input id="name" name="name" type="text" placeholder="Dashboard 1" class="form-control input-md">
                                <span class="help-block">Entrer le nom de votre tableau de bord</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <button class="btn btn-secondary pull-right">Ajouter</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection