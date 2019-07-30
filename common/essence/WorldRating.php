<?php

namespace common\essence;

use Yii;

/**
 * This is the model class for table "world_rating".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 *
 * @property Film[] $films
 */
class WorldRating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'world_rating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'image'], 'string', 'max' => 255],
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
            'image' => 'Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilms()
    {
        return $this->hasMany(Film::className(), ['world_rating_id' => 'id']);
    }

    public function saveImage($fileName)
    {
        $this->image= $fileName;
        return $this->save(false);
    }
    public function getImage()
    {
        return ($this->image) ? '/uploads/'. $this->image : '/uploads/no-image.png';
    }
    private function deleteImage()
    {
        $imageModel = new ImageUploader();
        $imageModel->deleteImage($this->image);
    }
    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }
}
