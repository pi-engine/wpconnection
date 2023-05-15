<?php

return [
    'admin' => [
        [
            'module'      => 'wpconnection',
            'section'     => 'admin',
            'package'     => 'coupon',
            'handler'     => 'retrieve',
            'permissions' => 'wpconnection-coupon-retrieve',
            'role'        => [
                'admin',
            ],
        ],
        [
            'module'      => 'wpconnection',
            'section'     => 'admin',
            'package'     => 'coupon',
            'handler'     => 'create',
            'permissions' => 'wpconnection-coupon-create',
            'role'        => [
                'admin',
            ],
        ],
        [
            'module'      => 'wpconnection',
            'section'     => 'admin',
            'package'     => 'coupon',
            'handler'     => 'update',
            'permissions' => 'wpconnection-coupon-update',
            'role'        => [
                'admin',
            ],
        ],
        [
            'module'      => 'wpconnection',
            'section'     => 'admin',
            'package'     => 'coupon',
            'handler'     => 'list',
            'permissions' => 'wpconnection-coupon-list',
            'role'        => [
                'admin',
            ],
        ],
        [
            'module'      => 'wpconnection',
            'section'     => 'admin',
            'package'     => 'coupon',
            'handler'     => 'delete',
            'permissions' => 'wpconnection-coupon-delete',
            'role'        => [
                'admin',
            ],
        ],
    ],
];