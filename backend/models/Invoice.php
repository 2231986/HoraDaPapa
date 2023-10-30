<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property int $id id da fatura
 * @property float $price preço final
 * @property int $meal_id id da refeição
 * @property string $date_time data
 * @property string|null $nif número fiscal do cliente
 *
 * @property Meal $meal
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'meal_id'], 'required'],
            [['price'], 'number'],
            [['meal_id'], 'integer'],
            [['date_time'], 'safe'],
            [['nif'], 'string', 'max' => 255],
            [['meal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meal::class, 'targetAttribute' => ['meal_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id da fatura',
            'price' => 'preço final',
            'meal_id' => 'id da refeição',
            'date_time' => 'data',
            'nif' => 'número fiscal do cliente',
        ];
    }

    /**
     * Gets query for [[Meal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeal()
    {
        return $this->hasOne(Meal::class, ['id' => 'meal_id']);
    }
}
