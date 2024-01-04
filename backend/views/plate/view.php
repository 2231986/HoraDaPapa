<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\FormatterHelper;

/** @var yii\web\View $this */
/** @var common\models\Plate $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="plate-view">

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Remover', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem acerteza que pretende remover este item?',
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
            [
                'attribute' => 'supplier.name',
                'format' => 'raw',
                'value' => function ($model)
                {
                    if ($model->supplier !== null)
                    {
                        $supplierName = $model->supplier->name;
                        $supplierId = $model->supplier->id;
                        $url = \yii\helpers\Url::to(['supplier/view', 'id' => $supplierId]);

                        return Html::a($supplierName, $url);
                    }
                    else
                    {
                        return '--';
                    }
                },
            ],
            'supplier.nif',
        ],
    ]) ?>

</div>