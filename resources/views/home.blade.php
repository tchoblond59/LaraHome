@extends('layouts.app')

@section('content')
    <div class="container">
    @foreach($dashboards->chunk(3) as $items)
        <div class="row">
            @foreach($items as $dashboard)
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">{{$dashboard->name}}</div>
                        <div class="panel-body">
                            <ul>
                                <li>{{__('dashboard.nb_widgets')}}: {{$dashboard->widgets->count()}}</li>
                            </ul>
                            <a href="{{url('/dashboard/show/'.$dashboard->id)}}" class="btn btn-default pull-right"><i class="fa fa-sign-in" aria-hidden="true"></i> {{__('dashboard.go')}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
    </div>
@endsection