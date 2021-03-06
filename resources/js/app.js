
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Echo from 'laravel-echo'

window.e = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname,
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
        var ligne = '<tr>\n' +
            '\n' +
            '                            <th scope="row">'+e.id+'</th>\n' +
            '                            <td>'+e.node_address+'/'+e.sensor_adress+'/'+e.commande+'/'+e.ack+'/'+e.type+'</td>\n' +
            '                            <td>'+e.valeur+'</td>\n' +
            '                            <td>'+e.date+'</td>\n' +
            '\n' +
            '                        </tr>';
        //document.getElementById("message_id").prepend(ligne);
        $('#tbody_id').prepend(ligne);
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
    });

    bindChangeForm($('input[name=spotify_device_id]'));
    bindChangeForm($('input[name=spotify_track_id]'));
    bindButtonForm($('#btn_search_track'), traiteResultSearchTracks);
    bindButtonForm($('#btn_search_playlist'), traiteResultSearchPlaylists);
    bindButtonForm($('.play_command_btn'));
    bindChangeForm('input[name=enable_command]');
    bindChangeForm('input[name=enable_scenario]');
})

function traiteResultSearchTracks(reponse)
{
    $('#div_tracks_result').empty();
    $('#div_tracks_result').append(reponse.html);
    bindChangeForm($('input[name=spotify_track_id]'));
}

function traiteResultSearchPlaylists(reponse)
{
    $('#div_playlist_result').empty();
    $('#div_playlist_result').append(reponse.html);
    bindChangeForm($('input[name=spotify_playlist_id]'));
}

function bindChangeForm(selector, callback, errorCallback)
{
    $(selector).unbind();
    $(selector).change(function(e){
        var form = $(this).closest('form');
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',
            success: callback,
            error: onError,
        });
    });
}

function bindButtonForm(selector, callback)
{
    $(selector).unbind();
    $(selector).click(function(e){
        e.preventDefault();
        console.log('auto form');
        var form = $(this).attr('form');
        form = $('#'+form);
        console.log(form);
        $.ajax({
            type: form.attr('method'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',
            success: callback,
            error: onError,
        });
    });
}

function onError(reponse)
{
    var parsedJson = reponse.responseJSON;
    $.each( parsedJson.errors, function( key, value) {
        $.notify({
            // options
            message: value
        },{
            // settings
            type: 'danger'
        });
    });
}