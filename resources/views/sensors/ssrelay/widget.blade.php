
<div class="panel panel-default">
 <div class="panel-heading">
  <h3 class="panel-title">{{$widget->name}} <a href="{{url('/widget/SSRelay/'.$widget->id)}}"><i class="fa fa-cogs pull-right" aria-hidden="true"></i></a></h3>
 </div>
 <div class="panel-body">
  <form action="{{url('/SSRelay/action/toggle')}}" method="post">
   {{csrf_field()}}
   <input type="hidden" name="id" value="{{$widget->id}}">
   <input type="checkbox" name="state" data-toggle="toggle" class="SSRelayWidget"> Relay
  </form>
 </div>
</div>