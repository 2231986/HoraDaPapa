<?php

namespace common\models;

use Yii;
use app\models\Supplier;
use app\models\Review;
use app\models\Request;
use common\models\Favorite;

/**
 * This is the model class for table "plate".
 *
 * @property int $id id do prato
 * @property string $description descrição do prato
 * @property float $price preço do prato
 * @property string $title titulo do prato
 * @property string $date_time data
 * @property string|null $image_name nome da imagem
 * @property int $supplier_id id do fornecedor
 *
 * @property Favorite[] $favorites
 * @property Request[] $requests
 * @property Review[] $reviews
 * @property Supplier $supplier
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
            [['description', 'price', 'title', 'supplier_id'], 'required'],
            [['price'], 'number'],
            [['date_time'], 'safe'],
            [['supplier_id'], 'integer'],
            [['description', 'title', 'image_name'], 'string', 'max' => 255],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::class, 'targetAttribute' => ['supplier_id' => 'id']],
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
     * Gets query for [[Supplier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::class, ['id' => 'supplier_id']);
    }

    public function getPopularPlates()
    {
        return static::find()
            ->select(['plate.*', 'COUNT(request.id) AS request_count'])
            ->leftJoin('request', 'plate.id = request.plate_id')
            ->groupBy('plate.id')
            ->orderBy(['request_count' => SORT_DESC])
            ->limit(3)
            ->all();
    }
}
