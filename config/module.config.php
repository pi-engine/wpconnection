<?php

namespace WPConnection;

use Laminas\Mvc\Middleware\PipeSpec;
use Laminas\Router\Http\Literal;
use User\Middleware\AuthenticationMiddleware;
use User\Middleware\AuthorizationMiddleware;
use User\Middleware\SecurityMiddleware;

return [
    'service_manager' => [
        'aliases' => [
        ],
        'factories' => [
            Service\CouponService::class => Factory\Service\CouponServiceFactory::class,
            Handler\InstallerHandler::class => Factory\Handler\InstallerHandlerFactory::class,
            Handler\Admin\Coupon\CouponListHandler::class => Factory\Handler\Admin\Coupon\CouponListHandlerFactory::class,
            Handler\Admin\Coupon\CouponCreateHandler::class => Factory\Handler\Admin\Coupon\CouponCreateHandlerFactory::class,
            Handler\Admin\Coupon\CouponUpdateHandler::class => Factory\Handler\Admin\Coupon\CouponUpdateHandlerFactory::class,
            Handler\Admin\Coupon\CouponRetrieveHandler::class => Factory\Handler\Admin\Coupon\CouponRetrieveHandlerFactory::class,
            Handler\Admin\Coupon\CouponDeleteHandler::class => Factory\Handler\Admin\Coupon\CouponDeleteHandlerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'admin' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/admin',
                    'defaults' => [],
                ],
                'child_routes' => [
                    'wpconnection' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/wpconnection',
                            'defaults' => [],
                        ],
                        'child_routes' => [
                            'coupon' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/coupon',
                                    'defaults' => [],
                                ],
                                'child_routes' => [
                                    'retrieve' => [
                                        'type' => Literal::class,
                                        'options' => [
                                            'route' => '/retrieve',
                                            'defaults' => [
                                                'module' => 'wpconnection',
                                                'section' => 'admin',
                                                'package' => 'coupon',
                                                'handler' => 'retrieve',
                                                'permissions' => 'coupon-retrieve',
                                                'controller' => PipeSpec::class,
                                                'middleware' => new PipeSpec(
                                                    SecurityMiddleware::class,
                                                    AuthenticationMiddleware::class,
                                                    AuthorizationMiddleware::class,
                                                    Handler\Admin\Coupon\CouponRetrieveHandler::class
                                                ),
                                            ],
                                        ],
                                    ],
                                    'create' => [
                                        'type' => Literal::class,
                                        'options' => [
                                            'route' => '/create',
                                            'defaults' => [
                                                'module' => 'wpconnection',
                                                'section' => 'admin',
                                                'package' => 'coupon',
                                                'handler' => 'create',
                                                'permissions' => 'coupon-create',
                                                'controller' => PipeSpec::class,
                                                'middleware' => new PipeSpec(
                                                    SecurityMiddleware::class,
                                                    AuthenticationMiddleware::class,
                                                    AuthorizationMiddleware::class,
                                                    Handler\Admin\Coupon\CouponCreateHandler::class
                                                ),
                                            ],
                                        ],
                                    ],
                                    'update' => [
                                        'type' => Literal::class,
                                        'options' => [
                                            'route' => '/update',
                                            'defaults' => [
                                                'module' => 'wpconnection',
                                                'section' => 'admin',
                                                'package' => 'coupon',
                                                'handler' => 'update',
                                                'permissions' => 'coupon-update',
                                                'controller' => PipeSpec::class,
                                                'middleware' => new PipeSpec(
                                                    SecurityMiddleware::class,
                                                    AuthenticationMiddleware::class,
                                                    AuthorizationMiddleware::class,
                                                    Handler\Admin\Coupon\CouponUpdateHandler::class
                                                ),
                                            ],
                                        ],
                                    ],
                                    'list' => [
                                        'type' => Literal::class,
                                        'options' => [
                                            'route' => '/list',
                                            'defaults' => [
                                                'module' => 'wpconnection',
                                                'section' => 'admin',
                                                'package' => 'coupon',
                                                'handler' => 'list',
                                                'permissions' => 'coupon-list',
                                                'controller' => PipeSpec::class,
                                                'middleware' => new PipeSpec(
                                                    SecurityMiddleware::class,
                                                    AuthenticationMiddleware::class,
                                                    AuthorizationMiddleware::class,
                                                    Handler\Admin\Coupon\CouponListHandler::class
                                                ),
                                            ],
                                        ],
                                    ],
                                    'delete' => [
                                        'type' => Literal::class,
                                        'options' => [
                                            'route' => '/delete',
                                            'defaults' => [
                                                'module' => 'wpconnection',
                                                'section' => 'admin',
                                                'package' => 'coupon',
                                                'handler' => 'delete',
                                                'permissions' => 'coupon-delete',
                                                'controller' => PipeSpec::class,
                                                'middleware' => new PipeSpec(
                                                    SecurityMiddleware::class,
                                                    AuthenticationMiddleware::class,
                                                    AuthorizationMiddleware::class,
                                                    Handler\Admin\Coupon\CouponDeleteHandler::class
                                                ),
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            'installer' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/installer',
                                    'defaults' => [
                                        'module' => 'user',
                                        'section' => 'admin',
                                        'package' => 'installer',
                                        'handler' => 'installer',
                                        'controller' => PipeSpec::class,
                                        'middleware' => new PipeSpec(
                                            SecurityMiddleware::class,
                                            AuthenticationMiddleware::class,
                                            Handler\InstallerHandler::class
                                        ),
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];