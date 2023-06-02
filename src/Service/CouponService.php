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
    protected WooCommerceClient $woocommerce;
    protected WooCommerceClient $v3_woocommerce;

    public function __construct(
        $config,
    )
    {
        $this->config = $config;
        // Set woocommerce object
        $this->woocommerce = new WooCommerceClient(
            $this->config['url'],
            $this->config['ck'],
            $this->config['cs'],
            $this->config['option']
        );
        $this->v3_woocommerce = new WooCommerceClient(
            $this->config['url'],
            $this->config['ck'],
            $this->config['cs'],
            $this->config['v3_option']
        );
    }

    public
    function getCouponList($params)
    {


        $endPoint = sprintf(
            'coupons?page=%s&per_page=%s&order=%s&orderby=%s&search=%s',
            $params['page'], $params['per_page'], $params['order'], $params['orderby'], $params['search']
        );
        $v3_endPoint = sprintf(
            'coupons/count?page=%s&per_page=%s&order=%s&orderby=%s&search=%s',
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
        $list=[];
        $count = json_decode(json_encode($this->v3_woocommerce->get($v3_endPoint . $endPoint)), true)['count'];
        $result = $this->woocommerce->get($endPoint);

        if (isset($count)) {
            $list = $count > 0 ? ($result ? json_decode(json_encode($result), true) : []) : [];
        }


        return [
            'result' => true,
            'data' => [
                'list' => $list,
                'paginator' => [
                    'count' => $count,
                    'limit' => $params['per_page'],
                    'page' => $params['page'],
                ],
                'filters' => $params,
            ],
            'error' => [],
        ];
    }

    public function createCoupon(array $params)
    {


        $endPoint = sprintf(
            'coupons'
        );

        return json_decode(json_encode($this->woocommerce->post($endPoint, $params)), true);
    }

    public function updateCoupon(array $params)
    {


        $endPoint = sprintf(
            'coupons/%s', $params['id']
        );

        return json_decode(json_encode($this->woocommerce->put($endPoint, ['amount' => $params['amount']])), true);
    }

    public function retrieveCoupon(array $params)
    {
        // Set woocommerce object
        $woocommerce = new WooCommerceClient(
            $this->config['url'],
            $this->config['ck'],
            $this->config['cs'],
            $this->config['option']
        );


        $endPoint = sprintf(
            'coupons/%s', $params['id']
        );

        return json_decode(json_encode($this->woocommerce->get($endPoint, $params)), true);
    }

    public function deleteCoupon(array $params)
    {


        $endPoint = sprintf(
            'coupons/%s', $params['id']
        );

        return json_decode(json_encode($this->woocommerce->delete($endPoint, ['force' => $params['force']])), true);
    }


}
