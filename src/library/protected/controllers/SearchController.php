<?php

/**
 * @name SeachController
 * Description of SearchController
 *
 * @author Antonio San Miguel
 */
class SearchController extends Controller {
 public $lst = array();
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
                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
                                'actions'=>array('index', 'advanced', 'autocomplete'),
                                'users'=>array('*'),
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

    public function actionAutocomplete() {
        $result = array();
        $criteria = new CDbCriteria();
        //$_GET['search'] = 't';
        if(isset($_GET['term'])) {
            $qtxt ="SELECT title FROM {{measures}} WHERE title LIKE :title";
            $command =Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":title", '%'.$_GET['term'].'%', PDO::PARAM_STR);
            $result =$command->queryColumn();
        }
       
        print_r(CJSON::encode($result));
        Yii::app()->end();
    }


    public function actionAdvanced() {
        $criteria = new CDbCriteria();
       $ownerCriteria = new CDbCriteria();
        $creatorCriteria = new CDbCriteria();

        //$subjectAreaCriteria = new CDbCriteria();

        /*if(isset($_GET['categories'])) {
            $ownerCriteria =
        }*/

        $ownerCriteria->select='name';
        $owner = Organisation::model()->find($ownerCriteria);
        
        $creatorCriteria->select='name';
        //$creator = DomainOfQuality::model()->find($domainCriteria);

         if(isset($_GET['search'])){
          $search = $_GET['search'];
          $criteria->compare('title', $search, true, 'OR');
               if(isset($_GET['Organisation'])){
                   $a = "'".implode(',', $_GET['Organisation'][id])."'";
                    $criteria->addCondition('owner_organisation_id LIKE '.$a);
                   //$criteria->addCondition('owner_organisation_id LIKE '.$a);
               }
        }
        $dataProvider=new CActiveDataProvider("Measure", array('criteria'=>$criteria));
        $this->render('/search/advanced',array(
          'dataProvider'=>$dataProvider,
          'owner'=> $owner,
          'domain'=>$domain,
        ));
    }
}

?>