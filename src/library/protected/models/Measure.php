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
     * @var int(11) owner_organisation_id
     * @var string(320) owner_contact
     * @var int(11) creator_organisation_id
     * @var string(320) creator_contact
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
            array('title, status, usage, owner_organisation_id,' 
                . ' creator_organisation_id, owner_contact, creator_contact',
                'safe')
        );
        return $rules;
    }

    public function relations() {
        $relations = array(
            'ownerOrganisation' => array(self::BELONGS_TO, 'Organisation',
                'owner_organisation_id'),
            'creatorOrganisation' => array(self::BELONGS_TO, 'Organisation',
                'creator_organisation_id'),
            'revisions' => array(self::HAS_MANY, 'MeasureRevision', 'measure_id',
                'order' => 'last_updated DESC'),
            'latestRevision' => array(self::HAS_ONE, 'MeasureRevision', 
                'measure_id', 'order' => 'last_updated DESC'),
            
        );
        return $relations;
    }

    public function attributeLabels() {
        $attributeLabels = array(
            'id' => 'Reference Number',
            'title' => 'Title of Measure',
            'status' => 'Status',
            'usage' => 'Potential or current usage',
            'creation_date' => 'Date of entry to library',
            'owner_organisation_id' => 'Owner Organisation',
            'creator_organisation_id' => 'Creator Organisation',
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
