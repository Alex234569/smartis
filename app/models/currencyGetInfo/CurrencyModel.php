<?php


namespace app\models\currencyGetInfo;

/**
 * Class currencyModel для хранения возможной ошибки и класса с результатами
 * @package app\models\currencyGetInfo
 */
class currencyModel
{
    private string $dateStart;
    private ?string $dateEnd;
    private array $currencyResponseEntity;

    private bool $stop = false;
    private ?string $error = NULL;

    public function __construct(string $dateStart, ?string $dateEnd = NULL)
    {
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }

    /**
     * @param string $error
     */
    public function setError(string $error): void
    {
        $this->stop = true;
        $this->error = $error;
    }

    /**
     * @param array $currencyResponseEntity
     */
    public function setCurrencyResponseEntity(array $currencyResponseEntity): void
    {
        $this->currencyResponseEntity = $currencyResponseEntity;
    }

    /**
     * @return string
     */
    public function getDateStart(): string
    {
        return $this->dateStart;
    }

    /**
     * @return ?string
     */
    public function getDateEnd(): ?string
    {
        return $this->dateEnd;
    }

    /**
     * @return array
     */
    public function getCurrencyResponseEntity(): array
    {
        return $this->currencyResponseEntity;
    }

    /**
     * @return bool
     */
    public function isStop(): bool
    {
        return $this->stop;
    }

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }
}