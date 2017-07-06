@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Gestion du scénario <small>{{$scenario->name}}</small></h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Commandes</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($scenario->mscommands as $mscommand)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$mscommand->name}}</td>
                            <td>
                                <form style="display:inline-block" method="post" action="{{url('/scenario/mscommand/delete/'.$scenario->id)}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="mscommand" value="{{$mscommand->id}}">
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr>
                <form class="form-horizontal" method="post" action="{{url('/scenario/mscommand/add/'.$scenario->id)}}">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Ajouter une commande</legend>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{csrf_field()}}
                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="mscommand">Commande</label>
                            <div class="col-md-4">
                                <select id="mscommand" name="mscommand" class="form-control">
                                    @foreach($mscommands as $command)
                                        <option value="{{$command->id}}">{{$command->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-default pull-right">Ajouter</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection