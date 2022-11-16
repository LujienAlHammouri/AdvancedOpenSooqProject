<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "favourite".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $post_id

 * @property-read  Post $post
 * @property User $user
 */
class Favourite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favourite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'post_id'], 'integer'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::class, 'targetAttribute' => ['post_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'post_id' => Yii::t('app', 'Post ID'),
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getCategory()
    {
        $post= Post::find()->andWhere(['id' => $this->post_id])->one();
        if (empty($post->category_id)) {
            return 'not';
        }
        $category = $post->category_id;
        return Category::find()->andWhere(['id' => $category])->one();
    }

    public function getSubCategory()
    {
        $post= Post::find()->andWhere(['id' => $this->post_id])->one();
        if (empty($post->sub_category_id)) {
            return 'not';
        }
        $subcategory=$post->sub_category_id;
        return Category::find()->andWhere(['id' => $subcategory])->one();
    }



}