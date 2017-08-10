@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1></h1><hr>
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{__('common.sensor')}}</th>
                        <th>{{__('common.plugin')}}</th>
                        <th>{{__('sensor.node_address')}}</th>
                        <th>{{__('sensor.sensor_address')}}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sensors as $sensor)
                        <tr>
                            <td>{{$sensor->name}}</td>
                            <td>{{$sensor->classname}}</td>
                            <td>{{$sensor->node_address}}</td>
                            <td>{{$sensor->sensor_address}}</td>
                            <td><a href="{{url('/sensor/update/'.$sensor->id)}}" class="btn btn-default btn-sm">{{__('common.configure')}}</a>
                                <form style="display:inline-block" method="post" action="{{url('/sensor/delete/'.$sensor->id)}}">
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-danger btn-sm">{{__('common.delete')}}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection