<?php


use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190905_173540_create_table_country
 */
class m190905_173540_create_table_country extends Migration
{
    /**
     * {@inheritdoc}
     */

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('country',[
            'code' => $this->char(3)->notNull(),
            'name' => $this->char(52)->notNull(),
            'population' => $this->integer(11)->notNull()->defaultValue(0),
        ]);

        $this->addPrimaryKey('country_pk', 'country', ['code']);

        $this->batchInsert('country', ['code', 'name', 'population'], [
            ['AU','Australia',24016400],
            ['BR','Brazil',205722000],
            ['CA','Canada',35985751],
            ['CN','China',1375210000],
            ['DE','Germany',81459000],
            ['FR','France',64513242],
            ['GB','United Kingdom',65097000],
            ['IN','India',1285400000],
            ['RU','Russia',146519759],
            ['US','United States',322976000],
        ]);
    }

    public function down()
    {
        $this->delete('country', 'code' , ['AU', 'BR', 'CA', 'CN', 'DE', 'FR', 'GB', 'IN', 'RU', 'US']);
        $this->dropTable('country');
        //echo "m190905_173540_create_table_country cannot be reverted.\n";
        return false;
    }

}
