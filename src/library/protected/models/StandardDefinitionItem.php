<?php
/**
 * @name StandardDefinitionItem
 * Description of StandardDefinitionItem
 *
 * @author Allan Mojica
 * @author Jaymard Colmenar
 */

class StandardDefinitionItem extends CActiveRecord {
    /**
     * The followings columns must be present in tables of:
     * @var int(11) $id
     * @var int(11) $standard_definition_section_id
     * @var string(320) $name
     * @var blob $description
     * @var int(11) $weight
     * @var enum $attribute_type
     * @var int(11) $object_type_id
     * @var bool $is_required
     * @var bool $is_multiple
     */

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{standard_definition_items}}';
    }

    public function rules() {
        $rules =  array(
            array('standard_definition_section_id, name, description, '
                . 'weight, attribute_type, object_type_id, is_required, '
                . 'is_multiple' ,'safe')
        );
        return $rules;
    }

    public function relations() {
        $relations = array(
            'section' => array(self::BELONGS_TO, 'StandardDefinitionSection',
                'standard_definition_section_id'),
            'objectType' => array(self::BELONGS_TO, 'ObjectType',
                'object_type_id')
        );
        return $relations;
    }

    public function attributeLabels() {
        $attributeLabels = array(
            'id' => 'ID',
            'standard_definition_section_id' => 'Standard Definition Section',
            'name' => 'Name',
            'description' => 'Description',
            'weight' => 'Weight',
        );
        return $attributeLabels;
    }

    public function defaultScope() {
            return array(
                'order' => 'weight ASC',
            );
    }

    public static function getAttributesListData() {
        return array(
            'object_data_id' => 'object_data_id',
            'blob' => 'blob',
            'date_time' => 'date_time',
            'decimal' => 'decimal',
            'integer' => 'integer',
            'string' => 'string'
        );
    }
}
?>
