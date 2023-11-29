<?php


return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.',
        'title' => 'Dashboard',
        'active' => 'dashboard.',
    ], 
    [
        'icon' => 'fas fa-tags nav-icon',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories',
        'badge' => 'New',
        'active' => 'dashboard.categories.index',
    ],
    [
        'icon' => 'fas fa-tags nav-icon',
        'route' => 'dashboard.categories.trash',
        'title' => 'trashes',
        'badge' => 'New',
        'active' => 'dashboard.categories.trash',
    ],
    [
        'icon' => 'fas fa-tags nav-icon',
        'route' => 'dashboard.products.index',
        'title' => 'products',
        'badge' => 'New',
        'active' => 'dashboard.products.index',
    ],
    ];