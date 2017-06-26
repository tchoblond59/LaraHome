@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Tableau de bord <a data-toggle="modal" data-target="#addWidgetModal" href="#addWidgetModal"><i class="fa fa-plus-square-o pull-right" aria-hidden="true"></i></a></h2>
            <hr>
        </div>
    @foreach($widgets as $widget)
        @if($loop->first)
            <div class="row">
        @endif
        <div class="col-md-3">
            {!!$widget!!}
        </div>
        @if($loop->iteration%3==0 || $loop->last)
            </div>
        @endif
    @endforeach
        <div id="addWidgetModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="post" action="{{url('/dashboard/addwidget/'.$dashboard->id)}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Nouveau widget</h4>
                    </div>
                    <div class="modal-body">
                        {{csrf_field()}}
                            <fieldset>
                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="sensor">Sensor</label>
                                    <div class="col-md-4">
                                        <select id="sensor" name="sensor" class="form-control">
                                            @foreach($sensors as $sensor)
                                                <option value="{{$sensor->id}}">{{$sensor->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="name">Nom</label>
                                    <div class="col-md-4">
                                        <input id="name" name="name" type="text" placeholder="Mon widget" class="form-control input-md" required="">
                                        <span class="help-block">Entrer le nom de votre widget</span>
                                    </div>
                                </div>
                            </fieldset>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
@endsection