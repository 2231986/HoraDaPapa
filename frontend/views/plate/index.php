<?php

use common\helpers\FormatterHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\PlateSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pratos';
?>
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
            <h1 class="mb-5">Todos os nossos pratos</h1>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'row g-4'], // Apply the 'row' class to the GridView container
            'layout' => "{items}", // Keep only the items without any surrounding container
            'tableOptions' => ['class' => 'table table-striped'], // Apply Bootstrap table class
            'columns' => [
                [
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
                [
                    //'header' => 'Title',
                    //'attribute' => 'title',
                    'format' => 'raw',
                    'value' => function ($model)
                    {
                        return '<h5 class="d-flex justify-content-between border-bottom pb-2">' .
                            Html::encode($model->title) .
                            '<span class="text-primary">' . FormatterHelper::formatCurrency($model->price) . '</span></h5>' .
                            '<small class="fst-italic">' . Html::encode($model->description) . '</small>';
                    },
                ],
            ],
        ]); ?>
    </div>
</div>