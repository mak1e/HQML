<?php
/**
 * @name relMeasuresDomainOfQualities
 * Description of relMeasuresDomainOfQualities
 *
 * @author Jaymard Colmenar
 */

class relMeasuresDomainOfQualities extends CActiveRecord {
    /**
     * The followings columns must be present in tables of:
     * @var int(11) $id
     * @var int(11) $measure_id
     * @var int(11) $domain_of_quality_id
     */

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{rel_measures_domain_of_qualities}}';
    }

    public function rules() {
        $rules =  array(); //add rules here
        return $rules;
    }

    public function relations() {
        $relations = array(
            'measure' => array(self::BELONGS_TO, 'Measure', 'measure_id'),
            'domainOfQuality' => array(self::BELONGS_TO, 'DomainOfQuality', 
                'domain_of_quality_id'),
        );
        return $relations;
    }

    public function attributeLabels() {
        $attributeLabels = array(
            'id' => 'Measures Domain Of Qualities ID',
            'measure_id' => 'Measure',
            'domain_of_quality_id' => 'Domain Of Quality'
        );
        return $attributeLabels;
    }
}
?>
