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
     * @var string(30) $reference_number
     * @var string(80) $title
     * @var int(11) owner_organisation_id
     * @var string(320) owner_contact
     * @var int(11) creator_organisation_id
     * @var string(320) creator_contact
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
            array('title, owner_organisation_id, creator_organisation_id, '
                . 'owner_contact, creator_contact', 'safe'),
            array('title, reference_number', 'required'),
            array('reference_number', 'unique')
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
            'reference_number' => 'Reference Number',
            'title' => 'Title of Measure',
            'creation_date' => 'Date of entry to library',
            'owner_organisation_id' => 'Owner Organisation',
            'owner_contact' => 'Owner Contact Person',
            'creator_organisation_id' => 'Creator Organisation',
            'creator_contact' => 'Creator Contact Person',
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

    public static function getMeasureTitles() {
        $measureTitles = array();
        foreach(Measure::model()->findAll() as $measure) {
            array_push($measureTitles, $measure->title);
        }
        return $measureTitles;
    }

    public static function getLatestMeasures() {
        $measureTitles = array();
        $measures = Measure::model()->findAll(
                array('order' => 'creation_date DESC',
                    'limit' => 10));
        return $measures;
    }
}
?>
