@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Gestion de l'utilisateur {{$user->name}} <a href="{{url('/user/create')}}"><i class="fa fa-plus-square-o pull-right" aria-hidden="true"></i></a></h1><br>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Role</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->roles as $role)
                            <tr>
                                <td>{{ucfirst($role->name)}}</td>
                                <td>
                                    <form style="display:inline-block" method="post" action="{{url('/user/deleteRole/'.$user->id)}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="role_id" value="{{$role->id}}">
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <form class="form-horizontal" method="post" action="{{url('/user/addRole/'.$user->id)}}">
                        <fieldset>
                        {{csrf_field()}}
                        <!-- Form Name -->
                            <legend>Ajouter un role à {{$user->name}}</legend>

                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="permission">Role</label>
                                <div class="col-md-4">
                                    <select id="role" name="role" class="form-control">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8"><button type="submit" class="btn btn-default pull-right">Ajouter</button></div>
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection