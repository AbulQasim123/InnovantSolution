<?php
return [
    [
        'title' => 'Dashboard',
        'icon' => 'bx bx-home-circle',
        'route' => 'dashboard',
    ],
    [
        'title' => 'Master',
        'icon' => 'bx bx-notepad',
        'sub_menu' => [
            [
                'title' => 'Customer',
                'route' => 'customer.list',
            ],
            [
                'title' => 'Add Product',
                'route' => 'add.product',
            ],
            [
                'title' => 'Products',
                'route' => 'products.list',
            ],
            [
                'title' => 'Carts',
                'route' => 'cart.list',
            ],
        ],
    ],
];
