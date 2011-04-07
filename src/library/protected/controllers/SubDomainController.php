<?php

/**
 * @name SubDomainController
 * Description of Subdomain
 *
 * @author Antonio San Miguel
 */
class SubDomainController extends Controller {

    private $_subdomain;
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
        $data = new CActiveDataProvider('SubDomain');
        $this->render('/subdomain/index', array('model'=>$data));
    }

    public function actionAdd() {
        $this->_subdomain = new SubDomain();
        if (isset($_POST['SubDomain'])){
            $this->_subdomain->attributes = $_POST['SubDomain'];
            $this->_subdomain->save();
            $this->redirect(array('/SubDomain/index'));
        }
        $this->render('/subdomain/add', array('model'=>$this->_subdomain));
    }

    public function actionUpdate(){
        $this->_subdomain = SubDomain::model()->findByPk($_GET['id']);
        if (isset($_POST['SubDomain'])){
            $this->_subdomain->attributes = $_POST['SubDomain'];
            $this->_subdomain->save();
            $this->redirect(array('/SubDomain/index'));
        }
        $this->render('/subdomain/update', array('model'=>$this->_subdomain));
    }
}
?>