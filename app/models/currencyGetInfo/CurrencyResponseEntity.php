<?php


namespace app\models\currencyGetInfo;

/**
 * Class CurrencyResponseEntity сущность для результатов
 * @package app\models\currencyGetInfo
 */
class CurrencyResponseEntity
{
    private string $date;
    private string $value;

    public function __construct(string $date, string $value)
    {
        $this->date = $date;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}