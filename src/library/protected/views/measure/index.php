<div class="grid_16 measurePage">
    <h1>
        Measures
    </h1>
    <div class="searchToolBar">
        <?php  if (Yii::app()->user->getId() != NULL) { ?>
         <span id="createMeasure">
        <?php echo CHtml::link('Create New Measure', array('/measure/create')); ?>
        </span>
        <?php } ?>
        <span>
        <?php
        echo CHtml::beginForm();
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name' => 'search',
            'sourceUrl' => array('/search/autocomplete'),
            'options' => array(
                'minLength' => '2',
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;'
            ),
        ));
        echo CHtml::ajaxSubmitButton('Search', array('search/index'),
                array('update'=>'#measuresContainer'),
                array('id' => 'searchButton'));
        echo CHtml::endForm();
        ?>
        </span>
         
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