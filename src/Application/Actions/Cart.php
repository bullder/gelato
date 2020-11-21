<?php declare(strict_types=1);

namespace App\Application\Actions;

use App\Domain\DiscountRepository;
use App\Domain\SkuRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

class Cart extends Action
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

        return Twig::fromRequest($this->request)->render($this->response, 'index.html', [
            'name' => '',
            'skus' => $this->skuRepository->findAll(),
            'discounts' => $this->discountRepository->findAll(),
        ]);
    }
}