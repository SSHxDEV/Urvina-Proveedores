
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
            'url'         => 'admin/inicio',
            'icon'        => 'fas fa-fw fa-home',
            'icon_color' => 'green',
            'label_color' => 'success',
        ],
        [
            'text'        => 'Perfil',
            'url'         => 'admin/perfil',
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
                    'url'   => '/admin/facturas-sup/USI',
                    'icon'  => 'far fa-folder',
                    'shift' => 'ml-4',
                ],
                [
                    'text'  => 'Facturas COELI',
                    'url'   => '/admin/facturas-sup/COELI',
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
                    'text'  => 'Todos los proveedores',
                    'url'   => '/admin/proveedor-sup/TODOS',
                    'icon'  => 'far fa-folder',
                    'shift' => 'ml-4',
                ],
                [
                    'text'  => 'Proveedores Urvina',
                    'url'   => '/admin/proveedor-sup/USI',
                    'icon'  => 'far fa-folder',
                    'shift' => 'ml-4',
                ],
                [
                    'text'  => 'Proveedores COELI',
                    'url'   => '/admin/proveedor-sup/COELI',
                    'icon'  => 'far fa-folder',
                    'shift' => 'ml-4',
                ],
            ]
        ],

        [
            'text'        => 'Administracion',
            'icon'        => 'fas fa-key',
            'icon_color' => 'green',
            'label_color' => 'success',
            'submenu' => [
                [
                    'text'  => 'Control Usuarios',
                    'url'   => '/admin/control-usuario',
                    'icon'  => 'fas fa-user-lock',
                    'shift' => 'ml-4',
                ],
                [
                    'text'  => 'Agregar usuario',
                    'url'   => '/admin/add-user',
                    'icon'  => 'fas fa-user-plus',
                    'shift' => 'ml-4',
                ],

            ]
        ],



    ],
]
?>

