<?php

use yii\db\Migration;

/**
 * Class m180814_110513_create_table_settingsvalues
 */
class m180814_110513_create_table_settingsvalues extends Migration
{
    private $tableName='{{%settingsvalues}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'setting_id' => $this->integer(11),
            'value_id' => $this->integer(11),
            'sort' => $this->integer(11)
        ], $tableOptions);


        $this->createIndex(
            'idx-settingsvalues-setting_id',
            $this->tableName,
            'setting_id'
        );

        $this->createIndex(
            'idx-settingsvalues-value_id',
            $this->tableName,
            'value_id'
        );

        $this->addForeignKey(
            'fk-settingsvalues-setting_id',
            $this->tableName,
            'setting_id',
            '{{%settings}}',
            'setting_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-settingsvalues-value_id',
            $this->tableName,
            'value_id',
            '{{%values}}',
            'value_id',
            'CASCADE'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-settingsvalues-setting_id',$this->tableName);
        $this->dropIndex('idx-settingsvalues-value_id',$this->tableName);
        $this->dropForeignKey('fk-settingsvalues-setting_id',$this->tableName);
        $this->dropForeignKey('fk-settingsvalues-value_id',$this->tableName);

        $this->dropTable($this->tableName);
    }
}
