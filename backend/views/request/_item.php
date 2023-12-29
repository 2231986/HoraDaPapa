<?php
use yii\helpers\Html;

// $model represents each individual request within the grouped data

$requestId = $model->id;
$plateTitle = $model->plate->title;

// Display the request details
?>
<div class="request-item">
    <p>
        Request ID: <?= Html::encode($requestId) ?><br>
        Plate Title: <?= Html::encode($plateTitle) ?>
        <!-- Add more fields as needed -->
    </p>
</div>
