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
            Handler\Admin\Coupon\CouponListHandler::class => Factory\Handler\Admin\Coupon\CouponListHandlerFactory::class,
            Handler\Admin\Coupon\CouponCreateHandler::class => Factory\Handler\Admin\Coupon\CouponCreateHandlerFactory::class,
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
                                    'create' => [
                                        'type' => Literal::class,
                                        'options' => [
                                            'route' => '/create',
                                            'defaults' => [
                                                'module' => 'video',
                                                'section' => 'api',
                                                'package' => 'video',
                                                'handler' => 'list',
                                                'controller' => PipeSpec::class,
                                                'middleware' => new PipeSpec(
                                                    SecurityMiddleware::class,
                                                    AuthenticationMiddleware::class,
                                                    Handler\Admin\Coupon\CouponCreateHandler::class
                                                ),
                                            ],
                                        ],
                                    ],
                                    'list' => [
                                        'type' => Literal::class,
                                        'options' => [
                                            'route' => '/list',
                                            'defaults' => [
                                                'module' => 'video',
                                                'section' => 'api',
                                                'package' => 'video',
                                                'handler' => 'list',
                                                'controller' => PipeSpec::class,
                                                'middleware' => new PipeSpec(
                                                    SecurityMiddleware::class,
                                                    AuthenticationMiddleware::class,
                                                    Handler\Admin\Coupon\CouponListHandler::class
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
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];