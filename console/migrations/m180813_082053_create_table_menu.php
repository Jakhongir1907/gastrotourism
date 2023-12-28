<?php

use yii\db\Migration;

/**
 * Class m180813_082053_create_table_menu
 */
class m180813_082053_create_table_menu extends Migration
{
    private $tableName = '{{%menu}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'menu_id' => $this->primaryKey(),
            'title' => $this->string(255),
            'type' => $this->integer(),
            'alias' => $this->string(255),
            'lang_hash' => $this->string(255),
            'lang' => $this->integer(),
        ], $tableOptions);

        // creates index for column `lang`
        $this->createIndex(
            'idx-menu-lang',
            $this->tableName,
            'lang'
        );

        // add foreign key for table `langs`
        $this->addForeignKey(
            'fk-menu-lang',
            $this->tableName,
            'lang',
            'langs',
            'lang_id',
            'CASCADE'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-menu-lang',$this->tableName);
        $this->dropTable($this->tableName);
    }

}
