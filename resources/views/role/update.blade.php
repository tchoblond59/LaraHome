@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Gestion du role {{$role->name}}</h1><br>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Permission</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($role->permissions as $permission)
                        <tr>
                            <td>{{ucfirst($permission->name)}}</td>
                            <td>
                                <form style="display:inline-block" method="post" action="{{url('/role/deletePermission/'.$role->id)}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="permission_id" value="{{$permission->id}}">
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <form class="form-horizontal" method="post" action="{{url('/role/update/'.$role->id)}}">
                    <fieldset>
                        {{csrf_field()}}
                        <!-- Form Name -->
                        <legend>Modifier le role</legend>
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
                                <input id="name" name="name" placeholder="admin" class="form-control input-md" required="" type="text" value="{{$role->name}}">
                                <span class="help-block">Le nom du role</span>
                            </div>
                        </div>
                        <div class="col-md-8"><button type="submit" class="btn btn-default pull-right">Editer</button></div>
                    </fieldset>
                </form>
            </div>
            @include('role.addPermission')
        </div>
    </div>
@endsection