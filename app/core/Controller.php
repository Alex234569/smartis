<?php


namespace app\core;

use app\controllers\ValidateController;
use app\controllers\CurrencyController;
use app\views\Error;

class Controller
{

    public function start(): void
    {
        echo "<pre>";
    //    print_r($_POST);
        if (isset($_POST['buttonTime'])) {
            // проверка на передачу хотя бы одной даты
            if (empty($_POST['dateOne']) && empty($_POST['dateTwo'])) {
                Error::error('Введите хотя бы одну дату');
            } else {
                $validateController = new ValidateController();
                $currencyController = new CurrencyController();
                $dataAfterValidate = $validateController->main($_POST);
                $currencyController->main($dataAfterValidate);
            }
        }
    }

}