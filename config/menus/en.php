<?php
return[
    'menu' => [
        // Navbar items:

        [
            'text'        => '',
            'url'       => "en/cart",
            'icon'        => 'fas fa-fw fa-shopping-cart',
            'icon_color' => 'green',
            'label_color' => 'success',
            'topnav_right' => true,

        ],

        // Sidebar items:
        [
            'type'       => 'sidebar-custom-search',
            'text'       => 'Search',         // Placeholder for the underlying input.
            'url'        => 'en/buscar', // The url used to submit the data ('#' by default).
            'method'     => 'post',           // 'get' or 'post' ('get' by default).
            'input_name' => 'searchVal',      // Name for the underlying input ('adminlteSearch' by default).
            'id'         => 'sidebarSearch'   // ID attribute for the underlying input (optional).
        ],

        [
            'text'        => 'home',
            'url'         => 'en/inicio',
            'icon'        => 'fas fa-fw fa-home',
            'icon_color' => 'green',
            'label_color' => 'success',
        ],



    ],
]
?>
