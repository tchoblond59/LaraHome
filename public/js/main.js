/**
 * Created by julien on 26/06/17.
 */
$(function() {
    $('input.SSRelayWidget').change(function() {
        console.log('Test 123 Test');
        $form = $(this).closest("form");
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: $form.serialize(),
            dataType: 'json', // JSON
            success: function(reponse) {
                console.log(reponse);
                $.notify(reponse);
            }
        });
    })
})
