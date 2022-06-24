<?php

return [
    'views-namespace'   => 'laravel-components',
    'nav-home-name'     => 'admin.login',
    'empty-value'       => '-',
    'default-classes'   => [
        'components'        => [
            'button'            => [
                'container'         => 'btn px-4 fw-bold d-flex align-items-center',
                'icon'              => 'me-2',
                'label'             => '',
            ],
            'data-table'     => [
                'empty-table'       => [
                    'container'         => 'w-100 text-center bg-white p-2 rounded user-select-none',
                    'icon'              => 'text-secondary',
                ],
                'filter'            => [
                    'container'         => 'filter-input',
                    'label'             => 'm-0 me-2',
                    'select'            => 'm-0 p-1 px-2',
                ],
                'loading-indicator' => [
                    'container'         => 'w-100 text-center bg-white p-2 rounded user-select-none',
                    'icon'              => 'text-secondary',
                ],
                'search-input'      => [
                    'container'         => 'search-input',
                    'input'             => 'm-0 p-2',
                    'button'            => 'm-0 p-2',
                    'button-icon'       => 'fas fa-search fa-fw',
                ],
            ],
            'controls'      => [
                'dropdown'      => [
                    'item'          => [
                        'container'     => 'dropdown-item cursor-pointer',
                    ],
                    'modal'         => [
                        'container'     => 'dropdown-item cursor-pointer',
                        'label'         => '',
                    ],
                    'divider'       => [
                        'container'     => 'dropdown-divider'
                    ],
                    'menu'          => [
                        'container'     => 'dropdown',
                        'toggle'        => 'btn btn-secondary px-4 fw-bold dropdown-toggle',
                        'menu'          => 'dropdown-menu',
                    ],
                ],
            ],
            'layout'        => [
                'card'          => [
                    'container'     => 'card p-0 mb-3',
                    'inner'         => 'card-body p-3',
                ],
                'card-header'   => [
                    'container'     => 'd-flex justify-content-between align-items-center mb-3',
                    'title'         => 'h2 m-0 p-0',
                ],
                'card-data'     => [
                    'container'     => 'row mb-3',
                    'column'        => 'col-12 col-md-4 col-lg-3 mb-3',
                    'label'         => 'fw-bold text-dark',
                    'value'         => '',
                ],
                'pane-card'     => [
                    'container'     => 'd-block w-100',
                    'title'         => 'h2 mb-3 w-100 text-center',
                ],
            ],
            'form'          => [
                'form-input'    => [
                    'container'         => 'form-group mb-2',
                    'description'       => 'w-100 mb-2',
                    'input-container'   => 'position-relative',
                ],
                'label'         => [
                    'container'     => 'mb-1 user-select-none fw-bold',
                ],
                'inputs'        => [
                    'input'   => [
                        'container'     => 'form-control shadow-none',
                        'invalid'       => 'is-invalid',
                    ],
                    'select'        => [
                        'container'     => 'form-control shadow-none',
                        'invalid'       => 'is-invalid',
                    ],
                    'file'          => [
                        'container'         => 'file-input',
                        'input'             => 'm-0 px-2',
                        'label-container'   => 'm-0 p-1 px-3 rounded btn btn-secondary',
                        'label-icon'        => 'me-2',
                        'label-text'        => '',

                    ],
                    'textarea'      => [
                        'container'     => 'form-control shadow-none',
                        'invalid'       => 'is-invalid',
                    ],
                ],
                'error'         => [
                    'container'     => 'invalid-feedback d-block'
                ],
            ],
            'modals'        => [
                'confirmation'  => [
                    'react-container'       => 'ReactModal__Content react-modal-outer modal-dialog bespoke-modal',
                    'container'             => 'modal bespoke-modal fade',
                    'modal-dialog'          => 'modal-dialog p-0',
                    'form'                  => 'w-100',
                    'modal-content'         => 'modal-content p-4',
                    'modal-header'          => 'modal-header border-0 m-0 p-0 pb-4',
                    'modal-title'           => 'modal-title',
                    'modal-body'            => 'modal-body m-0 mb-3 p-0',
                    'confirmation-text'     => 'm-0',
                    'modal-footer'          => 'modal-footer m-0 p-0 pt-3 d-flex justify-content-between align-items-center border-top',
                    'confirmation-button'   => 'btn btn-primary text-white px-4',
                    'cancel-button'         => 'btn btn-secondary px-4',
                ],
            ],
        ],
        'layouts'       => [
            'pane'          => [
                'body'              => '',
                'app-div-outer'     => 'pane-layout bg-dark',
                'app-div-inner'     => 'd-flex align-items-center justify-content-center',
                'app-div-col'       => 'col-10 col-md-8 col-lg-6',
                'app-name'          => 'h1 text-white w-100 mb-4 text-center',
                'pane-container'    => 'rounded bg-light p-4',
            ],
            'app'           => [
                'body'                      => 'app-layout bg-light',
                'app-div-outer'             => 'container-fluid m-0 p-0',
                'app-div-inner'             => 'row m-0',
                'app-div-col'               => 'm-0 p-3 container-fluid',
                'app-breadcrumb-container'  => 'd-none d-md-flex w-100 mb-3',
            ],
            'breadcrumbs'   => [
                'previous-link'                 => 'text-secondary fw-bold user-select-none',
                'previous-chevron-container'    => 'text-secondary px-2',
                'previous-chevron-item'         => 'fas fa-chevron-right',
                'breadcrumb-link'               => 'text-dark fw-bold user-select-none',
                'breadcrumb-chevron-container'  => 'text-dark px-2',
                'breadcrumb-chevron-item'       => 'fas fa-chevron-right',
            ],
            'navigation'    => [
                'upper-navbar'  => [
                    'container'             => 'd-block d-lg-none navbar navbar-dark bg-dark m-0 p-0',
                    'control-container'     => 'd-flex justify-content-between align-items-center p-2 px-3',
                    'nav-logo'              => 'nav-logo',
                    'nav-link'              => '',
                    'toggle-button'         => 'navbar-toggler',
                    'toggle-button-icon'    => 'navbar-toggler-icon',
                    'nav-container'         => 'collapse',
                ],
                'side-navbar'  => [
                    'container'         => 'd-none d-lg-block m-0 p-0',
                    'nav-logo'          => 'nav-logo',
                    'nav-link'          => '',
                ],
                'group'         => [
                    'container'         => 'my-1',
                    'title-container'   => 'px-2 mb-1 text-secondary nav-group-title',
                    'icon'              => 'me-2',
                    'title'             => 'fw-bold',
                ],
                'item'          => [
                    'container'         => 'd-block m-0 py-3 px-2 nav-item',
                    'container-group'   => 'd-block m-0 py-2 px-2 nav-item',
                    'active'            => 'active',
                    'icon'              => 'me-2',
                    'grouped-icon'      => 'fas fa-square fa-fw me-2',
                    'label'             => '',
                ],
            ],
        ],
    ],
    'app-layout-settings'   => [
        'breadcrumbs'           => [
            'enabled'               => true,
        ],
        'permissions'           => [
            'enabled'               => true,
        ],
        'navigation'            => [
            'enabled'               => true,
        ],
    ]
];
