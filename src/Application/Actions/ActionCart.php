<?php declare(strict_types=1);

namespace App\Application\Actions;

use App\Infrastructure\Service\CheckoutBuilderInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

class ActionCart extends Action
{
    protected CheckoutBuilderInterface $builder;

    public function __construct(LoggerInterface $logger, CheckoutBuilderInterface $builder)
    {
        parent::__construct($logger);
        $this->builder = $builder;
    }

    protected function action(): Response
    {
        return Twig::fromRequest($this->request)->render(
            $this->response,
            'index.html',
            ['view' => $this->builder->build($this->request)]
        );
    }
}
