<?php


namespace app\controllers;

use app\models\currencyGetInfo\CurrencyModel;
use app\models\validate\DateValidate;
use app\models\currencyGetInfo\GetInfo;
use app\views\Error;
use app\views\Graph;


/**
 * Class CurrencyController
 * @package app\controllers
 */
class CurrencyController
{
    /**
     * Основной регулировщик
     * @param DateValidate $data
     */
    public function main(DateValidate $data)
    {
        $result = $this->currencyGetInfo($data);
        if ($result->isStop() === true) {
            Error::error($result->getError());
        } else {
            $json = $this->toJson($result);
            Graph::show($result, $json);
        }
    }

    /**
     * Вызов нужного use case-a
     * @param DateValidate $data
     * @return CurrencyModel
     */
    private function currencyGetInfo(DateValidate $data): CurrencyModel
    {
        $getInfo = new GetInfo($data);
        return $getInfo->main();
    }


    /**
     * @param CurrencyModel $data
     * @return string типа json
     */
    private function toJson(CurrencyModel $data): array
    {
        $date = [];
        $value = [];
        foreach ($data->getCurrencyResponseEntity() as $item) {
            $date[] = $item->getDate();

            // необходимо перевести строку в дробное число для корректной работы js кода
            $val = str_replace(",",".", $item->getValue());
            $value[] = (float) $val;
        }

        $result = [
            'date' => json_encode($date),
            'value' => json_encode($value)
        ];

        return $result;
    }
}