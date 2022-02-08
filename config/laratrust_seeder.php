<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'hotels' => 'c,r,u,d',
            'rooms' => 'c,r,u,d',
            'tours' => 'c,r,u,d',
            'booking' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'vendors' => 'c,r,u,d',
            'customers' => 'c,r,u,d',
            'currency' => 'c,r,u,d',
            'attribute' => 'c,r,u,d',
            'permissions' => 'c,r,u,d'
        ],
        'moderator' => [

        ],
        'vendor' => [

        ],
        'customer' => [

        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
