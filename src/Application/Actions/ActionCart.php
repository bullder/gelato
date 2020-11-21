<?php declare(strict_types=1);

namespace App\Application\Actions;

use App\Domain\DiscountRepository;
use App\Domain\ShoppingCart;
use App\Domain\SkuRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

class ActionCart extends Action
{
    protected DiscountRepository $discountRepository;
    protected SkuRepository $skuRepository;

    public function __construct(LoggerInterface $logger, DiscountRepository $discountRepository, SkuRepository $skuRepository)
    {
        parent::__construct($logger);
        $this->discountRepository = $discountRepository;
        $this->skuRepository = $skuRepository;
    }

    protected function action(): Response
    {
        $addSku = $this->request->getAttribute('add', '');
        if ('' === $addSku) {
            $q  = $this->request->getQueryParams();
        } else {
            $this->request->getAttribute('session');
        }

        $cart = new ShoppingCart();
        $cart->addSku($this->skuRepository->byId('A'));
        $cart->addSku($this->skuRepository->byId('A'));
        $cart->addSku($this->skuRepository->byId('A'));
        $cart->addSku($this->skuRepository->byId('B'));
        $cart->addSku($this->skuRepository->byId('C'));
        $cart->addSku($this->skuRepository->byId('D'));
        $cart->addDiscount($this->discountRepository->byId(2));
        $cart->getTotal();

        return Twig::fromRequest($this->request)->render($this->response, 'index.html', [
            'skus' => $this->skuRepository->findAll(),
            'cart' => $cart,
        ]);
    }
}
