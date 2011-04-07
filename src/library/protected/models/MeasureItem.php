<?php
/**
 * @name MeasureItem
 * Description of MeasureItem
 *
 * @author Jaymard Colmenar
 */

class MeasureItem extends CActiveRecord {
    /**
     * The followings columns must be present in tables of:
     * @var int(11) $id
     * @var int(11) $standard_definition_item_id
     * @var int(11) $revision_id
     * @var string(320) $body
     */

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{measure_items}}';
    }

    public function rules() {
        $rules =  array(
            array('body, standard_definition_item_id', 'safe')
        );
        return $rules;
    }

    public function relations() {
        $relations = array(
            'revision' => array(self::BELONGS_TO, 'MeasureRevision',
                'revision_id'),
            'definitionItem' => array(self::BELONGS_TO, 
                'StandardDefinitionItem', 'standard_definition_item_id')
        );
        return $relations;
    }

    public function attributeLabels() {
        $attributeLabels = array(
            'id' => 'Measure Item ID',
            'standard_definition_item_id' => 'Standard Definition Section',
            'revision_id' => 'Revision'
        );
        return $attributeLabels;
    }

    public function copyTo($newRevisionId){
        $measureItem = new MeasureItem();
        $measureItem->standard_definition_item_id = $this->standard_definition_item_id;
        $measureItem->body = $this->body;
        $measureItem->revision_id = $newRevisionId;
        if($measureItem->save()){
            return true;
        } return false;
    }
}
?>
