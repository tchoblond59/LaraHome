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
                    @foreach($scenario->commands()->withPivot('id')->orderBy('ordre')->get() as $command)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$command->name}}</td>
                            <td>
                                <form style="display:inline-block" method="post" action="{{url('/scenario/command/delete/'.$scenario->id)}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="command" value="{{$command->id}}">
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="submit" class="btn btn-sm btn-secondary" form="cmdMoveUp_{{$command->pivot->id}}"><i class="fa fa-arrow-up"></i></button>
                                    <button type="submit" class="btn btn-sm btn-secondary" form="cmdMoveDown_{{$command->pivot->id}}"><i class="fa fa-arrow-down"></i></button>
                                </div>
                                <form method="post" action="{{url('/scenario/command/moveUp/'.$scenario->id)}}" id="cmdMoveUp_{{$command->pivot->id}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="scenario_command" value="{{$command->pivot->id}}">
                                </form>
                                <form method="post" action="{{url('/scenario/command/moveDown/'.$scenario->id)}}" id="cmdMoveDown_{{$command->pivot->id}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="scenario_command" value="{{$command->pivot->id}}">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal" method="post" action="{{url('/scenario/command/add/'.$scenario->id)}}">

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
                                            <div class="col">
                                                <select id="command" name="command" class="form-control">
                                                    @foreach($commands as $command)
                                                        <option value="{{$command->id}}">{{$command->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <button type="submit" class="btn btn-primary float-right">Ajouter</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="{{url('scenario/cron/edit/'.$scenario->id)}}">
                                    {{csrf_field()}}
                                    <fieldset>
                                        <!-- Form Name -->
                                        <legend>Cron</legend>
                                        <div class="form-group">
                                            <label for="cron_scenario">Cron</label>
                                            <input type="text" name="cron" class="form-control" id="cron_scenario" placeholder="45 9 * * *" value="{{$scenario->cron}}">
                                        </div>
                                        <button type="submit" class="btn btn-primary float-right">Valider</button>

                                    </fieldset>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection