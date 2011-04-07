<?php
/**
 * @name Measure
 * Description of Measure
 *
 * @author Jaymard Colmenar
 */

class Measure extends CActiveRecord {
    /**
     * The followings columns must be present in tables of:
     * @var int(11) $id
     * @var string(80) $title
     * @var enum $status
     * @var string(320) $usage
     * @var timestamp $creation_date
     */

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{measures}}';
    }

    public function rules() {
        $rules =  array(
            array('title, status, usage', 'safe')
        );
        return $rules;
    }

    public function relations() {
        $relations = array(
            'revisions' => array(self::HAS_MANY, 'MeasureRevision', 'measure_id',
                'order' => 'last_updated DESC'),
            'latestRevision' => array(self::HAS_ONE, 'MeasureRevision', 
                'measure_id', 'order' => 'last_updated DESC'),
            'subdomain' => array(self::MANY_MANY, 'Subdomain', 'tbl_rel_measures_subdomains(measure_id, subdomain_id)')
            
        );
        return $relations;
    }

    public function attributeLabels() {
        $attributeLabels = array(
            'id' => 'Reference Number',
            'title' => 'Title of Measure',
            'status' => 'Status',
            'usage' => 'Potential or current usage',
            'creation_date' => 'Date of entry to library'
        );
        return $attributeLabels;
    }

    protected function afterSave() {
        if($this->getIsNewRecord()) {
            $revision = new MeasureRevision();
            $revision->measure_id = $this->id;
            if($revision->save()){
                parent::afterSave();
            }
        }
    }

    public function getStatusOptions() {
        return array(
            1 => 'Designed and Developed',
            2 => 'Tested',
            3 => 'Ready to Use'
        );
    }

    public static function getMeasureTitles() {
        $measureTitles = array();
        foreach(Measure::model()->findAll() as $measure) {
            array_push($measureTitles, $measure->title);
        }
        return $measureTitles;
    }
}
?>
