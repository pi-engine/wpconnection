<?php

namespace WPConnection\Handler\Admin\Coupon;

use WPConnection\Service\CouponService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CouponListHandler implements RequestHandlerInterface
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
            'page' => $requestBody['page'] ?? 1,
            'per_page' => $requestBody['per_page'] ?? 10,
            'order' => $requestBody['order'] ?? 'desc',
            'orderby' => $requestBody['orderby'] ?? 'date',
            'search' => $requestBody['search'] ?? '',
            'after' => $requestBody['after'] ?? null,
            'before' => $requestBody['before'] ?? null,
        ];

        $result = $this->couponService->getCouponList($params);
        return new JsonResponse($result);
    }
}