<?php


namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;


class CurrencyEnum extends AbstractEnumType
{
    public const EUR = 'EUR';
    public const USD = 'USD';

    protected static $choices = [
        self::EUR => self::EUR,
        self::USD => self::USD,
    ];
}