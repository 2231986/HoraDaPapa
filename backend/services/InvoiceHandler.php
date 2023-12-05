<?php

namespace app\services;

use app\models\Meal;
use app\models\Dinner;
use app\models\Invoice;
use common\components\Mosquitto;
use common\models\UserInfo;
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
        if ($userID != null)
        {
            $requests = $meal->getRequestsByUser($userID);
            $invoiceTotalPrice = $meal->getMealCurrentPaidedAmountByUser($userID);
        }
        else
        {
            $requests = $meal->getRequests();
            $invoiceTotalPrice = $meal->getMealTotalPaymentAmount();
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
