<?php
/**
 * @name SubDomain
 * Description of SubDomins
 *
 * @author Antonio San Miguel
 */

class SubDomain extends CActiveRecord {
    /**
     * The followings columns must be present in tables of:
     * @var int(11) id
     * @var varchar(80) name
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
        return '{{subdomains}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        $rules =  array(
            array('name', 'safe')
        ); //add rules here
        return $rules;
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        $relations = array(
            'measure' => array(self::MANY_MANY, 'Measure', 'tbl_rel_measures_subdomains(subdomain_id, measure_id)')
        ); //add relations here
        return $relations;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        $attributeLabels = array(
            'id' => 'SubDomain ID',
            'name' => 'Name'); //add labels here
        return $attributeLabels;
    }
}
?>
