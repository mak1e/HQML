<?php

/**
 * @name StandardDefinition
 * Description of CONTROLLER_NAME
 *
 * @author Allan Mojica
 */
class StandardDefinitionController extends Controller {
    //private $_StandardDefinition;
    /**
     * Declares class-based actions.
     */
    private $_standard_definition_section;
    private $_standard_definition_item;

    public function actions() {
        return array();
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('StandardDefinitionSection');
        $this->render('/standard_definition/index', array('model'=>$dataProvider));
    }

    public function  actionView(){
        $this->_standard_definition_item = StandardDefinitionSection::model()->findByPk($_GET['id']);
        $this->render('/standard_definition/view', array('model'=>$this->_standard_definition_item));
    }

    public function actionAddSection() {
        $this->_standard_definition_section = new StandardDefinitionSection();
        if (isset($_POST['StandardDefinitionSection'])){
            $this->_standard_definition_section->attributes = $_POST['StandardDefinitionSection'];
            $this->_standard_definition_section->save();
            $this->redirect(array('/StandardDefinition/index'));
        }
        $this->render('/standard_definition/add_section', array('model'=>$this->_standard_definition_section));
    }

   public function actionAddItem() {
        $this->_standard_definition_section = new StandardDefinitionSection();
        if (isset($_POST['StandardDefinitionSection'])){
            $this->_standard_definition_section->attributes = $_POST['StandardDefinitionSection'];
            $this->_standard_definition_section->save();
            $this->redirect(array('/StandardDefinition/index'));
        }
        $this->render('/standard_definition/add_section', array('model'=>$this->_standard_definition_section));
    }

    public function actionUpdate(){
        $this->_standard_definition_section = StandardDefinitionSection::model()->findByPk($_GET['id']);
        if (isset($_POST['StandardDefinitionSection'])){
            $this->_standard_definition_section->attributes = $_POST['StandardDefinitionSection'];
            $this->_standard_definition_section->save();
            $this->redirect(array('/StandardDefinition/index'));
        }
        $this->render('/standard_definition/update_section', array('model'=>$this->_standard_definition_section));
    }

     public function  ActionUpdateItem(){
         $this->_standard_definition_item =  StandardDefinitionItem::model()->findByPk($_GET['id']);
        if (isset($_POST['StandardDefinitionItem'])) {
            //echo 'save - - - - ';
           $this->_standard_definition_item->attributes = $_POST['StandardDefinitionItem'];
           $this->_standard_definition_item->save();
           $this->redirect(array('/StandardDefinition/view','id'=>$_GET['id']));
        }
        $this->render('/standard_definition_item/add', array('model' => $this->_standard_definition_item));
         //echo 'sample'.$_GET['id'];
    }
}

?>