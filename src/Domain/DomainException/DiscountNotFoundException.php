<?php declare(strict_types=1);

namespace App\Domain\DomainException;

class DiscountNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The discount you requested does not exist.';
}
