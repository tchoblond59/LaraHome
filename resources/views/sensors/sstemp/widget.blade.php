<div class="card-container">
    @if($last_message->type==0)
        <div class="card-icon card-green"><i class="fa fa-4x fa-thermometer-half text-center"></i></div>
    @elseif($last_message->type==1)
        <div class="card-icon card-blue"><i class="fa fa-4x fa-tint text-center"></i></div>
    @endif
    <div class="card-title text-center">
        <a href="{{url('/widget/SSTemp/'.$widget->id)}}" class="btn btn-success">{{$widget->name}}</a>
    </div>
    <div class="card-figures">
        @if($last_message->type==0)
            <span class="figures text-center" data-sensorid="{{$widget->sensor_id}}">{{$last_message->value}}°</span>
            <span class="figures-label text-center">CELCIUS</span>
        @elseif($last_message->type==1)
            <span class="figures text-center" data-sensorid="{{$widget->sensor_id}}">{{$last_message->value}}</span>
            <span class="figures-label text-center">%</span>
        @endif
    </div>
</div>