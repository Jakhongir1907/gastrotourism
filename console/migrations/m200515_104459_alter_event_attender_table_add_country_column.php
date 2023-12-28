<?php

use yii\db\Migration;

/**
 * Class m200515_104459_alter_event_attender_table_add_country_column
 */
class m200515_104459_alter_event_attender_table_add_country_column extends Migration
{

    private $table = '{{%event_attender}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'country', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->table, 'country');
    }
}
