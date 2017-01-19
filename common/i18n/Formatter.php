<?php
/**
 * @author: Pan Wenbin <panwenbin@gmail.com>
 */

namespace common\i18n;


use yii\helpers\Markdown;

class Formatter extends \yii\i18n\Formatter
{
    public function asMarkdown($value)
    {
        if ($value === null) {
            return $this->nullDisplay;
        }
        return Markdown::process($value, 'gfm');
    }
}