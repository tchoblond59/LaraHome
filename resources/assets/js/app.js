
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
        {
            $('input.SSRelayWidget[data-sensor_id='+e.sensor.id+']').bootstrapToggle('on');
            $('input.SSRelayWidget[data-sensor_id='+e.sensor.id+']').closest('form').find('i').addClass('yellow-bulb');
        }
        else
        {
            $('input.SSRelayWidget[data-sensor_id='+e.sensor.id+']').bootstrapToggle('off');
            $('input.SSRelayWidget[data-sensor_id='+e.sensor.id+']').closest('form').find('i').removeClass('yellow-bulb');
        }
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
    var is_checked = form.find('input[type=checkbox]').is(':checked');
    if(is_checked)
    {
        form.find('i').addClass('yellow-bulb');
    }
    else
    {
        form.find('i').removeClass('yellow-bulb');
    }
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
e.channel('SSTemp-channel')
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


/****************SSCompteur JS Plugin****************/
e.channel('sscompteur-channel')
    .listen('SSCompteurEvent', function (e) {
        console.log('SSCompteurEvent', e)
        $('span.figures[data-sscompteur=kwh][data-sensorid='+e.sensor.id+']').animate({'opacity': 0}, 500, function () {
            $('span.figures[data-sscompteur=kwh][data-sensorid='+e.sensor.id+']').text(e.conso[0].kwh)
        }).animate({'opacity': 1}, 500);
        $('span.figures[data-sscompteur=prix][data-sensorid='+e.sensor.id+']').animate({'opacity': 0}, 500, function () {
            $('span.figures[data-sscompteur=prix][data-sensorid='+e.sensor.id+']').text(e.conso[0].prix)
        }).animate({'opacity': 1}, 500);
    })
/*************************************************/

function greyCard()
{
    $.each($('div.card-grey'), function (index) {
        $(this).css('background-color', randomColor());
    })
}


$(function() {
    bindSSRelay();
    greyCard();
})