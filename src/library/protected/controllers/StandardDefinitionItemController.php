<?php

/**
 * @name Measure
 * Description of CONTROLLER_NAME
 *
 * @author Allan Mojica
 */
class StandardDefinitionItemController extends Controller {
    private $_StandardDefinition;
    /**
     * Declares class-based actions.
     */
    
    public function actions() {
        return array();
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $data = new CActiveDataProvider('StandardDefinitionItem');
        $this->render('/standard_definition_item/index', array('model'=>$data));
    }

    public function  actionView(){
         $this->_StandardDefinition = StandardDefinitionItem::model()->findByPk($_GET['id']);
        $this->render('/standard_definition_item/view', array('model' => $this->_StandardDefinition));        
    }

    public function  actionAdd(){
       $this->_StandardDefinition = new StandardDefinitionItem();
        if (isset($_POST['StandardDefinitionItem'])) {
           $this->_StandardDefinition->attributes = $_POST['StandardDefinitionItem'];
           $this->_StandardDefinition->save();
           $this->redirect(array('/StandardDefinitionItem/index'));
        }
        $this->render('/standard_definition_item/add', array('model' => $this->_StandardDefinition));
    }

    public function  actionUpdate(){
       $this->_StandardDefinition =  StandardDefinitionItem::model()->findByPk($_GET['id']);
        if (isset($_POST['StandardDefinitionItem'])) {
            //echo 'save - - - - ';
           $this->_StandardDefinition->attributes = $_POST['StandardDefinitionItem'];
           $this->_StandardDefinition->save();
           $this->redirect(array('/StandardDefinitionItem/index'));
        }
        $this->render('/standard_definition_item/add', array('model' => $this->_StandardDefinition));
    }



 }
?>