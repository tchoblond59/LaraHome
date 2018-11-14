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
        <div class="row" style="margin-left: 80%">
                <form class="form-horizontal" method="get" action="{{url('/message')}}">
            <div class="col" >

                    <select name="sensor" class="form-control">
                            <option value="">--Sensors--</option>
                            <option value="">All</option>
                        @foreach($sensors as $sensor)
                            <option value="{{$sensor->id}}">{{$sensor->name}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="col">
                    <select name="command" class="form-control">
                            <option value="">--Command--</option>
                            <option value="">All</option>
                            <option value="0">Presentation: 0</option>
                            <option value="1">Set: 1</option>
                            <option value="2">Req: 2</option>
                            <option value="3">Internal: 3</option>
                            <option value="4">Stream: 4</option>

                    </select>
            </div>
                    <div class="col">
                        <select name="type" class="form-control">
                            <option value="">--Type--</option>
                            <option value="">All</option>
                            <option value="0">V_TEMP</option>
                            <option value="1">V_HUM</option>
                            <option value="2">V_STATUS</option>
                            <option value="3">V_PERCENTAGE</option>
                            <option value="4">V_PRESSURE</option>
                            <option value="5">V_FORECAST</option>
                            <option value="6">V_RAIN</option>
                            <option value="7">V_RAINRATE</option>
                            <option value="8">V_WIND</option>
                            <option value="9">V_GUST</option>
                            <option value="10">V_DIRECTION</option>
                            <option value="11">V_UV</option>
                            <option value="12">V_WEIGHT</option>
                            <option value="13">V_DISTANCE</option>
                            <option value="14">V_IMPEDANCE</option>
                            <option value="15">V_ARMED</option>
                            <option value="16">V_TRIPPED</option>
                            <option value="17">V_WATT</option>
                            <option value="18">V_KWH</option>
                            <option value="19">V_SCENE_ON</option>
                            <option value="20">V_SCENE_OFF</option>
                            <option value="21">V_HVAC_FLOW_STATE</option>
                            <option value="22">V_HVAC_SPEED</option>
                            <option value="23">V_LIGHT_LEVEL</option>
                            <option value="24">V_VAR1</option>
                            <option value="25">V_VAR2</option>
                            <option value="26">V_VAR3</option>
                            <option value="27">V_VAR4</option>
                            <option value="28">V_VAR5</option>
                            <option value="29">V_UP</option>
                            <option value="30">V_DOWN</option>
                            <option value="31">V_STOP</option>
                            <option value="32">V_IR_SEND</option>
                            <option value="33">V_IR_RECEIVE</option>
                            <option value="34">V_FLOW</option>
                            <option value="35">V_VOLUME</option>
                            <option value="36">V_LOCK_STATUS</option>
                            <option value="37">V_LEVEL</option>
                            <option value="38">V_VOLTAGE</option>
                            <option value="39">V_CURRENT</option>
                            <option value="40">V_RGB</option>
                            <option value="41">V_RGBW</option>
                            <option value="42">V_ID</option>
                            <option value="43">V_UNIT_PREFIX</option>
                            <option value="44">V_HVAC_SETPOINT_COOL</option>
                            <option value="45">V_HVAC_SETPOINT_HEAT</option>
                            <option value="46">V_HVAC_FLOW_MODE</option>
                            <option value="47">V_TEXT</option>
                            <option value="48">V_CUSTOM</option>
                            <option value="49">V_POSITION</option>
                            <option value="50">V_IR_RECORD</option>
                            <option value="51">V_PH</option>
                            <option value="52">V_ORP</option>
                            <option value="53">V_EC</option>
                            <option value="54">V_VAR</option>
                            <option value="55">V_VA</option>
                            <option value="56">V_POWER_FACTOR</option>


                        </select>
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
                        <tbody>
                        @foreach($messages as $message)
                        <tr>

                            <th scope="row">{{$message->id}}</th>
                            <td>{{$message->node_address}}/{{$message->sensor_address}}/{{$message->command}}/{{$message->ack}}/{{$message->type}}</td>
                            <td>{{$message->value}}</td>
                            <td>{{$message->updated_at}}</td>

                        </tr>
                        @endforeach
                        </tbody>

                    </table>

                    <div style="text-align: center">{{$messages->links()}}</div>


                </div>
    </div>
@endsection