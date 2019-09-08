<?php

use yii\db\Migration;

/**
 * Class m190907_214142_Users
 */
class m190907_214142_Users extends Migration
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
//        echo "m190907_214142_Users cannot be reverted.\n";
//
//        return false;
//    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('user',[
            'id' => $this->primaryKey(),
            'username' => $this->char(32)->notNull(),

        ]);
    }

    public function down()
    {
        echo "m190907_214142_Users cannot be reverted.\n";
        $this->dropTable('user');
        return false;
    }

}
