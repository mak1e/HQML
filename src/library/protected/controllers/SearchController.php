<?php

/**
 * @name SeachController
 * Description of SearchController
 *
 * @author Antonio San Miguel
 * @author Jaymard Colmenar
 */
class SearchController extends Controller {

    public $lst = array();

    public function actions() {
        return array();
    }

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'advanced', 'autocomplete'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        //TODO: VERY SLOW AND CRUDE! REFINE AND OPTIMISE!
        $criteria = new CDbCriteria();

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $criteria->compare('title', $search, true, 'AND');
        }
        if (isset($_POST['Owner'])) {
            foreach($_POST['Owner'] as $ownerId) {
                $criteria->compare('owner_organisation_id',
                        $ownerId, false, 'OR');
            }
        }

        if (isset($_POST['StageOfDevelopment'])) {
            $tempCriteria = new CDbCriteria();
            $tempCriteria->addInCondition('object_data_id', $_POST['StageOfDevelopment']);
            $measureItems = MeasureItem::model()->findAll($tempCriteria);
            $revisions = array();
            foreach($measureItems as $measureItem) {
                array_push($revisions, $measureItem->revision_id);
            }
            $revisions = array_unique($revisions);
            $tempCriteria = new CDbCriteria();
            $tempCriteria->addInCondition('id', $revisions);
            $revisionItems = MeasureRevision::model()->findAll($tempCriteria);
            $measures = array();
            foreach ($revisionItems as $revisionItem) {
                array_push($measures, $revisionItem->measure_id);
            }
            $measures = array_unique($measures);
            $criteria->addInCondition('id', $measures, 'AND');
        }
        if (isset($_POST['SubjectArea'])) {
            $tempCriteria = new CDbCriteria();
            $tempCriteria->addInCondition('object_data_id', $_POST['SubjectArea']);
            $measureItems = MeasureItem::model()->findAll($tempCriteria);
            $revisions = array();
            foreach($measureItems as $measureItem) {
                array_push($revisions, $measureItem->revision_id);
            }
            $revisions = array_unique($revisions);
            $tempCriteria = new CDbCriteria();
            $tempCriteria->addInCondition('id', $revisions);
            $revisionItems = MeasureRevision::model()->findAll($tempCriteria);
            $measures = array();
            foreach ($revisionItems as $revisionItem) {
                array_push($measures, $revisionItem->measure_id);
            }
            $measures = array_unique($measures);
            $criteria->addInCondition('id', $measures, 'AND');
        }
        if (isset($_POST['DomainOfQuality'])) {
            $tempCriteria = new CDbCriteria();
            $tempCriteria->addInCondition('object_data_id', $_POST['DomainOfQuality']);
            $measureItems = MeasureItem::model()->findAll($tempCriteria);
            $revisions = array();
            foreach($measureItems as $measureItem) {
                array_push($revisions, $measureItem->revision_id);
            }
            $revisions = array_unique($revisions);
            $tempCriteria = new CDbCriteria();
            $tempCriteria->addInCondition('id', $revisions);
            $revisionItems = MeasureRevision::model()->findAll($tempCriteria);
            $measures = array();
            foreach ($revisionItems as $revisionItem) {
                array_push($measures, $revisionItem->measure_id);
            }
            $measures = array_unique($measures);
            $criteria->addInCondition('id', $measures, 'AND');
        }

        if (isset($_POST['TypeOfMeasure'])) {
            $tempCriteria = new CDbCriteria();
            $tempCriteria->addInCondition('object_data_id', $_POST['TypeOfMeasure']);
            $measureItems = MeasureItem::model()->findAll($tempCriteria);
            $revisions = array();
            foreach($measureItems as $measureItem) {
                array_push($revisions, $measureItem->revision_id);
            }
            $revisions = array_unique($revisions);
            $tempCriteria = new CDbCriteria();
            $tempCriteria->addInCondition('id', $revisions);
            $revisionItems = MeasureRevision::model()->findAll($tempCriteria);
            $measures = array();
            foreach ($revisionItems as $revisionItem) {
                array_push($measures, $revisionItem->measure_id);
            }
            $measures = array_unique($measures);
            $criteria->addInCondition('id', $measures, 'AND');
        }
        $dataProvider = new CActiveDataProvider("Measure", 
                array('criteria' => $criteria,
                    'pagination'=>array(
                        'pageSize'=>6,
                    )));
        $this->renderPartial('/search/_results', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAutocomplete() {
        $result = array();
        $criteria = new CDbCriteria();
        //$_GET['search'] = 't';
        if (isset($_GET['term'])) {
            $qtxt = "SELECT title FROM {{measures}} WHERE title LIKE :title";
            $command = Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":title", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            $result = $command->queryColumn();
        }

        print_r(CJSON::encode($result));
        Yii::app()->end();
    }

    public function actionAdvanced() {
        $criteria = new CDbCriteria();
        $ownerCriteria = new CDbCriteria();
        $creatorCriteria = new CDbCriteria();

        //$subjectAreaCriteria = new CDbCriteria();

        /* if(isset($_GET['categories'])) {
          $ownerCriteria =
          } */

        $ownerCriteria->select = 'name';
        $owner = Organisation::model()->find($ownerCriteria);

        $creatorCriteria->select = 'name';
        //$creator = DomainOfQuality::model()->find($domainCriteria);

        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $criteria->compare('title', $search, true, 'OR');
            if (isset($_GET['Organisation'])) {
                $a = "'" . implode(',', $_GET['Organisation'][id]) . "'";
                $criteria->addCondition('owner_organisation_id LIKE ' . $a);
                //$criteria->addCondition('owner_organisation_id LIKE '.$a);
            }
        }
        $dataProvider = new CActiveDataProvider("Measure", array('criteria' => $criteria));
        $this->render('/search/advanced', array(
            'dataProvider' => $dataProvider,
            'owner' => $owner,
            'domain' => $domain,
        ));
    }

}

?>