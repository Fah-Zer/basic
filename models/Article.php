<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property int|null $status
 * @property string $description
 * @property string $created_at
 *
 * @property Category $category
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * {@inheritdoc}
     */

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $category_title;

    public function rules()
    {
        return [
            [['category_id', 'title', 'description'], 'required'],
            [['category_id', 'status'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            [['description'], 'string'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'category_title' => 'Category Title',
            'title' => 'Title',
            'status' => 'Status',
            'description' => 'Description',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\CategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\ArticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ArticleQuery(get_called_class());
    }
}
