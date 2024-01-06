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
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Menu</h5>
            <h1 class="mb-5">Todas as papas!</h1>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'row m-4'], // Apply the 'row' class to the GridView container
            'layout' => "{items}", // Keep only the items without any surrounding container
            'tableOptions' => ['class' => 'table table-striped'], // Apply Bootstrap table class
            'columns' => [
                [
                    'format' => 'raw',
                    'value' => function ($model) {
                        $imageUrl = Yii::$app->params['imagePath'] . $model->image_name;

                        if ($model->image_name == null) {
                            $imageUrl = Yii::getAlias('@web/img/nopic.jpg');
                        }

                        return '
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center">
                            ' . Html::img($imageUrl, ['height' => '80px', 'width' => '80px', 'class' => 'flex-shrink-0 img-fluid rounded', 'alt' => 'Image']) . '
                            <div class="w-100 d-flex flex-column text-start ps-4">
                                <h5 class="d-flex justify-content-between border-bottom pb-2">
                                    <span>' . Html::encode($model->title) . '</span>
                                    <span class="text-primary">' . FormatterHelper::formatCurrency($model->price) . '</span>
                                </h5>
                                <small class="fst-italic">' . Html::encode($model->description) . '</small>
                            </div>
                        </div>
                    </div>';
                    },
                ],
            ],
        ]); ?>
    </div>
</div>