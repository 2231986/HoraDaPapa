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
            [['checkout'], 'number', 'min' => 0, 'max' => 1, 'integerOnly' => true],
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
            'id' => 'ID',
            'dinner_table_id' => 'Mesa',
            'checkout' => 'Pagamento',
            'date_time' => 'Data',
        ];
    }

    /**
     * Gets query for [[DinnerTable]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDinner()
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

    public function getRequestsByUser($userID)
    {
        return $this->getRequests()->andWhere(['user_id' => $userID])->all();
    }

    public function getTodayMeals()
    {
        return self::find()
            ->where(['>=', 'date_time', date('Y-m-d 00:00:00')])
            ->andWhere(['<=', 'date_time', date('Y-m-d 23:59:59')])->all();
    }

    /**
     * Obtem o valor total a pagar pela refeição
     */
    public function getMealTotalPaymentAmount()
    {
        $requests = $this->getRequests()->all();

        $invoiceTotalPrice = 0;

        foreach ($requests as $request)
        {
            $invoiceTotalPrice += ($request->price * $request->quantity);
        }

        return $invoiceTotalPrice;
    }

    /**
     * Obtem o valor total a pagar pela refeição por utilizador
     */
    public function getMealCurrentPaidedAmountByUser($userID)
    {
        $requests = $this->getRequests()->andWhere(['user_id' => $userID])->all();

        $invoiceTotalPrice = 0;

        foreach ($requests as $request)
        {
            $invoiceTotalPrice += ($request->price * $request->quantity);
        }

        return $invoiceTotalPrice;
    }

    /**
     * Obtem o valor total que já foi pago pela refeição
     */
    public function getMealCurrentPaidedAmount()
    {
        $paidedAmount = Invoice::find()
            ->where(['meal_id' => $this->id])
            ->sum('price');

        return $paidedAmount;
    }

    /**
     * Obtem o valor em falta a pagar pela refeição
     */
    public function getMealRemainingPaymentAmount()
    {
        $currentPaidedAmount = $this->getMealCurrentPaidedAmount();
        $mealTotalPaymentAmount = $this->getMealTotalPaymentAmount();

        $remainingPaymentAmount = $mealTotalPaymentAmount - $currentPaidedAmount;

        return $remainingPaymentAmount;
    }
}
