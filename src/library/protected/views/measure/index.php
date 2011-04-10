<?php
$this->breadcrumbs=array(
	'Library',
);
echo CHtml::link('Create New Measure', array('/measure/create'));
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '/measure/index/_measure'
    )
);

?>
