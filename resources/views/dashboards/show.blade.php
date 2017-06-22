@extends('layouts.app')

@section('content')
    <div class="container">
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
    </div>
@endsection