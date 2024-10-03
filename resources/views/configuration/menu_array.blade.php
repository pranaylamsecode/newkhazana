<?php

$menu = [
    0 => [
        'name' => 'Dashboard',
        'icon' => 'fa fa-dashboard',
        'dropdown' => false,
        'route' => 'admin.dashboard',
        'dropdown_items' => [],
    ],
    1 => [
        'name' => 'Games',
        'icon' => 'fa fa-users',
        'dropdown' => true,
        'route' => '',
        'dropdown_items' => [
            0 => [
                'name' => 'Jodi',
                'icon' => 'fa fa-circle-o',
                'route' => 'admin.users.index',
            ],
            1 => [
                'name' => 'Panel',
                'icon' => 'fa fa-circle-o',
                'route' => 'admin.users.index',
            ],
        ],
    ],

    2 => [
        'name' => 'Settings',
        'icon' => 'fa fa-gear',
        'dropdown' => true,
        'route' => '',
        'dropdown_items' => [
            0 => [
                'name' => 'General Settings',
                'icon' => 'fa fa-circle-o',
                'route' => 'admin.settings.index',
            ],
            1 => [
                'name' => 'Edit Profile',
                'icon' => 'fa fa-circle-o',
                'route' => 'admin.settings.edit_profile',
            ],
        ],
    ],
];
