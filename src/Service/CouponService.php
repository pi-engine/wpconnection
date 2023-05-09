<?php

namespace WPConnection\Service;

use Automattic\WooCommerce\Client as WooCommerceClient;
use function array_shift;
use function array_values;
use function class_exists;
use function date;
use function in_array;
use function is_numeric;
use function is_object;
use function json_decode;
use function json_encode;
use function sprintf;
use function str_ends_with;
use function str_replace;
use function strtotime;
use function time;

class CouponService implements ServiceInterface
{

    protected $config;

    public function __construct(
        $config,
    )
    {
        $this->config = $config;
    }

    public
    function getCouponList($params)
    {


        // Set woocommerce object
        $woocommerce = new WooCommerceClient(
            $this->config['url'],
            $this->config['ck'],
            $this->config['cs'],
            $this->config['option']
        );


        $endPoint = sprintf(
            'coupons?page=%s&per_page=%s&order=%s&orderby=%s&search=%s',
            $params['page'], $params['per_page'], $params['order'], $params['orderby'], $params['search']
        );

        if (isset($params['after'])) {
            $endPoint .= sprintf(
                '&after=%s',
                $params['after']
            );
        }
        if (isset($params['before'])) {
            $endPoint .= sprintf(
                '&before=%s',
                $params['before']
            );
        }


        return json_decode(json_encode($woocommerce->get($endPoint)), true);
    }


}
