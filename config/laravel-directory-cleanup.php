<?php

return [

    'directories' => [

        /*
         * Here you can specify which directories need to be cleanup. All files older than
         * the specified amount of minutes will be deleted.
         */
        'storage/framework/views' => [
            'deleteAllOlderThanMinutes' => 60 * 24
        ],
        'storage/framework/sessions' => [
            'deleteAllOlderThanMinutes' => 60 * 24
        ],
        'storage/debugbar' => [
            'deleteAllOlderThanMinutes' => 60 * 24
        ]
    ],
];
