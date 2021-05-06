<?php


namespace app\controllers;

use app\models\validate\DateValidate;

class ValidateController
{
    /**
     * Основной регулировщик валидатора
     * @param array $data
     * @return DateValidate
     */
    public function main(array $data): DateValidate
    {
        // Так как форма только одна, то нет смысла проводить проверку на предмет откуда пришли данные и какие
        return $this->checkDate($data);
    }

    /**
     * Метод для проверки времени
     * @param array $data
     * @return DateValidate
     */
    public function checkDate(array $data): DateValidate
    {
        $validate = new DateValidate();
        return $validate->checkDate($data['dateOne'], $data['dateTwo']);
    }
}