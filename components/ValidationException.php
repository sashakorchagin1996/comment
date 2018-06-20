<?php

namespace app\components;

use Yii;

class ValidationException extends \yii\base\Exception
{
    public function __construct($table)
    {
        parent::__construct("Неудачная валидация данных перед сохранением данных в таблицу $table", 400);
    }
}