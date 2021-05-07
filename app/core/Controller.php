<?php


namespace app\core;

use app\controllers\ValidateController;
use app\controllers\CurrencyController;
use app\views\Error;

/**
 * Class Controller
 * @package app\core
 */
class Controller
{

    /**
     * Основной метод считывающий нажатие кнопки на форме
     */
    public function start(): void
    {
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