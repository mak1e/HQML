<?php
/**
 * @name DomainOfQuality
 * Description of DomainOfQuality
 *
 * @author Jaymard Colmenar
 */

class DomainOfQuality extends CActiveRecord {
    /**
     * The followings columns must be present in tables of:
     * @var int(11) $id
     * @var string(80) $name
     */

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{domain_of_qualities}}';
    }

    public function rules() {
        $rules =  array(
            array('name', 'safe')
        );
        return $rules;
    }

    public function relations() {
        $relations = array(); //add relations here
        return $relations;
    }

    public function attributeLabels() {
        $attributeLabels = array(
            'id' => 'Domain Of Quality ID',
            'name' => 'name'
        );
        return $attributeLabels;
    }
}
?>
