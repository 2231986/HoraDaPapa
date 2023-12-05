<?php

namespace app\models;

use common\models\User;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property int $id id da fatura
 * @property float $price preço final
 * @property int $meal_id id da refeição
 * @property string $date_time data
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
            [['meal_id', 'user_id'], 'integer'],
            [['date_time'], 'safe'],
            [['meal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meal::class, 'targetAttribute' => ['meal_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Número de fatura',
            'price' => 'Total',
            'meal_id' => 'Número de refeição',
            'date_time' => 'Data',
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

    /**
     * Gets query for [[Userl]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
