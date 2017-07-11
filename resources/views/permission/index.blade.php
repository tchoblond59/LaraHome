@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Gestion des permissions <a href="{{url('/permission/create')}}"><i class="fa fa-plus-square-o pull-right" aria-hidden="true"></i></a></h1><br>
                <div class="col-md-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Permission</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{ucfirst($permission->name)}}</td>
                            <td>
                                <a href="{{url('/permission/edit/'.$permission->id)}}" class="btn btn-default">Editer</a>
                                <form style="display:inline-block" method="post" action="{{url('/permission/delete/'.$permission->id)}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="permission_id" value="{{$permission->id}}">
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