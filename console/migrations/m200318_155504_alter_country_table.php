<?php

use yii\db\Migration;

class m200318_155504_alter_country_table extends Migration
{
    public $table = '{{%country}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn($this->table, 'name', $this->string());
        $this->alterColumn($this->table, 'flag_path', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
