@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 card p-3">
                <form class="form-horizontal" method="post" action="{{url('/widget/update/'.$widget->id)}}">
                    {{csrf_field()}}
                    <fieldset>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif
                    <!-- Form Name -->
                        <legend>Modifier Widget</legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">Nom</label>
                            <div class="col-md-4">
                                <input id="name" name="name" type="text" placeholder="Nom" class="form-control input-md" value="{{$widget->name}}" required="">
                                <span class="help-block">Nom du widget</span>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <button class="btn btn-secondary pull-right">Modifier</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection