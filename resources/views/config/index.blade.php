@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Liste des actions disponible</h1><hr>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Capteur</th>
                        <th>Commande</th>
                        <th>Raccourci</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mscommands as $command)
                        <tr>
                            <td>{{$command->sensor->name}}</td>
                            <td>{{$command->name}}</td>
                            @if($command->url)
                                <td><a class="btn btn-default btn-sm" href="{{url('/sensor/mscommands/shortcut/'.$command->url)}}">Actionner</a></td>
                            @else
                                <td>
                                    <form method="post" action="{{url('/config//mscommands/shortcut/create')}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{$command->id}}">
                                        <button class="btn btn-primary btn-sm" type="submit">Créer raccourci</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <h1>Liste des actions programmées</h1><hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Capteur</th>
                            <th>Commande</th>
                            <th>Cron</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($scheduled_commands as $command)
                        <tr>
                            <td>{{$command->sensor_name}}</td>
                            <td>{{$command->name}}</td>
                            <td>{{$command->cron}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <form class="form-horizontal" method="post" action="{{url('/config/scheduled_task/create')}}">
                <fieldset>
                {{csrf_field()}}
                <!-- Form Name -->
                    <legend>Programmer une action</legend>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="action">Action</label>
                        <div class="col-md-4">
                            <select id="action" name="action" class="form-control">
                                @foreach($mscommands as $command)
                                    <option value="{{$command->id}}">{{$command->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="cron">Cron</label>
                        <div class="col-md-4">
                            <input id="cron" name="cron" type="text" placeholder="* * * * *" class="form-control input-md">
                            <span class="help-block">Sous la forme d'une crontab</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <button class="btn btn-default pull-right">Ajouter</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

@endsection