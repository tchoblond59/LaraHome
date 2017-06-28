
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

e.channel('chan-relay')
    .listen('SSRelayEvent', function (e) {
        console.log('SSRelayEvent', e)
        $('input.SSRelayWidget').unbind();
        if(e.state == 1)
            $('input.SSRelayWidget').bootstrapToggle('on');
        else
            $('input.SSRelayWidget').bootstrapToggle('off');
        bindSSRelay();
    })

function bindSSRelay() {

    $('input.SSRelayWidget').change(function() {
        var form = $(this).closest("form");
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
    })
}

$(function() {
    bindSSRelay();
})