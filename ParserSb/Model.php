<?php


class Model
{
    public function getData($date)
    {
        //Класс модели. Взаимодействует с парсером.

        $sbp = new SbParser(); // R01239 - код ЕUR, R01235 - код USD согласно API

        $currencyEUR = $sbp->getCurrency('R01239', $date);
        $currencyUSD = $sbp->getCurrency('R01235', $date);

        return ['date'=>$date, 'EUR' => $currencyEUR, 'USD' => $currencyUSD];
    }
}