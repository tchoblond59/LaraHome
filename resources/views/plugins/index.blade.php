@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Gestion des plugins</h1><hr>
            @foreach($plugins as $plugin)
                @if($loop->first || $loop->iteration%4==0)
                    <div class="row pricing-table">
                        @endif
                        <div class="pricing-option">
                            {{--<i class="material-icons">important_devices</i>--}}
                            <h1><a href="{{$plugin->url}}">{{$plugin->name}}</a></h1>
                            <hr />
                            <p>{{$plugin->description}}</p>
                            <hr />
                            <div class="price">
                                <div class="front">
                                    @if($plugin->enable)
                                        <span class="price">Installé</span>
                                    @else
                                        <span class="price">Nouveau</span>
                                    @endif
                                </div>
                                @if(!$plugin->enable)
                                <div class="back">
                                    <form action="{{url('/plugins/install')}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{$plugin->id}}">
                                        <button type="button" class="button plugin-submit">Ajouter</button>
                                    </form>
                                </div>
                                @endif()
                            </div>
                        </div>
                        @if($loop->iteration%4==0 || $loop->last)
                    </div>
                @endif
            @endforeach
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="#myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Installation en cours</h4>
                    </div>
                    <div class="modal-body" id="modal_install_plugin_content">

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
@endsection