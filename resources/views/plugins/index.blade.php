@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Gestion des plugins
                <small><a href="{{url('/plugins/update')}}">Mettre à jour la liste</a></small>
            </h1>
            <hr>
        </div>
            @foreach($plugins as $plugin)
                @if($loop->first)
                    <div class="row mb-4">
                        @endif
                        <div class="col-md-4">
                            <div class="plugin-card card text-center">
                                <h3>
                                    <a href="{{$plugin->url}}">{{$plugin->name}}</a>
                                    @if($plugin->enable)
                                        <span class="badge badge-success">Actif</span>
                                    @else
                                        <span class="badge badge-danger">Inactif</span>
                                    @endif
                                </h3>
                                <hr>
                                <p>{{$plugin->description}}</p>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="post" action="{{url('/plugins/enable')}}"
                                              id="form_enable_{{$plugin->id}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="plugin" value="{{$plugin->id}}">
                                        </form>
                                        <form method="post" action="{{url('/plugins/disable')}}"
                                              id="form_disable_{{$plugin->id}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="plugin" value="{{$plugin->id}}">
                                        </form>
                                        <div class="btn-group" role="group" aria-label="...">
                                            @if($plugin->enable)
                                                <button type="submit" class="btn btn-danger"
                                                        form="form_disable_{{$plugin->id}}">Desactiver
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-success"
                                                        form="form_enable_{{$plugin->id}}">Activer
                                                </button>
                                            @endif

                                            <a href="{{$plugin->url}}" class="btn btn-primary">En savoir plus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($loop->iteration%3==0 || $loop->last)
                    </div>
                @endif
                @if($loop->iteration%3==0 && !$loop->last)
                    <div class="row mb-4">
                        @endif
                        @endforeach
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