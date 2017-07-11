@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Gestion des roles <a href="{{url('/role/create')}}"><i class="fa fa-plus-square-o pull-right" aria-hidden="true"></i></a></h1><br>
                <div class="col-md-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Role</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ucfirst($role->name)}}</td>
                            <td>
                                <a href="{{url('/role/edit/'.$role->id)}}" class="btn btn-default">Editer</a>
                                <form style="display:inline-block" method="post" action="{{url('/role/delete/'.$role->id)}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="role_id" value="{{$role->id}}">
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection