<?php
/**
 * @name MeasureRevision
 * Description of MODEL_NAME
 *
 * @author Allan Mojica
 */

class MeasureRevision extends CActiveRecord {
    /**
     * The followings columns must be present in tables of:
     * @var int(11) $id
     * @var date $last_updated
     * @var int(11) $measure_id
     * @var string(160) $description
     * @var boolean $is_locked
     */

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{measure_revisions}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        $rules =  array(
            array('description', 'safe')
        ); //add rules here
        return $rules;
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        $relations = array(
            'items' => array(self::HAS_MANY, 'MeasureItem', 'revision_id')
        );
        return $relations;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        $attributeLabels = array(
            'id' => 'ID',
            'last_updated' => 'Last Updated',
            'measure_id' => 'Measure ID',
            'description' => 'Description',
            'is_locked' => 'Lock'
        ); //add labels here
        return $attributeLabels;
    }

    protected function beforeSave() {
        if(!$this->is_locked) {
            return parent::beforeSave();
        }
        return false;
    }

    public function duplicateTo($newRevisionId){
        foreach ($this->items as $item){
            $item->copyTo($newRevisionId);
        }
    }
}
?>