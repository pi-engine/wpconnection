<?php

namespace WPConnection\Factory\Handler\Admin\Coupon;


use WPConnection\Handler\Admin\Coupon\CouponUpdateHandler;
use WPConnection\Service\CouponService;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class CouponUpdateHandlerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param mixed[]|null       $options
     *
     * @return object
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new CouponUpdateHandler(
            $container->get(ResponseFactoryInterface::class),
            $container->get(StreamFactoryInterface::class),
            $container->get(CouponService::class)
        );
    }
}