<?php

namespace WPConnection\Factory\Service;
 
use WPConnection\Service\CouponService;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Service\RoleService;

class CouponServiceFactory implements FactoryInterface
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
		 $config = $container->get('config');
        return new CouponService(
             $config['woo']
        );
    }
}