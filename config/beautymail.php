<?php

return [

    // These CSS rules will be applied after the regular template CSS

    /*
        'css' => [
            '.button-content .button { background: red }',
        ],
    */

    'colors' => [

        'highlight' => '#004ca3',
        'button'    => '#004cad',

    ],

    'view' => [
        'senderName'  => env('MAIL_FROM_NAME'),
        'reminder'    => null,
        'unsubscribe' => null,
        'address'     => env('MAIL_FROM_ADDRESS'),

        'logo'        => [
            'path'   => 'https://static.roundme.com/upload/logos/5b167deceed2d5b167deceedd3.png',
            //'path'   => '%PUBLIC%/vendor/beautymail/assets/images/logo.png',
            'width'  => '150',
            'height' => '150',
        ],

        'twitter'  => null,
        'facebook' => null,
        'flickr'   => null,
    ],

];
