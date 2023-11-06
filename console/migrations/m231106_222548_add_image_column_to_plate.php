<?php

use yii\db\Migration;

/**
 * Class m231106_222548_ImageUrl
 */
class m231106_222548_add_image_column_to_plate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('plate', 'image_name', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('plate', 'image_name');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231106_222548_ImageUrl cannot be reverted.\n";

        return false;
    }
    */
}
