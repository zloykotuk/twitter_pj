<?php

use yii\db\Migration;

/**
 * Class m190908_200723_create_table_uuid
 */
class m190909_200723_create_table_uuid extends Migration
{
    /**
     * {@inheritdoc}
     */
//    public function safeUp()
//    {
//
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function safeDown()
//    {
//        echo "m190908_200723_create_table_uuid cannot be reverted.\n";
//
//        return false;
//    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('uuid',[
            'key' => $this->char(32)->notNull(),
        ]);
    }

    public function down()
    {
        echo "m190908_200723_create_table_uuid cannot be reverted.\n";
        $this->dropTable('uuid');
        return false;
    }

}
