<?php

namespace WPConnection\Handler\Admin\Coupon;

use WPConnection\Service\CouponService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CouponCreateHandler implements RequestHandlerInterface
{
    /** @var ResponseFactoryInterface */
    protected ResponseFactoryInterface $responseFactory;

    /** @var StreamFactoryInterface */
    protected StreamFactoryInterface $streamFactory;

    /** @var CouponService */
    protected CouponService $couponService;

    public function __construct(
        ResponseFactoryInterface $responseFactory,
        StreamFactoryInterface   $streamFactory,
        CouponService            $couponService
    )
    {
        $this->responseFactory = $responseFactory;
        $this->streamFactory = $streamFactory;
        $this->couponService = $couponService;
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $requestBody = $request->getParsedBody();

        $params = [
            'code' => $requestBody['code'] ?? 'test',
            'discount_type' => $requestBody['discount_type'] ?? 'percent',
            'amount' => $requestBody['amount'] ?? '10',
            'individual_use' => true,
            'exclude_sale_items' => true,
            'minimum_amount' => $requestBody['minimum_amount'] ?? '100.00',
        ];

        $result = $this->couponService->createCoupon($params);
        return new JsonResponse($result);
    }
}