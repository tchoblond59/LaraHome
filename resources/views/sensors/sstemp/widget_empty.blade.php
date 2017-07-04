<div class="card-container">
        <div class="card-icon card-green"><i class="fa fa-4x fa-thermometer-half text-center"></i></div>
    <div class="card-title text-center">
        <a href="{{url('/widget/SSTemp/'.$widget->id)}}" class="btn btn-success">{{$widget->name}}</a>
    </div>
    <div class="card-figures">
            <span class="figures text-center" data-sensorid="{{$widget->sensor_id}}">No data</span>
            <span class="figures-label text-center">--</span>
    </div>
</div>