<?php


namespace app\models\currencyGetInfo;


use app\models\validate\DateValidate;

/**
 * Class GetInfo для поиска данных и их обработки
 * @package app\models\currencyGetInfo
 */
class GetInfo
{
    private ?string $dateStart;
    private ?string $dateEnd;
    private CurrencyModel $currencyModel;


    public function __construct(DateValidate $data)
    {
        $this->dateStart = $data->getDateStart();
        $this->dateEnd = $data->getDateEnd();
        $this->currencyModel = new CurrencyModel($this->dateStart, $this->dateEnd);
    }


    /**
     * Необходимо разделение на 2 метода, в случае одиночной даты или диапазона
     * В разных случаях возвращаются разные массивы и нужна разная обработка возможной ошибки
     * @return CurrencyModel
     */
    public function main(): CurrencyModel
    {
        if ($this->dateEnd === NULL) {
            $this->oneDate();
        } else {
            $this->twoDates();
        }

        return $this->currencyModel;
    }

    /**
     * В случае, если поиск осуществляется по одной дате
     */
    public function oneDate(): void
    {
        $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $this->dateStart);
        // Самый простой способ перевести xml в "рабочий" формат вида array
        $jsonXML = json_encode($xml);
        $xmlArr = json_decode($jsonXML,TRUE);

        if (trim($xmlArr[0]) === 'Error in parameters') {           // необходим trim() так как возвращается строка с переносами
            $this->currencyModel->setError('Передана неверная дата, ошибка с сайта');
        } else {
            $response = [];
            foreach ($xmlArr['Valute'] as $value) {
                if ($value['CharCode'] === 'USD') {
                    $response[] = new CurrencyResponseEntity($xmlArr['@attributes']['Date'], $value['Value']);
                }
            }
            $this->currencyModel->setCurrencyResponseEntity($response);
        }
    }


    /**
     * В случае, если поиск осуществляется по диапазону
     */
    public function twoDates(): void
    {
        $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_dynamic.asp?date_req1='. $this->dateStart . '&date_req2=' . $this->dateEnd. '&VAL_NM_RQ=R01235');
        $jsonXML = json_encode($xml);
        $xmlArr = json_decode($jsonXML,TRUE);

        if (!isset($xmlArr['Record'])) {
            // в ответе нет так таковой ошибки, но в нем так же нет нужного результата. Пример - указать обе даты из будущего
            $this->currencyModel->setError('Передан неверный диапазон, пустой результат');
        } else {
            $response = [];
            foreach ($xmlArr['Record'] as $value) {
                $response[] = new CurrencyResponseEntity($value['@attributes']['Date'], $value['Value']);
            }
            $this->currencyModel->setCurrencyResponseEntity($response);
        }
    }
}