@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Gestion des roles</h1><br>
                <form class="form-horizontal" method="post" action="{{url('/role/store')}}">
                    <fieldset>
                        {{csrf_field()}}
                        <!-- Form Name -->
                        <legend>Ajouter un role</legend>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">Nom</label>
                            <div class="col-md-4">
                                <input id="name" name="name" placeholder="admin" class="form-control input-md" required="" type="text">
                                <span class="help-block">Le nom du role</span>
                            </div>
                        </div>
                        <div class="col-md-8"><button type="submit" class="btn btn-default pull-right">Ajouter</button></div>
                    </fieldset>
                </form>

            </div>
        </div>
    </div>
@endsection