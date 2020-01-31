<?php

namespace app\models;

use Yii;
use app\components\behaviors\ManyToManyBehavior;


/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name
 *
 * @property AuthorBook[] $authorBooks
 * @property Author[] $authors
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'authors'], 'required'],
            [['name'], 'string', 'max' => 255],
            ['authors', 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => ManyToManyBehavior::className(),
            'relationAttribute' => 'authors',
        ];
        return $behaviors;
    }

    /**
     * Gets query for [[AuthorBook]].
     *
     * @return \yii\db\ActiveQuery|AuthorBookQuery
     */
    public function getAuthorBooks()
    {
        return $this->hasMany(AuthorBook::className(), ['book_id' => 'id']);
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery|AuthorQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::className(), ['id' => 'author_id'])->viaTable('author_book', ['book_id' => 'id']);
    }

    /**
     * @param $authors
     */
    public function setAuthors($authors)
    {
        $this->populateRelation('authors', $authors);
    }

    /**
     * {@inheritdoc}
     * @return BookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BookQuery(get_called_class());
    }

    /**
     * @return array
     */
    public function fields()
    {
        return ['id', 'name', 'authors'];
    }
}
