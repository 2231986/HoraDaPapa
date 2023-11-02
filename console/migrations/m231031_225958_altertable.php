<?php

use yii\db\Migration;

/**
 * Class m231031_225958_altertable
 */
class m231031_225958_altertable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('user_info', 'nome', 'name');
        $this->renameColumn('user_info', 'apelido', 'surname');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231031_225958_altertable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231031_225958_altertable cannot be reverted.\n";

        return false;
    }
    */
}
