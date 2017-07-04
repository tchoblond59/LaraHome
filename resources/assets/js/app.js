
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Echo from 'laravel-echo'

let e = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
})

/****************SSRelay JS Plugin****************/
e.channel('chan-relay')
    .listen('SSRelayEvent', function (e) {
        console.log('SSRelayEvent', e)
        $('input.SSRelayWidget').unbind();
        $('button.SSRelayTemp').closest('form').unbind();
        if(e.state == 1)
            $('input.SSRelayWidget[data-sensor_id='+e.sensor.id+']').bootstrapToggle('on');
        else
            $('input.SSRelayWidget[data-sensor_id='+e.sensor.id+']').bootstrapToggle('off');
        bindSSRelay();
    })

function bindSSRelay() {
    $('input.SSRelayWidget').change(function() {
        var form = $(this).closest("form");
        submitSSrelayFormWidget(form);
    })

    var tempform  = $('button.SSRelayTemp').closest('form');
    tempform.submit(function (e) {
        e.preventDefault();
        submitSSrelayFormWidget(tempform);
    })
}

function submitSSrelayFormWidget(form)
{
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        dataType: 'json', // JSON
        success: function(reponse) {
            console.log(reponse);
            $.notify(reponse);
        }
    });
}
/*************************************************/

/****************SSTemp JS Plugin****************/
e.channel('chan-temp')
    .listen('SSTempEvent', function (e) {
        console.log('SSTempEvent', e)
        if(e.type=="temp")
            $('.card-figures .figures[data-sensorid='+e.sensor.id+']').animate({'opacity': 0}, 1000, function () {
                $('.card-figures .figures[data-sensorid='+e.sensor.id+']').text(e.value+'°');
            }).animate({'opacity': 1}, 1000);
        else if(e.type=="hum")
            $('.card-figures .figures[data-sensorid='+e.sensor.id+']').animate({'opacity': 0}, 1000, function () {
                $('.card-figures .figures[data-sensorid='+e.sensor.id+']').text(e.value);
            }).animate({'opacity': 1}, 1000);
    })
/*************************************************/

$(function() {
    bindSSRelay();
})