@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Gestion des plugins</h1>
            <hr>
        </div>
        <div class="row">
            @foreach($plugins as $plugin)
                @if($loop->first)
                    <div class="row">
                        @endif
                        <div class="col-md-4">
                            <div class="plugin-card well text-center">
                                <h1>
                                    <a href="{{$plugin->url}}">{{$plugin->name}}</a>
                                    @if($plugin->enable)
                                        <span class="label label-success">Actif</span>
                                    @else
                                        <span class="label label-danger">Inactif</span>
                                    @endif
                                </h1>
                                <hr>
                                <p>{{$plugin->description}}</p>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{$plugin->url}}" class="btn btn-primary">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($loop->iteration%3==0 || $loop->last)
                    </div>
                @endif
                @if($loop->iteration%3==0)
                    <div class="row">
                        @endif
                        @endforeach
                    </div>
                    <div class="modal fade" tabindex="-1" role="dialog" id="#myModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Installation en cours</h4>
                                </div>
                                <div class="modal-body" id="modal_install_plugin_content">

                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
        </div>
@endsection