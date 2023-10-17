<?php

namespace backend\modules\api\controllers;

use app\models\Invoice;

class InvoiceController extends APIActiveController
{
	public $modelClass = 'backend\models\Invoice';

	public function actionIndex()
	{
		return Invoice::find()->all();
	}
}
