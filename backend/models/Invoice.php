<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property int $id id da fatura
 * @property float $total preço final
 * @property int $meal_id id da refeição
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
            [['total', 'meal_id'], 'required'],
            [['total'], 'number'],
            [['meal_id'], 'integer'],
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
            'total' => 'preço final',
            'meal_id' => 'id da refeição',
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
