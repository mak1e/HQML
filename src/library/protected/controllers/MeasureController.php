<?php
/**
 * @name MeasureController
 * Description of MeasureController
 *
 * @author Jaymard Colmenar
 */

class MeasureController extends Controller {
    
    private $_measure;
    private $_revision;
    private $_item;
    private $_standardItem;

    public function actions() {
        return array();
    }

    public function filters()
    {
        return array(
          'accessControl', // perform access control for CRUD operations
                );
        }


    public function accessRules()
        {
                return array(
                        array('allow',
                                'actions'=>array('index', 'view'),
                                'users'=>array('*'),
                        ),
                        array('allow',
                                'actions'=>array('create', 'edit', 'editItem', 'deleteItem', 'update', 'viewItem', 'addItem', 'finaliseRevision', 'createRevision', 'ajax'),
                                'users'=>Yii::app()->getModule('user')->getAdmins(),
                        ),
                        array('deny',  // deny all users
                                'users'=>array('*'),
                        ),
                );
        }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Measure');
        $this->render('/measure/index', array('dataProvider'=>$dataProvider));
    }

    public function actionView() {
        if(isset($_GET['id'])){
            Statistics::createStatistics($_GET['id']);
            $this->_measure = Measure::model()->findByPk($_GET['id']);
            if(isset($_GET['revision'])){
                $revision = MeasureRevision::model()->findByPk($_GET['revision']);
                if ($revision->measure_id == $this->_measure->id){
                    $this->_revision = $revision;
                }
            } else {
                $this->_revision = $this->_measure->latestRevision;
            }
            if (Yii::app()->user->getId() != NULL) {
                            $this->render('/measure/edit', array('data' => $this->_measure,
                'revision' => $this->_revision));
            } else {
                            $this->render('/measure/view', array('data' => $this->_measure,
                'revision' => $this->_revision));
            }

        }
    }

    public function actionCreate() {
        $this->_measure = new Measure();
        if (isset($_POST['Measure'])) {
           $this->_measure->attributes = $_POST['Measure'];
           if($this->_measure->save()){
               $this->redirect(array('measure/view',
                   'id' => $this->_measure->id));
           }
        }
        $this->render('/measure/create', array('model' => $this->_measure));
    }

    public function actionEdit() {
        if(isset($_GET['id'])) {
            $this->_measure = Measure::model()->findByPk($_GET['id']);
            if (isset($_POST['Measure'])) {
                $this->_measure->attributes = $_POST['Measure'];
                if($this->_measure->save()){
                    $this->redirect(array('measure/view',
                        'id' => $this->_measure->id));
                }
            }
            $this->render('/measure/create', array('model' => $this->_measure));
        }
    }

    public function actionEditItem() {
        if(isset($_GET['id']) && isset($_GET['item_id'])) {
            $this->_item = MeasureItem::model()->findByPk($_GET['item_id']);
            if (!$this->_item->revision->is_locked) {
                if (isset($_POST['MeasureItem'])) {
                    $this->_item->attributes = $_POST['MeasureItem'];
                    if ($this->_item->save()) {
                        $this->redirect(array('measure/view',
                            'id' => $this->_item->revision->measure_id));
                    }
                }
                $this->render('/measure/revision/_addItem', array('model' => $this->_item));
            } else {
                echo 'This revision is already locked!';
            }
        }
    }

    public function actionDeleteItem() {
        if(isset($_GET['id'])) {
            $this->_item = MeasureItem::model()->findByPk($_GET['id']);
            if (!$this->_item->revision->is_locked) {
                if ($this->_item->delete()) {
                    $this->redirect(array('measure/view',
                        'id' => $this->_item->revision->measure_id));
                }
            }
        } else {
            echo 'This revision is already locked!';
        }
    }
    
    public function actionUpdate() {
        
    }
    
    public function actionAddItem() {
        $this->addEditItem();
    }

    public function actionViewItem() {
        if (isset($_GET['id']) && isset($_GET['item_id'])) {
            if (!$this->loadMeasure($_GET['id'])) {
                echo 'This Measure does not exist';
                Yii::app()->end();
            }
            if (!$this->loadStandardItem($_GET['item_id'])) {
                echo 'This Standard Definition does not exist';
                Yii::app()->end();
            }
            if ($this->_standardItem->is_multiple) {
                $itemData = MeasureItem::model()->findAll(
                                'standard_definition_item_id = :definitionId'
                                . ' AND revision_id = :revisionId', array(
                            ':definitionId' => $this->_standardItem->id,
                            ':revisionId' => $this->_measure->latestRevision->id));
                $this->renderPartial('/measure/_item/viewMultiple',
                        array('data' => $itemData));
            } else {
                $itemData = MeasureItem::model()->find(
                                'standard_definition_item_id = :definitionId'
                                . ' AND revision_id = :revisionId', array(
                            ':definitionId' => $this->_standardItem->id,
                            ':revisionId' => $this->_measure->latestRevision->id));
                $this->renderPartial('/measure/_item/view',
                        array('data' => $itemData));
            }
        }
    }

    private function addEditItem() {
        if (isset($_GET['id']) && isset($_GET['item_id'])) {
            if(!$this->loadMeasure($_GET['id'])) {
                echo 'This Measure does not exist';
                Yii::app()->end();
            }
            if (!$this->loadStandardItem($_GET['item_id'])) {
                echo 'This Standard Definition does not exist';
                Yii::app()->end();
            }
            $this->_item = NULL;
            $this->_item = MeasureItem::model()->find(
                    'revision_id = :revId AND '
                    . 'standard_definition_item_id = :stdId',
                    array(':revId' => $this->_measure->latestRevision->id,
                        ':stdId' => $this->_standardItem->id));
            if ($this->_item == NULL) {
                $this->_item = new MeasureItem();
                $this->_item->standard_definition_item_id = $this->_standardItem->id;
                $this->_item->revision_id = $this->_measure->latestRevision->id;
            }
            if (!$this->_measure->latestRevision->is_locked) {
                if ($this->_standardItem->is_multiple) {
                    if(isset($_POST['MeasureItem']['object_data_id'])) {
                        $given = $_POST['MeasureItem']['object_data_id'];
                        $existing = MeasureItem::getExistingObjectIds(
                                        $this->_standardItem->id,
                                        $this->_measure->latestRevision->id);
                        $toBeDeleted = array_diff($existing, $given);
                        $toBeAdded = array_diff($given, $existing);
                        foreach($toBeDeleted as $toDelete) {
                            $itemToDelete = MeasureItem::model()->find(
                                    'revision_id = :revisionId AND ' .
                                    'object_data_id = :objectId', array(
                                        ':revisionId' =>
                                        $this->_measure->latestRevision->id,
                                        ':objectId' => $toDelete
                                    ));
                            $itemToDelete->delete();
                        }
                        foreach($toBeAdded as $toAdd) {
                            $measureItem = new MeasureItem();
                            $measureItem->standard_definition_item_id =
                                    $this->_standardItem->id;
                            $measureItem->revision_id =
                                    $this->_measure->latestRevision->id;
                            $measureItem->object_data_id = $toAdd;
                            $measureItem->save();
                        }
//                        $this->redirect(array('measure/viewItem',
//                            'id' => $this->_measure->id,
//                            'item_id' => $this->_standardItem->id));
                        $this->actionViewItem();
                        Yii::app()->end();
                    }
                    $this->renderPartial('/measure/_item/formMultipleObject',
                            array('model' => $this->_item,
                                'selected' => MeasureItem::getExistingObjectIds(
                                        $this->_standardItem->id,
                                        $this->_measure->latestRevision->id)
                    ));
                } else {
                    if(isset($_POST['MeasureItem'])) {
                        $this->_item->attributes = $_POST['MeasureItem'];
                        if ($this->_item->save()) {
//                            $this->redirect(array('measure/viewItem',
//                            'id' => $this->_measure->id,
//                            'item_id' => $this->_standardItem->id));
                            $this->actionViewItem();
                            Yii::app()->end();
                        }
                    }
                    $this->renderPartial('/measure/_item/form', array(
                        'model' => $this->_item
                    ));
                }
            }
        }
    }

    public function actionFinaliseRevision() {
        if(isset($_GET['id'])) {
            $this->_measure = Measure::model()->findByPk($_GET['id']);
            if(!$this->_measure->latestRevision->is_locked) {
                if($this->_measure->latestRevision->saveAttributes(array('is_locked' => true))){
                    $this->redirect(array('measure/view', 'id'=>$this->_measure->id));
                }
            }
        }
    }

    public function actionCreateRevision() {
        if(isset($_GET['id'])) {
            $this->_measure = Measure::model()->findByPk($_GET['id']);
            if($this->_measure->latestRevision->is_locked) {
                $revision = new MeasureRevision();
                $revision->measure_id = $this->_measure->id;
                if ($revision->save()) {
                    $this->_measure->revisions[1]->duplicateTo($revision->id);
                    $this->redirect(array('measure/view', 'id' => $this->_measure->id));
                }
            }
        }
    }

    public function actionAjax() {
        if(isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'editItem':
                    $item = MeasureItem::model()->findByPk($_POST['id']);
                    $this->renderPartial('/measure/revision/_editItem',
                            array('model'=>$item));
                    break;
                case 'saveItem':
                    $item = MeasureItem::model()->findByPk($_POST['MeasureItem']['id']);
                    $item->attributes = $_POST['MeasureItem'];
                    if($item->save()){
                        $this->renderPartial('/measure/revision/_item', array('data'=>$item));
                    }
                    break;
            }
        }
    }

    private function loadMeasure($id) {
        $measure = Measure::model()->findByPk($id);
        if (isset($measure)) {
            $this->_measure = $measure;
            return true;
        }
        return false;
    }

    private function loadStandardItem($id) {
        $stdDefItem = StandardDefinitionItem::model()->findByPk($id);
        if (isset($stdDefItem)) {
            $this->_standardItem = $stdDefItem;
            return true;
        }
        return false;
    }

}

?>