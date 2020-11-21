<?php declare(strict_types=1);

namespace App\Domain\DomainException;

class SkuNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The sku you requested does not exist.';
}
