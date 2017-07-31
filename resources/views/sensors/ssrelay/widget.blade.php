<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{$widget->name}} <a href="{{url('/widget/SSRelay/'.$widget->id)}}"><i class="fa fa-cogs pull-right" aria-hidden="true"></i></a></h3>
    </div>
    <div class="panel-body">
        <form action="{{url('/SSRelay/action/toggle')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$widget->id}}">
            <input type="hidden" name="sensor_id" value="{{$sensor->id}}">
            @if($ssrelay_config->type=="temporisé")
                <button type="submit" class="btn btn-primary SSRelayTemp">Actionner</button>
            @else
                <div class="text-center">
                    @if($state == 0)
                        <i class="fa fa-lightbulb-o fa-5x"></i>
                    @else
                        <i class="fa fa-lightbulb-o fa-5x yellow-bulb"></i>
                    @endif
                </div>
                <div class="text-center">
                @if($state == 0)
                    <input type="checkbox" name="state" data-toggle="toggle"  data-sensor_id="{{$sensor->id}}" class="SSRelayWidget">
                @else
                    <input type="checkbox" name="state" data-toggle="toggle" data-sensor_id="{{$sensor->id}}" class="SSRelayWidget" checked>
                @endif
                </div>
            @endif
        </form>
    </div>
</div>