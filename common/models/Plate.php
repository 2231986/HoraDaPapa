<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "plate".
 *
 * @property int $id id do prato
 * @property string $description descrição do prato
 * @property float $price preço do prato
 * @property string $title titulo do prato
 * @property string $date_time data
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
            [['description', 'price', 'title'], 'required'],
            [['price'], 'number'],
            [['date_time'], 'safe'],
            [['description', 'title'], 'string', 'max' => 255],
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
            'title' => 'titulo do prato',
            'date_time' => 'data',
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
