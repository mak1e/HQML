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

    public function actions() {
        return array();
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Measure');
        $this->render('/measure/index', array('dataProvider'=>$dataProvider));
    }

    public function actionView() {
        if(isset($_GET['id'])){
            $this->_measure = Measure::model()->findByPk($_GET['id']);
            $this->_revision = $this->_measure->latestRevision;
            if(isset($_GET['revision'])){
                $revision = MeasureRevision::model()->findByPk($_GET['revision']);
                if ($revision->measure_id == $this->_measure->id){
                    $this->_revision = MeasureRevision::model()->findByPk($_GET['revision']);
                }
            }
            $this->render('/measure/view', array('data' => $this->_measure,
                'revision' => $this->_revision));
        }
    }

    public function actionCreate() {
        $this->_measure = new Measure();
        if (isset($_POST['Measure'])) {
           $this->_measure->attributes = $_POST['Measure'];
           if($this->_measure->save()){
               $this->redirect(array('measure/index'));
           }
        }
        $this->render('/measure/create', array('model' => $this->_measure));
    }

    public function actionEditItem() {
        if(isset($_GET['id'])) {
            $this->_item = MeasureItem::model()->findByPk($_GET['id']);
            if (!$this->_item->revision->is_locked) {
                if (isset($_POST['MeasureItem'])) {
                    $this->_item->attributes = $_POST['MeasureItem'];
                    if ($this->_item->save()) {
                        $this->redirect(array('measure/view',
                            'id' => $this->_item->revision->measure_id));
                    }
                }
                $this->render('/measure/revision/_editItem', array('model' => $this->_item));
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
        if (isset($_GET['id']) && isset($_GET['item_id'])) {
            $this->_measure = Measure::model()->findByPk($_GET['id']);
            if(!$this->_measure->latestRevision->is_locked) {
                $this->_item = new MeasureItem;
                $this->_item->standard_definition_item_id = $_GET['item_id'];
                if(isset($_POST['MeasureItem'])){
                    $this->_item->attributes = $_POST['MeasureItem'];
                    $this->_item->revision_id = $this->_measure->latestRevision->id;
                    if($this->_item->save()){
                        $this->redirect(array('/measure/view', 'id' => $this->_measure->id));
                    }
                }
                $this->render('/measure/revision/_addItem', array('model' => $this->_item));
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

}

?>