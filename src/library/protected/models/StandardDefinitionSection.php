<?php
/**
 * @name StandardDefinitionSection
 * Description of StandardDefinitionSection
 *
 * @author Allan Mojica
 * @author Jaymard Colmenar
 */

class StandardDefinitionSection extends CActiveRecord {
    /**
     * The followings columns must be present in tables of:
     * @var int(11) $id
     * @var string(80) $name
     * @var int(11) $weight
     */

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{standard_definition_sections}}';
    }

    public function rules() {
        $rules =  array(
            array('name', 'safe'),
            array('weight', 'safe')
        ); //add rules here
        return $rules;
    }

    public function relations() {
        $relations = array(
            'items' => array(self::HAS_MANY, 'StandardDefinitionItem',
                'standard_definition_section_id')
        ); //add relations here
        return $relations;
    }

    public function defaultScope() {
            return array(
                'order' => 'weight ASC',
            );
    }

    public function attributeLabels() {
        $attributeLabels = array(
            'id' => 'ID',
            'name' => 'Name',
            'weight' => 'Weight',
        ); //add labels here
        return $attributeLabels;
    }

    public static function getListData() {
        return CHtml::listData(StandardDefinitionSection::model()->findAll(),
                'id', 'name');
    }
}
?>
