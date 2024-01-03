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
                'value' => function ($model)
                {
                    $imageUrl = Yii::$app->params['imagePath'] . $model->image_name;

                    if ($model->image_name == null)
                    {
                        $imageUrl = Yii::getAlias('@web/img/nopic.jpg');
                    }

                    return Html::img($imageUrl, ['height' => '250px', 'width' => '250px', 'class' => 'img-thumbnail', 'alt' => 'Image']);
                },
            ],
        ],
    ]) ?>

</div>