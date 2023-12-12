<?php

namespace backend\models;

use yii\helpers\BaseFileHelper;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate())
        {
            $hash = md5(uniqid());
            $uniqueID = $hash . '.' . $this->imageFile->extension;
            $uploadPath = \Yii::getAlias('@backend/web/uploads/') . $uniqueID;

            BaseFileHelper::createDirectory(\Yii::getAlias('@backend/web/uploads'));

            if ($this->imageFile->saveAs($uploadPath))
            {
                return $uniqueID;
            }
            else
            {
                \Yii::error('Error saving uploaded file.');
            }
        }

        \Yii::error('Validation error: ' . print_r($this->errors, true));
        return false;
    }

    public static function deleteImage($uniqueID)
    {
        $filePath = \Yii::getAlias('@backend/web/uploads/') . $uniqueID;

        if (file_exists($filePath) && is_file($filePath))
        {
            return unlink($filePath);
        }

        return false;
    }
}
