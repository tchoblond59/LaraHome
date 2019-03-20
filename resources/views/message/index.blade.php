@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{__('message.tableau')}}<span class="badge">{{$messages->total()}}</span></h2>
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
        </div>
        <div class="row" style="margin-left: 0%">
            <form class="form-horizontal" method="get" action="{{url('/message')}}">
                <div class="col" >
                        <div class="col">
                        <select name="sensor" class="form-control" autocomplete="off">
                                <option value="">--Sensors--</option>
                            @foreach($sensors as $one_sensor)
                                @if($sensor == $one_sensor->id)
                                <option value="{{$one_sensor->id}}" selected>{{$one_sensor->name}}</option>
                                @else
                                <option value="{{$one_sensor->id}}">{{$one_sensor->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        </div>

                    <div class="col">
                        <select name="command" class="form-control" autocomplete="off">
                                <option value="">--Command--</option>
                                @foreach($tab_commands as $key => $one_command)
                                    @if($command == $key && $command != null)
                                        <option value="{{$key}}" selected>{{$one_command}}</option>
                                    @else
                                        <option value="{{$key}}">{{$one_command}}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select name="type" class="form-control" autocomplete="off">
                            <option value="">--Type--</option>
                            @foreach($tab_types as $key => $one_type)
                                @if($type == $key && $type!=null)
                                    <option value="{{$key}}" selected>{{$one_type}}</option>
                                @else
                                    <option value="{{$key}}">{{$one_type}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="margin-left: 15px;margin-right: 15px">
                        <div>Du :</div>

                            <div class="form-group">
                                <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                    <input name="dateL" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2"/>
                                    <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        <script type="text/javascript">
                            $(function () {
                                $('#datetimepicker2').datetimepicker({
                                    locale: 'fr'
                                });
                            });
                        </script>
                    </div>

                    <div class="col" style="margin-left: 15px;margin-right: 15px">
                        <div>A :</div>
                            <div class="form-group">
                            <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                                <input name="dateN" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker3"/>
                                <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $(function () {
                                $('#datetimepicker3').datetimepicker({
                                    locale: 'fr'
                                });
                            });
                        </script>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary " >{{__('message.valider')}}</button>
                </div>
            </form>
        </div>
                <div class="container">

                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Valeur</th>
                            <th scope="col">Date/Heure</th>

                        </tr>
                        </thead>
                        <tbody id="tbody_id">
                        @foreach($messages as $message)
                        <tr>

                            <th scope="row">{{$message->id}}</th>
                            <td>{{$message->node_address}}/{{$message->sensor_address}}/{{$message->command}}/{{$message->ack}}/{{$message->type}}</td>
                            <td>{{$message->value}}</td>
                            <td>{{$message->updated_at->format('d/m/Y H:i:s')}}</td>

                        </tr>
                        @endforeach
                        </tbody>

                    </table>

                    <div style="text-align: center">{{$messages->links()}}</div>


                </div>
    </div>
@endsection