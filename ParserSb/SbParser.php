<?php

class SbParser
{
    private $valuteId; //Код валюты согласно api sb.ru
    private $dailyLink = "http://www.cbr.ru/scripts/XML_daily.asp?";


    //при вызове функции передается ID валюты согласно API sb.ru и дата
    public function getCurrency($valuteId, $date_req)
    {
        $this->valuteId = $valuteId;

        // Получаем дату предидущего дня
        $prev_date_req = date('d/m/Y', strtotime(date('d/m/Y', strtotime($date_req)) . ' -1 day'));

        // ссылки для обращения к API сбербанка
        $link1 = $this->dailyLink . 'date_req=' . $date_req;
        $link2 = $this->dailyLink . 'date_req=' . $prev_date_req;

        //Получаем данные с сервера, парсим в обьект класса SimpleXMLElement и получаем значения курса валют.
        $content = file_get_contents($link2);
        $xml = simplexml_load_string($content);
        $prev_currency = $this->getValue($xml);
        $content = file_get_contents($link1);
        $xml = simplexml_load_string($content);
        $currency = $this->getValue($xml);

        //проверяем динамику изменения курса (1 - цена выросла, -1 - цена упала, 0 - цена осталась без изменения)
        $curr_prev = (int)((float)str_replace(',', '.', $prev_currency)*1000);
        $curr = (int)((float)str_replace(',', '.', $currency)*1000);

        if ( $curr_prev< $curr) $dyn = 1;
        elseif ($curr_prev>$curr) $dyn = -1;
        else $dyn = 0;

        //возвращаем ассоциативный массив
        return ['curr' => $currency, 'dyn' => $dyn];

    }

    //ищем валюту по ID
    private function getValue($xml)
    {
        foreach ($xml->Valute as $val)
            if ($val->attributes()[0] == $this->valuteId) return $val->Value;
    }

}
