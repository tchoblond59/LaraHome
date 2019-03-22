@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Liste des actions disponible</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Commande</th>
                        <th>Cron</th>
                        <th>Action</th>
                        <th>Etat</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($commands as $command)
                        <tr>
                            <td>{{$command->name}}</td>
                            <td>{{$command->cron}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button class="btn btn-primary btn-sm play_command_btn" type="submit"
                                            form="play_command_{{$command->id}}"><i
                                                class="fas fa-play"></i> Jouer
                                    </button>
                                    @if($command->url)
                                        <a class="btn btn-secondary btn-sm"
                                           href="{{url('command/shortcut/'.$command->url)}}"><i
                                                    class="fas fa-link"></i> Raccourci</a>
                                    @else
                                        <button class="btn btn-secondary btn-sm" type="submit"
                                                form="form_create_command_shortcut_{{$command->id}}">Créer raccourci
                                        </button>
                                    @endif
                                    <button class="btn btn-danger btn-sm" type="submit"
                                            form="form_delete_command_{{$command->id}}">
                                        <i class="fas fa-trash"></i> &nbsp;Supprimer
                                    </button>
                                </div>
                                <form method="post" action="{{url('/command/shortcut/create')}}"
                                      id="form_create_command_shortcut_{{$command->id}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="{{$command->id}}">
                                </form>
                                <form method="post" action="{{url('/command/play/'.$command->id)}}"
                                      id="play_command_{{$command->id}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="{{$command->id}}">
                                </form>
                                <form method="post" action="{{url('/command/delete/'.$command->id)}}"
                                      id="form_delete_command_{{$command->id}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="{{$command->id}}">
                                </form>
                            </td>
                            <td>
                                <form method="post" action="{{url('/command/enable/'.$command->id)}}"
                                      id="form_enable_command_{{$command->id}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" value="{{$command->id}}">
                                    <!-- add class p-switch -->
                                    <div class="pretty p-switch p-fill">
                                        @if($command->enable)
                                            <input type="checkbox" name="enable_command" autocomplete="off" checked/>
                                        @else
                                            <input type="checkbox" name="enable_command" autocomplete="off"/>
                                        @endif
                                            <div class="state">
                                            <label></label>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--<h1>Liste des actions programmées</h1><hr>--}}
                {{--<table class="table">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                {{--<th>Capteur</th>--}}
                {{--<th>Commande</th>--}}
                {{--<th>Cron</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                {{--@foreach($scheduled_commands as $command)--}}
                {{--<tr>--}}
                {{--<td>{{$command->sensor_name}}</td>--}}
                {{--<td>{{$command->name}}</td>--}}
                {{--<td>{{$command->cron}}</td>--}}
                {{--</tr>--}}
                {{--@endforeach--}}
                {{--</tbody>--}}
                {{--</table>--}}
            </div>
        </div>
        {{--<div class="row card">--}}
        {{--<form class="form-horizontal" method="post" action="{{url('/config/scheduled_task/create')}}">--}}
        {{--<fieldset>--}}
        {{--{{csrf_field()}}--}}
        {{--<!-- Form Name -->--}}
        {{--<legend>Programmer une action</legend>--}}

        {{--<!-- Select Basic -->--}}
        {{--<div class="form-group">--}}
        {{--<label class="col-md-4 control-label" for="action">Action</label>--}}
        {{--<div class="col-md-4">--}}
        {{--<select id="action" name="action" class="form-control">--}}
        {{--@foreach($commands as $command)--}}
        {{--<option value="{{$command->id}}">{{$command->name}}</option>--}}
        {{--@endforeach--}}
        {{--</select>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--<!-- Text input-->--}}
        {{--<div class="form-group">--}}
        {{--<label class="col-md-4 control-label" for="cron">Cron</label>--}}
        {{--<div class="col-md-4">--}}
        {{--<input id="cron" name="cron" type="text" placeholder="* * * * *" class="form-control input-md">--}}
        {{--<span class="help-block">Sous la forme d'une crontab</span>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-8">--}}
        {{--<button class="btn btn-secondary pull-right">Ajouter</button>--}}
        {{--</div>--}}
        {{--</fieldset>--}}
        {{--</form>--}}
        {{--</div>--}}
    </div>

@endsection