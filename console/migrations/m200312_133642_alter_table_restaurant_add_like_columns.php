<?php

use yii\db\Migration;

/**
 * Class m200312_133642_alter_table_restaurant_add_like_columns
 */
class m200312_133642_alter_table_restaurant_add_like_columns extends Migration
{

    public $table = '{{%restaurant}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'service_likes', $this->integer());
        $this->addColumn($this->table, 'setting_likes', $this->integer());
        $this->addColumn($this->table, 'interior_likes', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->table, 'service_likes');
        $this->dropColumn($this->table, 'setting_likes');
        $this->dropColumn($this->table, 'interior_likes');
    }
}
