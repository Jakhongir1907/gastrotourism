<?php

use yii\db\Migration;

/**
 * Class m191008_215442_alter_table_post_add_column_anons
 */
class m191008_215442_alter_table_post_add_column_anons extends Migration
{

    const TABLE = '{{%post}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TABLE, 'anons', $this->text());
        $this->addColumn(self::TABLE, 'short_link', $this->string(8));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(self::TABLE, 'anons');
        $this->dropColumn(self::TABLE, 'short_link');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191008_215442_alter_table_post_add_column_anons cannot be reverted.\n";

        return false;
    }
    */
}
