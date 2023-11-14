<?php

namespace app\models;

use Yii;
use common\models\Plate;

/**
 * This is the model class for table "supplier".
 *
 * @property int $id id do fornecedor
 * @property int $plate_id id do prato
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
            [['plate_id', 'name', 'nif'], 'required'],
            [['plate_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['nif'], 'string', 'min' => 9, 'max' => 9],
            [['plate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plate::class, 'targetAttribute' => ['plate_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Identificador',
            'plate_id' => 'Prato',
            'name' => 'Fornecedor',
            'nif' => 'NIF',
        ];
    }

    /**
     * Gets query for [[Plate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlate()
    {
        return $this->hasOne(Plate::class, ['id' => 'plate_id']);
    }
}
