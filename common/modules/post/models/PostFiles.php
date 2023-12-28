<?php

namespace common\modules\post\models;

use common\modules\filemanager\models\File;
use common\modules\post\models\Post;
use Yii;

/**
 * This is the model class for table "post_files".
 *
 * @property int $id
 * @property int $post_id
 * @property string $file_code
 *
 * @property File $fileCode
 * @property Post $post
 */
class PostFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'file_code'], 'required'],
            [['post_id'], 'default', 'value' => null],
            [['post_id'], 'integer'],
            [['file_code'], 'string', 'max' => 255],
            [['file_code'], 'unique'],
            [['file_code'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['file_code' => 'code']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'file_code' => 'File Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileCode()
    {
        return $this->hasOne(File::className(), ['code' => 'file_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\post\query\PostFilesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\post\query\PostFilesQuery(get_called_class());
    }
}
