<?php


namespace app\controllers;

use app\models\validate\DateValidate;
use app\models\currencyGetInfo\GetInfo;

class CurrencyController
{
    public function main(DateValidate $data)
    {
        $this->currencyGetInfo($data);
    }

    private function currencyGetInfo(DateValidate $data)
    {
    //    print_r($data);
        $getInfo = new GetInfo($data);
        $getInfo->main();
        print_r($getInfo);
    }
}