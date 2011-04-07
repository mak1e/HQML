<?php
/**
 * @name relMeasuresSubDomains
 * Description of relMeasuresSubDomains
 *
 * @author Antonio San Miguel
 */

class relMeasuresSubDomains extends CActiveRecord {
    /**
     * The followings columns must be present in tables of:
     * @var int(11) $id
     * @var int(11) $measure_id
     * @var int(11) $subdomain_id
     */

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{rel_measures_subdomain}}';
    }

    public function rules() {
        $rules =  array(); //add rules here
        return $rules;
    }

    public function relations() {
        $relations = array(
            'measure' => array(self::BELONGS_TO, 'Measure', 'measure_id'),
            'subdomain' => array(self::BELONGS_TO, 'SubDomain',
                'subdomain_id'),
        );
        return $relations;
    }

    public function attributeLabels() {
        $attributeLabels = array(
            'id' => 'Measures SubDomains ID',
            'measure_id' => 'Measure',
            'subdomain_id' => 'SubDomain'
        );
        return $attributeLabels;
    }
}
?>
