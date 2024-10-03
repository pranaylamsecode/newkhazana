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
                'name' => 'Date',
                'icon' => 'fa fa-circle-o',
                'route' => 'admin.date.index',
            ],
            1 => [
                'name' => 'Jodi',
                'icon' => 'fa fa-circle-o',
                'route' => 'admin.jodi.create',
            ],
            2 => [
                'name' => 'Panel',
                'icon' => 'fa fa-circle-o',
                'route' => 'admin.panel.create',
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
