<?php

use Phwoolcon\MailRenderer\RendererService;

return [
    'phwoolcon/mail-renderer' => [
        'di' => [
            20 => 'di.php', // 20 stands for the loading sequence, bigger number will be loaded later
        ],

        'class_aliases' => [
            // 20 stands for the loading sequence, bigger number will be loaded later
            20 => [
                'MailRenderer' => RendererService::class,
            ],
        ],
    ],
];
