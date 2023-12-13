<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\FormatterHelper;

/** @var yii\web\View $this */
/** @var common\models\Plate $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Plates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="plate-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'description',
            [
                'attribute' => 'price',
                'label' => 'Preço',
                'value' => function ($model)
                {
                    return FormatterHelper::formatCurrency($model->price);
                },
            ],
            'title',
            'date_time',
            [
                'attribute' => 'image_name',
                'format' => 'html', // Set the format to HTML to allow rendering HTML tags
                'visible' => !empty($model->image_name), // Only show if image_name is not empty
                'value' => function ($model)
                {
                    $imageUrl = Yii::getAlias('@web/uploads/') . $model->image_name;
                    return Html::img($imageUrl, ['height' => '250px', 'width' => '250px', 'class' => 'img-thumbnail', 'alt' => 'Image']);
                },
            ],
            'supplier.name',
            'supplier.nif',
        ],
    ]) ?>

</div>