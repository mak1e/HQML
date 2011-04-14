<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Welcome to the Healthcare Quality Measures Library</title>

        <link rel="stylesheet" type="text/css" media="all" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="all" href="css/screen.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/960.css" />

    </head>

    <body>
        <div id="header"><a href="http://202.89.42.8/dev/library"><img src="images/patients-first-logo.jpg" alt="Health Care" height="111" border="0" class="logo"/></a>

            <div id="secondary-nav">
                <ul id="sub-navigation">
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Home', 'url' => array('/site/index')),
                            array('label' => 'Contact Us', 'url' => array('/site/contact')),
                            array('url' => Yii::app()->getModule('user')->loginUrl, 'label' => Yii::app()->getModule('user')->t("Login"), 'visible' => Yii::app()->user->isGuest, 'itemOptions'=>array('class'=>'grey')),
                            array('url' => array('/user/admin'), 'label' => 'Manage', 'visible' => Yii::app()->getModule('user')->isAdmin()),
                            array('url' => Yii::app()->getModule('user')->logoutUrl, 'label' => Yii::app()->getModule('user')->t("Logout") . ' (' . Yii::app()->user->name . ')', 'visible' => !Yii::app()->user->isGuest),
                        )
                    ))
                    ?>
                </ul>
            </div>

            <div id="primary-nav">
                <ul id="navigation">
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Healthcare Quality Measures NZ', 'url' => array('/measure/index')),
                            array('label' => 'Announcements', 'url' => array('/site/announcement')),
                            array('label' => 'Useful Resources', 'url' => array('/site/usefulResources')),
                            array('label' => 'Discussion Forum', 'url' => 'http://202.89.42.8/dev/forum', 'linkOptions' => array('target' => '_blank')),
                        //array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        //array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                        ),
                    ));
                    ?>
                </ul>
            </div>
        </div>

        <div id="breadcrumb-holder">
            <p><?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    )); ?></p>
                </div>

                <div class="container_16">
<?php echo $content; ?>
        </div>


        <div class="clear-divider"></div>

        <div id="footer">
            <div id="footer-container">
                <div id="footer-tag">
                    <?php 
                    foreach(ObjectData::model()->with('measureItems')->findAll() as $objectData) {
                        if(!empty($objectData->measureItems)) {
                            echo '<span class=tag>';
                            echo CHtml::link($objectData->name, 
                                    array('measure/index',
                                        'object_data_id' => $objectData->id));
                            echo '</span>';
                        }
                    }
                    foreach(Organisation::model()->with('measuresOwned')->findAll() as $organisation) {
                        if(!empty($organisation->measuresOwned)) {
                            echo '<span class=tag>';
                            echo CHtml::link($organisation->name,
                                    array('measure/index',
                                        'organisation_id' => $organisation->id));
                            echo '</span>';
                        }
                    }
                    ?>
                </div>
                <div id="footer-sidebar">
                    <h4>Contact Us</h4>
                    <h1>Telephone Support</h1>
                    <p>Tel:04 473 9166</p>
                    <h1>Email Support</h1>
                    <p>HQMNZ@patientsfirst.co.nz</p>
                </div>
            </div>
        </div>
    </body>
</html>