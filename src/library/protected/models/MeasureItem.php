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
     * @var blob $blob
     * @var datetime $date_time
     * @var decimal(10,0) $decimal
     * @var int(11) $integer
     * @var int(22) $object_id
     * @var string(320) $string
     */

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{measure_items}}';
    }

    public function rules() {
        $rules =  array(
            array('blob, date_time, decimal, integer, object_data_id, string',
                'safe')
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
        $measureItem->blob = $this->blob;
        $measureItem->date_time = $this->date_time;
        $measureItem->decimal = $this->decimal;
        $measureItem->integer = $this->integer;
        $measureItem->object_data_id = $this->object_data_id;
        $measureItem->string = $this->string;
        $measureItem->revision_id = $newRevisionId;
        if($measureItem->save()){
            return true;
        } return false;
    }

    public function getItemData() {
        $data = $this->getAttribute($this->definitionItem->attribute_type);
        if ($this->definitionItem->attribute_type == 'blob') {
            $mark = new CMarkdown();
            $data = $mark->transform($data);
        } else if ($this->definitionItem->attribute_type == 'object_data_id') {
            $data = ObjectData::model()->findByPk($this->object_data_id);
        }
        return $data;
    }

    public function getItemDataField() {
        if ($this->definitionItem->objectType->is_data_type) {
            return $this->definitionItem->objectType->object_name;
        } else {
            return 'object_id';
        }
    }

    public function __toString() {
        if ($this->definitionItem->attribute_type == 'object_data_id') {
            return ObjectData::model()->findByPk($this->object_data_id)->__toString();
        } elseif ($this->definitionItem->attribute_type == 'blob') {
            $markDown = new CMarkdown();
            return $markDown->transform($this->blob);
        } else {
            return $this->getAttribute($this->definitionItem->attribute_type);
        }
    }

    public static function getExistingObjectIds($standardDefinitionId, $revisionId) {
        $existingIds = array();
        $existing = MeasureItem::model()->findAll(
                        'revision_id = :revisionId AND '
                        . 'standard_definition_item_id = :standardItem',
                        array(':revisionId' => $revisionId,
                            ':standardItem' => $standardDefinitionId));
        foreach($existing as $item) {
            array_push($existingIds, $item->object_data_id);
        }
        return $existingIds;
    }
}
?>
