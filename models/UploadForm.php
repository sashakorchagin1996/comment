<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $File;

    public function rules()
    {
        return [
            [['File'], 'file', 'skipOnEmpty' => false, 'extensions' => 'txt'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->File->saveAs('uploads/' . $this->File->baseName . '.' . $this->File->extension);
            return true;
        } else {
            return false;
        }
    }
}