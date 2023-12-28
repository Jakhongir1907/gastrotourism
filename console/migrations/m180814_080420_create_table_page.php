<?php

use yii\db\Migration;

/**
 * Class m180814_080420_create_table_page
 */
class m180814_080420_create_table_page extends Migration
{
    private $tableName = '{{%pages}}';
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
            'page_id' => $this->primaryKey(),
            'title' => $this->string(255),
            'subtitle' => $this->string(),
            'description' => $this->text(),
            'content' => $this->text(),
            'slug' => $this->string(255),
            'template' => $this->string(255),
            'date_create' => $this->integer(),
            'date_update' => $this->integer(),
            'date_publish' => $this->integer(),
            'sort' => $this->integer(11),
            'lang_hash' => $this->string(255),
            'lang' => $this->integer(),
            'status' => $this->integer(),
        ], $tableOptions);

        $this->createIndex(
            'idx-pages-page_id',
            $this->tableName,
            'page_id'
        );

        $this->createIndex(
            'idx-pages-lang',
            $this->tableName,
            'lang'
        );

        $this->addForeignKey(
            'fk-pages-langs-lang',
            $this->tableName,
            '[[lang]]',
            '{{%langs}}',
            '[[lang_id]]',
            'CASCADE'
        );



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-pages-page_id',$this->tableName);
        $this->dropIndex('idx-pages-lang',$this->tableName);
        $this->dropForeignKey('fk-pages-langs-lang',$this->tableName);
        $this->dropTable($this->tableName);
    }
}
