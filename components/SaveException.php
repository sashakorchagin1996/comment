<?php

namespace app\components;

use Yii;

class SaveException extends \yii\base\Exception
{
    public function __construct($table)
    {
        parent::__construct("Неудачное сохранение данных в таблицу $table", 400);
    }
}