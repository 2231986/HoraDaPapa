<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "meal".
 *
 * @property int $id id da refeição
 * @property int $dinner_table_id id da mesa
 * @property int $checkout estado do pagamento
 * @property string $date_time data de criação
 *
 * @property Dinner $dinnerTable
 * @property Invoice[] $invoices
 * @property Request[] $requests
 */
class Meal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dinner_table_id'], 'required'],
            [['dinner_table_id', 'checkout'], 'integer'],
            [['date_time'], 'safe'],
            [['dinner_table_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dinner::class, 'targetAttribute' => ['dinner_table_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id da refeição',
            'dinner_table_id' => 'id da mesa',
            'checkout' => 'estado do pagamento',
            'date_time' => 'data de criação',
        ];
    }

    /**
     * Gets query for [[DinnerTable]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDinnerTable()
    {
        return $this->hasOne(Dinner::class, ['id' => 'dinner_table_id']);
    }

    /**
     * Gets query for [[Invoices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::class, ['meal_id' => 'id']);
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['meal_id' => 'id']);
    }
}
