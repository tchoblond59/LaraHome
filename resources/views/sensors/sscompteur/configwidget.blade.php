@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>SSCompteur configuration</h1>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-xs-6 col-md-6">
                        <div class="panel status panel-info">
                            <div class="panel-heading">
                                <h1 class="panel-title text-center">{{$stats['avg_kwh_by_month']}} kWh</h1>
                            </div>
                            <div class="panel-body text-center">
                                <strong>Moyenne mensuelle</strong>
                            </div>
                            <div class="panel-footer" style="background-color: #d9edf7; color: #31708f">
                                <h1 class="panel-title text-center">{{round($stats['avg_prix_by_month'],2)}} €</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-6">
                        <div class="panel status panel-info">
                            <div class="panel-heading">
                                <h1 class="panel-title text-center">{{$stats['avg_kwh_by_day']}} kWh</h1>
                            </div>
                            <div class="panel-body text-center">
                                <strong>Moyenne journalière</strong>
                            </div>
                            <div class="panel-footer" style="background-color: #d9edf7; color: #31708f">
                                <h1 class="panel-title text-center">{{round($stats['avg_prix_by_day'],2)}} €</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row well">
                    <h3>{{$widget->name}} <span class="label label-info"></span>
                        @can('update sensor')
                        <a class="pull-right" href="{{url('/SSCompteur/update/'.$widget->id)}}"><i class="fa fa-cogs"></i></a>
                        @endcan
                    </h3><br>
                    <h5><strong>Plugin:</strong> {{$widget->sensor->classname}}</h5>
                    <h5><strong>Capteur:</strong> {{$widget->sensor->name}}</h5>
                    <h5><strong>Adresse du noeud:</strong> {{$widget->sensor->node_address}}</h5>
                    <h5><strong>Adresse secondaire:</strong> {{$widget->sensor->sensor_address}}</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Moyenne de consommation par jour</h2><hr>
                <div id="avgDayOfWeek"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Moyenne de consommation par mois</h2><hr>
                <div id="consoByMonth"></div>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        // Define the chart to be drawn.
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn('string', 'Jour');
        dataTable.addColumn('number', 'Consommation');

        dataTable.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});

        dataTable.addRows([
            ['Lundi',  {{$avg_kwh_by_day_of_week[1]->avg_kwh_by_day_of_week}}, "<div style=\"padding:15px 15px 15px 15px;\"><p><strong>{{$avg_kwh_by_day_of_week[1]->avg_kwh_by_day_of_week}}</strong> kWh</p><br><p><strong>{{round($avg_prix_by_day_of_week[1]->avg_prix_by_day_of_week,2)}}</strong>€</p></div>"],
            ['Mardi',  {{$avg_kwh_by_day_of_week[2]->avg_kwh_by_day_of_week}}, "<div style=\"padding:15px 15px 15px 15px;\"><p><strong>{{$avg_kwh_by_day_of_week[2]->avg_kwh_by_day_of_week}}</strong> kWh</p><br><p><strong>{{round($avg_prix_by_day_of_week[2]->avg_prix_by_day_of_week,2)}}</strong>€</p></div>"],
            ['Mercredi',  {{$avg_kwh_by_day_of_week[3]->avg_kwh_by_day_of_week}}, "<div style=\"padding:15px 15px 15px 15px;\"><p><strong>{{$avg_kwh_by_day_of_week[3]->avg_kwh_by_day_of_week}}</strong> kWh</p><br><p><strong>{{round($avg_prix_by_day_of_week[3]->avg_prix_by_day_of_week,2)}}</strong>€</p></div>"],
            ['Jeudi',  {{$avg_kwh_by_day_of_week[4]->avg_kwh_by_day_of_week}}, "<div style=\"padding:15px 15px 15px 15px;\"><p><strong>{{$avg_kwh_by_day_of_week[4]->avg_kwh_by_day_of_week}}</strong> kWh</p><br><p><strong>{{round($avg_prix_by_day_of_week[4]->avg_prix_by_day_of_week,2)}}</strong>€</p></div>"],
            ['Vendredi',  {{$avg_kwh_by_day_of_week[5]->avg_kwh_by_day_of_week}}, "<div style=\"padding:15px 15px 15px 15px;\"><p><strong>{{$avg_kwh_by_day_of_week[5]->avg_kwh_by_day_of_week}}</strong> kWh</p><br><p><strong>{{round($avg_prix_by_day_of_week[5]->avg_prix_by_day_of_week,2)}}</strong>€</p></div>"],
            ['Samedi',  {{$avg_kwh_by_day_of_week[6]->avg_kwh_by_day_of_week}}, "<div style=\"padding:15px 15px 15px 15px;\"><p><strong>{{$avg_kwh_by_day_of_week[6]->avg_kwh_by_day_of_week}}</strong> kWh</p><br><p><strong>{{round($avg_prix_by_day_of_week[6]->avg_prix_by_day_of_week,2)}}</strong>€</p></div>"],
            ['Dimanche',  {{$avg_kwh_by_day_of_week[0]->avg_kwh_by_day_of_week}}, "<div style=\"padding:15px 15px 15px 15px;\"><p><strong>{{$avg_kwh_by_day_of_week[0]->avg_kwh_by_day_of_week}}</strong> kWh</p><br><p><strong>{{round($avg_prix_by_day_of_week[0]->avg_prix_by_day_of_week,2)}}</strong>€</p></div>"]
        ]);


        var options = {
            vAxis: {format:'# kWh'},
            tooltip: {isHtml: true},
            curveType: 'function',
        };

        // Instantiate and draw the chart.
        var chart = new google.visualization.LineChart(document.getElementById('avgDayOfWeek'));
        chart.draw(dataTable, options);

        var months = {'1':'Janvier', '2':'Février', '3':'Mars', '4':'Avril', '5':'Mail', '6':'Juin', '7':'Juillet', '8':'Aout', '9':'Septembre', '10':'Octobre', '11':'Novembre', '12':'Décembre'};
        var conso = {!! json_encode($consoByMonth) !!};
        var consoTable = new google.visualization.DataTable();

        consoTable.addColumn('string', 'Mois');
        consoTable.addColumn('number', 'Consommation');

        consoTable.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});


        var consoRows = new Array();
        $.each(conso,function(index){
            consoRows[index] = [months[conso[index].month], conso[index].kwh, "<div style=\"padding:15px 15px 15px 15px;\"><p><strong>"+conso[index].kwh+"</strong> kWh</p><br><p><strong>"+conso[index].prix+"</strong>€</p></div>"]
        });

        consoTable.addRows(consoRows);
        var consoChart = new google.visualization.LineChart(document.getElementById('consoByMonth'));
        consoChart.draw(consoTable, options);

    }
</script>
