
<?php
return[
    'menu' => [
        // Navbar items:



        // Sidebar items:
        [
            'type'       => 'sidebar-custom-search',
            'text'       => 'Buscar',         // Placeholder for the underlying input.
            'url'        => 'en/buscar', // The url used to submit the data ('#' by default).
            'method'     => 'post',           // 'get' or 'post' ('get' by default).
            'input_name' => 'searchVal',      // Name for the underlying input ('adminlteSearch' by default).
            'id'         => 'sidebarSearch'   // ID attribute for the underlying input (optional).
        ],
        [
            'text'        => 'Inicio',
            'url'         => 'sup/inicio',
            'icon'        => 'fas fa-fw fa-home',
            'icon_color' => 'green',
            'label_color' => 'success',
        ],
        [
            'text'        => 'Perfil',
            'url'         => 'sup/perfil',
            'icon'        => 'fas fa-user-circle',
            'icon_color' => 'green',
            'label_color' => 'success',
        ],
        [
            'text'        => 'Consultar Facturas',
            'icon'        => 'fas fa-file-invoice',
            'icon_color' => 'green',
            'label_color' => 'success',
            'submenu' => [
                [
                    'text'  => 'Facturas Urvina',
                    'url'   => 'sup/facturas-sup/USI',
                    'icon'  => 'far fa-folder',
                    'shift' => 'ml-4',
                ],
                [
                    'text'  => 'Facturas COELI',
                    'url'   => 'sup/facturas-sup/COELI',
                    'icon'  => 'far fa-folder',
                    'shift' => 'ml-4',
                ],
            ]
        ],
        [
            'text'        => 'Consultar Proveedores',
            'icon'        => 'fas fa-users',
            'icon_color' => 'green',
            'label_color' => 'success',
            'submenu' => [
                [
                    'text'  => 'Proveedores Urvina',
                    'url'   => 'sup/proveedor-sup/USI',
                    'icon'  => 'far fa-folder',
                    'shift' => 'ml-4',
                ],
                [
                    'text'  => 'Proveedores COELI',
                    'url'   => 'sup/proveedor-sup/COELI',
                    'icon'  => 'far fa-folder',
                    'shift' => 'ml-4',
                ],
            ]
        ],



    ],
]
?>

