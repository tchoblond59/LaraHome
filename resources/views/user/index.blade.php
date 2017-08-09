@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Gestion des utilisateurs <a href="{{url('/user/create')}}"><i class="fa fa-plus-square-o pull-right" aria-hidden="true"></i></a></h1><br>
                <div class="col-md-8">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Adresse Mail</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @role('admin')
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ucfirst($user->name)}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a href="{{url('/user/edit/'.$user->id)}}" class="btn btn-default">Editer</a>
                                        <form style="display:inline-block" method="post" action="{{url('/user/delete/'.$user->id)}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="role_id" value="{{$user->id}}">
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>{{ucfirst(Auth::user()->name)}}</td>
                                <td>{{Auth::user()->email}}</td>
                                <td>
                                    <a href="{{url('/user/edit/'.Auth::user()->id)}}" class="btn btn-default">Editer</a>
                                    <form style="display:inline-block" method="post" action="{{url('/user/delete/'.Auth::user()->id)}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="role_id" value="{{Auth::user()->id}}">
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endrole
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection