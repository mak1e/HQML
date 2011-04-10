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

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{standard_definition_items}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        $rules =  array(
            array('standard_definition_section_id','safe'),
            array('name','safe'),
            array('description','safe'),
            array('weight','safe'),
        ); //add rules here
        return $rules;
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        $relations = array(
            'section' => array(self::BELONGS_TO, 'StandardDefinitionSection',
                'standard_definition_section_id'),
            'objectType' => array(self::BELONGS_TO, 'ObjectType',
                'object_type_id')
        );
        return $relations;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        $attributeLabels = array(
            'id' => 'ID',
            'standard_definition_section_id' => 'Standard Definition Section ID',
            'name' => 'Name',
            'description' => 'Description',
            'weight' => 'Weight',
        ); //add labels here
        return $attributeLabels;
    }

    public function defaultScope() {
            return array(
                'order' => 'weight ASC',
            );
    }
}
?>
