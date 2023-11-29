<?php

namespace app\models;

use Yii;
use common\models\Plate;

/**
 * This is the model class for table "supplier".
 *
 * @property int $id id do fornecedor
 * @property string $name nome do fornecedor
 * @property string $nif número fiscal da empresa
 *
 * @property Plate $plate
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'nif'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['nif'], 'string', 'min' => 9, 'max' => 9],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Identificador',
            'name' => 'Fornecedor',
            'nif' => 'NIF',
        ];
    }
}
