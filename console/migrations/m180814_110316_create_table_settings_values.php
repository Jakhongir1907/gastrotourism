<?php

use yii\db\Migration;

/**
 * Class m180814_110316_create_table_settings_values
 */
class m180814_110316_create_table_settings_values extends Migration
{

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%values}}', [
            '[[value_id]]' => $this->primaryKey(),
            '[[type]]' => $this->integer(255),
            '[[value]]' => $this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%values}}');
    }
}
