<?php

namespace app\models\validate;

use DateTime;

/**
 * Модель валидатора
 * Class DateValidate
 * @package app\models\validate
 */
class DateValidate
{

    private string $format = 'Y-m-d';
    private ?string $dateStart = NULL;
    private ?string $dateEnd = NULL;

    /**
     * Проверка дат на истинность (Первая всегда задана, первая меньше второй)
     * @param string $dateOne
     * @param string $dateTwo
     * @return $this
     */
    public function checkDate(string $dateOne, string $dateTwo): self
    {
        // Из формы может прийти только одна дата
        if (!empty($dateOne) && empty($dateTwo)) {
            $this->dateStart = $this->dateFormat($dateOne);
        }
        elseif (empty($dateOne) && !empty($dateTwo)) {
            $this->dateStart = $this->dateFormat($dateTwo);
        }
        // Если пришли обе даты, то начальная должна быть меньше второй. Если они равны, то вторую "затираем"
        elseif (!empty($dateOne) && !empty($dateTwo)) {
            $dateOneFormatted = $this->dateFormat($dateOne);
            $dateTwoFormatted = $this->dateFormat($dateTwo);
            if ($dateOneFormatted < $dateTwoFormatted) {
                $this->dateStart = $dateOneFormatted;
                $this->dateEnd = $dateTwoFormatted;
            } elseif ($dateOneFormatted > $dateTwoFormatted) {
                $this->dateStart = $dateTwoFormatted;
                $this->dateEnd = $dateOneFormatted;
            } elseif ($dateOneFormatted = $dateTwoFormatted) {
                $this->dateStart = $dateOneFormatted;
            }
        }

        return $this;
    }


    /**
     * Перевод даты в необходимый формат ((dd/mm/yyyy)
     * @param string $date
     * @return string
     */
    private function dateFormat(string $date): string
    {
        $newFormat = DateTime::createFromFormat($this->format, $date);
        return $newFormat->format('d/m/Y');
    }

    /**
     * @return string|null
     */
    public function getDateStart(): ?string
    {
        return $this->dateStart;
    }

    /**
     * @return string|null
     */
    public function getDateEnd(): ?string
    {
        return $this->dateEnd;
    }
}