<?php

/**
 * @name SeachController
 * Description of SearchController
 *
 * @author Antonio San Miguel
 */
class SearchController extends Controller {

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
        $criteria = new CDbCriteria();

        if(isset($_GET['search']))
        {
          $search = $_GET['search'];
          $criteria->compare('title', $search, true, 'OR');
        }

        $dataProvider=new CActiveDataProvider("Measure", array('criteria'=>$criteria));

        $this->render('/search/index',array(
          'dataProvider'=>$dataProvider,
        ));

    }


    public function actionSearch() {
        
    }

}

?>