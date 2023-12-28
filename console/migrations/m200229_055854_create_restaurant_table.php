<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%restaurant}}`.
 */
class m200229_055854_create_restaurant_table extends Migration
{

    public $table = '{{%restaurant}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->text(),
            'address' => $this->string(),
            'phone' => $this->string(),
            'delivery' => $this->integer(),
            'work_time_start' => $this->string(),
            'work_time_end' => $this->string(),
            'region_id' => $this->integer(),
            'lat' => $this->double(),
            'lng' => $this->double(),
            'top' => $this->integer(),
            'slug' => $this->string(),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(255)->notNull()
        ]);

        // creates index for column `lang`
        $this->createIndex(
            "idx-restaurant-lang",
            $this->table,
            'lang'
        );

        // add foreign key for table `language`
        $this->addForeignKey(
            "fk-restaurant-lang",
            $this->table,
            'lang',
            'langs',
            'lang_id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-restaurant-region_id',
            $this->table,
            'region_id'
        );

        $this->addForeignKey(
            'fk-restaurant-region_id-region-id',
            $this->table,
            'region_id',
            '{{%region}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `language`
        $this->dropForeignKey(
            "fk-restaurant-lang",
            $this->table
        );

        // drops index for column `lang`
        $this->dropIndex(
            "idx-restaurant-lang",
            $this->table
        );

        // drops foreign key for table `language`
        $this->dropForeignKey(
            "fk-restaurant-region_id-region-id",
            $this->table
        );

        // drops index for column `lang`
        $this->dropIndex(
            "idx-restaurant-region_id",
            $this->table
        );

        $this->dropTable($this->table);
    }
}
