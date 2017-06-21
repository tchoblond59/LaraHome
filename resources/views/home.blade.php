@extends('layouts.app')

@section('content')
    @foreach($widgets as $widget)
        <div class="col-md-3">
            {!!$widget!!}
        </div>
    @endforeach
@endsection