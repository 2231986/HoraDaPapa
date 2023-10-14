<?php

namespace common\models;

use app\models\Favorite;
use app\models\Request;

/**
 * This is the model class for table "plate".
 *
 * @property int $id id do prato
 * @property int $description descrição do prato
 * @property float $price preço do prato
 *
 * @property Favorite[] $favorites
 * @property Request[] $requests
 */
class Plate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'price'], 'required'],
            [['description'], 'string', 'max' => 255],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id do prato',
            'description' => 'descrição do prato',
            'price' => 'preço do prato',
        ];
    }

    /**
     * Gets query for [[Favorites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorite::class, ['plate_id' => 'id']);
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['plate_id' => 'id']);
    }
}
