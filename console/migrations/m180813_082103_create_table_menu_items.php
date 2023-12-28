<?php

use yii\db\Migration;

/**
 * Class m180813_082103_create_table_menu_items
 */
class m180813_082103_create_table_menu_items extends Migration
{
    private $tableName = '{{%menu_items}}';
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
            'menu_item_id' => $this->primaryKey(),
            'menu_id' => $this->integer(),
            'title' => $this->string(255),
            'url' => $this->string(),
            'sort' => $this->integer(),
            'menu_item_parent_id' => $this->integer(),
            'lang_hash' => $this->string(255),
            'lang' => $this->integer(),
            'icon' => $this->string(255)
        ], $tableOptions);

        // creates index for column `lang`
        $this->createIndex(
            'idx-menu_items-lang',
            $this->tableName,
            'lang'
        );

        // add foreign key for table `langs`
        $this->addForeignKey(
            'fk-menu_items-lang',
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
        $this->dropForeignKey('fk-menu_items-lang',$this->tableName);
        $this->dropTable($this->tableName);
    }
}
