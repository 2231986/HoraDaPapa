<?php

namespace common\helpers;

use Yii;

class FormatterHelper
{
    public static function formatCurrency($value)
    {
        return Yii::$app->formatter->asDecimal($value, 2) . ' €';
    }
}
