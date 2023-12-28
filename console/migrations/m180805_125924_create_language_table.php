<?php

use yii\db\Migration;

/**
 * Handles the creation of table `language`.
 */
class m180805_125924_create_language_table extends Migration
{

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%langs}}', [
            '[[lang_id]]' => $this->primaryKey(),
            '[[name]]' => $this->string(45),
            '[[code]]' => $this->string(3)->unique()->notNull(),
            '[[flag]]' => $this->text(),
            '[[status]]' => $this->boolean(),
        ]);

        $this->insert('{{%langs}}', [
            'lang_id'   => 1,
            'name'      => "Russian",
            "code"      => "ru",
            "status"    => true,
        ]);

        $this->insert('{{%langs}}', [
            'lang_id'   => 2,
            'name'      => "Uzbek",
            "code"      => "uz",
            "status"    => true,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%langs}}');
    }
}
