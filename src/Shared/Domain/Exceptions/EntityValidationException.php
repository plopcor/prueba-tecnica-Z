<?php

namespace Src\Shared\Domain\Exceptions;

class EntityValidationException extends \DomainException
{
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }
}
