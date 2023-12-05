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

        $requests = $meal->getRequests()->all();

        $invoiceTotalPrice = 0;
        foreach ($requests as $request)
        {
            $invoiceTotalPrice += $request->price;
        }

        $userInfo = UserInfo::findOne($userID);
        $userInfoNIF = "999999999";
        if ($userInfo->nif)
        {
            $userInfoNIF = $userInfo->nif;
        }

        $invoice = new Invoice();
        $invoice->meal_id = $mealID;
        $invoice->price = $invoiceTotalPrice;
        $invoice->nif = $userInfoNIF;

        $invoice->save();

        //TODO: implementar este campo apenas quando todos os clientes tiverem pago as suas respetivas frações
        //$meal->checkout = 1;
        $meal->save();

        $dinner = Dinner::findOne($meal->dinner_table_id);
        $dinner->isClean = 0;
        $dinner->save();

        \Yii::$app->Mosquitto->publish(Mosquitto::getTopic($userID), 'Fatura Emitida!');

        return [
            'dinner' => $dinner,
            'meal' => $meal,
            'invoice' => $invoice,
            'requests' => $requests,
        ];
    }
}
