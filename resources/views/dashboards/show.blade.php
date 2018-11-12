@extends('layouts.app')

@section('css')
    @foreach($css as $cs)
        <link href="{{ asset($cs) }}" rel="stylesheet">
    @endforeach
@endsection

@section('js')
    @foreach($js as $j)
        <script src="{{ asset($j) }}"></script>
    @endforeach
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h2>{{__('dashboard.dashboard')}}<a data-toggle="modal" data-target="#addWidgetModal" href="#addWidgetModal"><i class="fa fa-plus-square-o pull-right" aria-hidden="true"></i></a></h2>
            <hr>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @foreach($widgets as $widget)
        @if($loop->first)
            <div class="row">
        @endif
        <div class="col-md-3">
            {!!$widget!!}
        </div>
        @if($loop->iteration%4==0 || $loop->last)
            </div>
        @endif
        @if($loop->iteration%4==0)
            <div class="row">
        @endif
    @endforeach
        <div class="row">
            <div class="col-md-12">
                <h4>{{__('dashboard.scenarios')}} <a data-toggle="modal" data-target="#addScenarioModal" href="#addScenarioModal"><i class="fa fa-plus-square-o pull-right" aria-hidden="true"></i></a></h4><hr>
            </div>
        </div>
        @foreach($dashboard->scenarios as $widget)
            @if($loop->first)
                <div class="row">
                    @endif
                    <div class="col-md-3">
                        <form method="post" action="{{url('/scenario/play/'.$widget->id)}}">
                            {{csrf_field()}}
                            <div class="card-container">
                                <div class="card-icon card-grey"><i class="fa fa-4x fa-play-circle-o text-center"></i></div>
                                <div class="card-title text-center">
                                    <button type="submit" class="btn btn-default text-center">Jouer</button>
                                </div>
                                <div class="card-figures">
                                    <span class="figures text-center">{{$widget->name}}</span>
                                </div>
                            </div>
                        </form>
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
                            <h4 class="modal-title">{{__('dashboard.new_widget')}}</h4>
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
                                    <label class="col-md-4 control-label" for="name">{{__('common.name')}}</label>
                                    <div class="col-md-4">
                                        <input id="name" name="name" type="text" placeholder="{{__('dashboard.my_widget')}}" class="form-control input-md" required="">
                                        <span class="help-block">{{__('dashboard.my_widget_help')}}</span>
                                    </div>
                                </div>
                            </fieldset>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('common.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('common.add')}}</button>
                    </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div id="addScenarioModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="post" action="{{url('/dashboard/addScenario/'.$dashboard->id)}}">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">{{__('dashboard.new_scenario')}}</h4>
                        </div>
                        <div class="modal-body">
                            {{csrf_field()}}
                            <fieldset>
                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="scenario">{{__('dashboard.scenario')}}</label>
                                    <div class="col-md-4">
                                        <select id="scenario" name="scenario" class="form-control">
                                            @foreach($scenarios as $scenario)
                                                <option value="{{$scenario->id}}">{{$scenario->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </fieldset>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{__('common.close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('common.add')}}</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


    </div>
@endsection