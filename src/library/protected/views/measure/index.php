<?php Yii::app()->clientScript->registerScript('hideAdvanced', 
        '$("#advancedSearch").hide()', CClientScript::POS_READY); ?>
<?php
$this->breadcrumbs=array(
	'Measures',
);
?>
<div class="grid_16 measurePage">
    
    <div class="searchToolBar">
        <?php if (Yii::app()->user->getId() != NULL) { ?>
            <span id="createMeasure">
                <?php echo CHtml::link('Create New Measure',
                        array('/measure/create')); ?>
            </span>
        <?php } ?>
        <?php echo CHtml::beginForm(); ?>
            <div class="basicSearch">
                <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name' => 'search',
                    'sourceUrl' => array('/search/autocomplete'),
                    'options' => array(
                        'minLength' => '2',
                    ),
                    'htmlOptions' => array('id'=>'searchBox')
                )); ?>
                <?php echo CHtml::ajaxSubmitButton('Search', array('search/index'),
                    array('update' => '#measuresContainer'),
                    array('id' => 'searchButton')); ?>
                <br />
                <?php echo CHtml::link('Advanced Search', '#createMeasure', array(
                    'onClick' => '$("#advancedSearch").slideToggle()'
                )); ?>
            </div>
       <div id="advancedSearch">
    <span>
        <h4>Subject Area</h4>
        <?php echo CHtml::listBox('SubjectArea[]', array(),
                ObjectType::model()->findByPk(3)->getObjectsListData(),
                array('multiple' => 'multiple')); ?>
    </span>
    <span>
        <h4>Type of Measure</h4>
        <?php
        echo CHtml::listBox('TypeOfMeasure[]', array(),
                ObjectType::model()->findByPk(5)->getObjectsListData(),
                array('multiple' => 'multiple'));
        ?>
    </span>
    <span>
        <h4>Domains of Quality</h4>
        <?php
        echo CHtml::listBox('DomainOfQuality[]', array(),
                ObjectType::model()->findByPk(4)->getObjectsListData(),
                array('multiple' => 'multiple'));
        ?>
    </span>
    <span>
        <h4>Stage of Development</h4>
        <?php
        echo CHtml::listBox('StageOfDevelopment[]', array(),
                ObjectType::model()->findByPk(2)->getObjectsListData(),
                array('multiple' => 'multiple'));
        ?>
    </span>
    <span>
        <h4>Owner</h4>
<?php
        echo CHtml::listBox('Owner[]', array(),
                Organisation::getListData(), array('multiple' => 'multiple'));
?>
    </span>
</div>
            <?php echo CHtml::endForm(); ?>
        
    </div>
    <div id="measuresContainer">
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '/measure/index/_measure',
            'id' => 'measuresList'
                )
        );
        ?>
    </div>
</div>