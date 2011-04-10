<?php

/**
 * @name CONTROLLER_NAME
 * Description of CONTROLLER_NAME
 *
 * @author Joseph Dignadice
 */
class DomainController extends Controller {
    private $_domain;
    /**
     * Declares class-based actions.
     */
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
                                'actions'=>array('index', 'addDomain', 'update'),
                                'users'=>Yii::app()->getModule('user')->getAdmins(),
                        ),
                        array('deny',  // deny all users
                                'users'=>array('*'),
                        ),
                );
        }
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $dataProvider=new CActiveDataProvider('DomainOfQuality');
        $this->render('/domain_of_quality/domains', array('model' => $dataProvider));
    }

    
    
    public function actionAddDomain() {
        $this->_domain = new DomainOfQuality();
        if (isset($_POST['DomainOfQuality'])){
            $this->_domain->attributes = $_POST['DomainOfQuality'];
            $this->_domain->save();
            $this->redirect(array('/Domain/index'));
        }
        $this->render('/domain_of_quality/add_domain', array('model'=>$this->_domain));
    }

    public function actionUpdate(){
        $this->_domain = DomainOfQuality::model()->findByPk($_GET['id']);
        if (isset($_POST['DomainOfQuality'])){
            $this->_domain->attributes = $_POST['DomainOfQuality'];
            $this->_domain->save();
            $this->redirect(array('/Domain/index'));
        }
        $this->render('/domain_of_quality/update_domain', array('model'=>$this->_domain));
    }


}

?>