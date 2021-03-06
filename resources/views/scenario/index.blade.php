@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Gestion des scénarios</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Cron</th>
                    <th>Raccourci</th>
                    <th>#</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($scenarios as $scenario)
                    <tr>
                        <td>{{$scenario->name}}</td>
                        <td>{{$scenario->cron}}</td>
                        @if($scenario->url)
                            <td><a class="btn btn-secondary btn-sm" href="{{url('/scenario/shortcut/play/'.$scenario->url)}}">Actionner</a></td>
                        @else
                            <td>Pas de raccourci</td>
                        @endif
                            <td>
                                <form style="display:inline-block" method="post" action="{{url('/scenario/play/'.$scenario->id)}}">
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-success btn-sm">Jouer</button>
                                </form>
                                @if(empty($scenario->url))
                                <form style="display:inline-block" method="post" action="{{url('/scenario/shortcut/create/'.$scenario->id)}}">
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-secondary btn-sm">Créer raccourci</button>
                                </form>
                                @endif
                                <a class="btn btn-sm btn-primary" href="{{url('/scenario/update/'.$scenario->id)}}">Editer</a>
                                <form style="display:inline-block" method="post" action="{{url('/scenario/delete/'.$scenario->id)}}">
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        <td>
                            <form method="post" action="{{url('/scenario/enable/'.$scenario->id)}}"
                                  id="form_enable_command_{{$scenario->id}}">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$scenario->id}}">
                                <!-- add class p-switch -->
                                <div class="pretty p-switch p-fill">
                                    @if($scenario->enable)
                                        <input type="checkbox" name="enable_scenario" autocomplete="off" checked/>
                                    @else
                                        <input type="checkbox" name="enable_scenario" autocomplete="off"/>
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
            <hr>
            <form class="form-horizontal" method="post" action="{{url('/scenario/create')}}">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Créer un scénario</legend>
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
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">Nom</label>
                        <div class="col-md-4">
                            <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required="">
                            <span class="help-block">Le nom sous lequel le scénario apparaitra</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <button class="btn btn-secondary pull-right" type="submit">Créer</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection