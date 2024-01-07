<?php

namespace app\services;

use app\models\Meal;
use app\models\Dinner;
use app\models\Invoice;
use app\models\Request;
use common\components\Mosquitto;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;

class InvoiceHandler
{
    public static function GenerateInvoice($mealID, $userID)
    {
        $meal = Meal::findOne($mealID);

        if (!$meal)
        {
            throw new NotFoundHttpException('Meal not found.');
        }

        if ($meal->checkout == 1)
        {
            throw new HttpException(403, 'Checkout is already paid.');
        }

        $requests = null;
        $hasRequestsToCook = Request::find()->joinWith('meal')->where(['meal_id' => $mealID, 'isCooked' => 0]);
        $hasRequestsToDelivery = Request::find()->joinWith('meal')->where(['meal_id' => $mealID, 'isDelivered' => 0]);

        if ($userID != null) //Quando tem User
        {
            $hasRequestsToCook->andWhere(['user_id' => $userID])->one();
            $hasRequestsToDelivery->andWhere(['user_id' => $userID])->one();

            $requests = $meal->getRequestsByUser($userID);
            $invoiceTotalPrice = $meal->getMealCurrentPaidedAmountByUser($userID);
        }
        else //Quando NÃO tem User
        {
            $hasRequestsToCook->one();
            $hasRequestsToDelivery->one();

            $requests = $meal->getRequests();
            $invoiceTotalPrice = $meal->getMealTotalPaymentAmount();
        }

        if ($hasRequestsToCook->exists())
        {
            throw new HttpException(403, "A refeição Nº$mealID tem pedidos por Cozinhar!");
        }

        if ($hasRequestsToDelivery->exists())
        {
            throw new HttpException(403, "A refeição Nº$mealID tem pedidos por Entregar!");
        }

        $invoice = new Invoice();
        $invoice->meal_id = $mealID;
        $invoice->user_id = $userID;
        $invoice->price = $invoiceTotalPrice;

        $invoice->save();

        if ($meal->getMealRemainingPaymentAmount() <= 0)
        {
            $meal->checkout = 1;
        }
        $meal->save();

        $dinner = Dinner::findOne($meal->dinner_table_id);
        $dinner->isClean = 0;
        $dinner->save();

        if ($userID != null)
        {
            \Yii::$app->Mosquitto->publish(Mosquitto::getTopic($userID), 'Fatura Emitida!');
        }

        return [
            'dinner' => $dinner,
            'meal' => $meal,
            'invoice' => $invoice,
            'requests' => $requests,
        ];
    }
}
