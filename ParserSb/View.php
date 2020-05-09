<?php


class View
{
    //Класс отвечающий за отображение информации.
    public function output($data)
    {   echo $data['date'].'<br>';
        echo 'Курс USD: '.$data['USD']['curr'].$this->dynMarker($data['USD']['dyn']).'<br>';
        echo 'Курс EUR: '.$data['EUR']['curr'].$this->dynMarker($data['EUR']['dyn']).'<br>';
    }

    private function dynMarker($dyn){
        switch ($dyn) {
            case 0:
                echo "";
                break;
            case 1:
                echo "<img src=img/up.png >";
                break;
            case -1:
                echo "<img src=img/down.png >";
                break;
        }
    }
}