
<?php
return[
    'menu' => [
        // Navbar items:



        // Sidebar items:

        [
            'text'        => 'Inicio',
            'url'         => 'col/inicio',
            'icon'        => 'fas fa-fw fa-home',
            'icon_color' => 'green',
            'label_color' => 'success',
        ],
        [
            'text'        => 'Perfil',
            'url'         => 'col/perfil',
            'icon'        => 'fas fa-user-circle',
            'icon_color' => 'green',
            'label_color' => 'success',
        ],
        [
            'text'        => 'Facturacion',
            'icon'        => 'fas fa-file-invoice',
            'icon_color' => 'green',
            'label_color' => 'success',
            'submenu' => [
                [
                    'text'  => 'Consultar Facturas',
                    'url'   => 'col/facturas-list',
                    'icon'  => 'far fa-folder',
                    'shift' => 'ml-4',
                ],
                [
                    'text'  => 'Subir Factura',
                    'url'   => 'col/factura-form',
                    'icon'  => 'far fa-file',
                    'shift' => 'ml-4',
                ],
                [
                    'text'  => 'Subir ZIP',
                    'url'   => 'col/factura-zip',
                    'icon'  => 'far fa-file-archive',
                    'shift' => 'ml-4',
                ],
            ]
        ],



    ],
]
?>

