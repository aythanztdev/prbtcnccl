<?php


namespace App\Service;


use App\DBAL\Types\CurrencyEnum;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ValidateService
{
    public function validateCurrency(string $currency)
    {
        if (!array_search($currency, CurrencyEnum::getChoices()))
            throw new BadRequestHttpException('Currency value is not accepted');

    }
}