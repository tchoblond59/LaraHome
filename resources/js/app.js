
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Echo from 'laravel-echo'

window.e = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
})

/****************Plugin****************/
e.channel('plugin-channel')
    .listen('PluginsEvent', function (e) {
        console.log('PluginsEvent', e)
    })
/*************************************************/

/********************************/
e.channel('msmessage-out')
    .listen('MSMessageEvent', function (e) {
        console.log('MSMessageEvent', e)
    })
/*************************************************/

function greyCard()
{
    $.each($('div.card-grey'), function (index) {
        $(this).css('background-color', randomColor());
    })
}

$(function() {
    greyCard();
    $('.plugin-submit').click(function (e) {
        bootbox.alert("Installation <br>")
        $('#myModal').modal('show');
        var form = $(this).closest('form');
        console.log(form);
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                //console.log(data); // show response from the php script.
                $('.bootbox-body').html($.parseHTML(data));
            }
        });
    })
})