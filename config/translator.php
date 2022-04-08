<?php

declare(strict_types=1);

return [

    'driver' => env('TRANSLATOR_DRIVER', 'google_cloud_translate'),

    'google_cloud_translate' => [
        'project_id' => env('GOOGLE_CLOUD_TRANSLATE_PROJECT_ID'),
        'key' => env('GOOGLE_CLOUD_TRANSLATE_KEY'),
    ],

];
