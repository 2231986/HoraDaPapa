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
 * @property string|null $image_name nome da imagem
 *
 * @property Favorite[] $favorites
 * @property Request[] $requests
 * @property Review[] $reviews
 * @property Supplier[] $suppliers
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
            [['description', 'title', 'image_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Identificador',
            'description' => 'Descrição',
            'price' => 'Preço',
            'title' => 'Prato',
            'date_time' => 'Data',
            'image_name' => 'Imagem',
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

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::class, ['plate_id' => 'id']);
    }

    /**
     * Gets query for [[Suppliers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers()
    {
        return $this->hasMany(Supplier::class, ['plate_id' => 'id']);
    }
}
