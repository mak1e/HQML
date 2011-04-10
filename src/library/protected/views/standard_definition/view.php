<?php
echo '<h2>'.$model->name.'</h2>';
echo '</br>';
echo CHtml::link('Add', array('StandardDefinitionItem/add'));
//echo '<h2>'.$model->id.'</h2>';

        $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>new CArrayDataProvider($model->items), 
        'columns'=>array(
            'section.name',
            'name', 'description', 'attribute_type',
            'is_required', 'is_multiple',
            'weight',
    // display the 'name' attribute of the 'category' relation
            array(            // display a column with "view", "update" and "delete" buttons
                'class'=>'CButtonColumn',
                'template'=>'{view}{update}',
                'updateButtonUrl'=>'Yii::app()->createUrl("/StandardDefinition/UpdateItem", array("id" =>$data->id))'
            ),
        ),
    ));
?>