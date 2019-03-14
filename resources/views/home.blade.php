@extends('layouts.app')

@section('content')
    <div class="container">
    @foreach($dashboards->chunk(3) as $items)
        <div class="row">
            @foreach($items as $dashboard)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">{{$dashboard->name}}</div>
                        <div class="card-body">
                            <ul>
                                <li>{{__('dashboard.nb_widgets')}}: {{$dashboard->widgets->count()}}</li>
                            </ul>
                            <a href="{{url('/dashboard/show/'.$dashboard->id)}}" class="btn btn-primary float-right"><i class="fas fa-sign-in-alt" aria-hidden="true"></i> {{__('dashboard.go')}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
    </div>
@endsection