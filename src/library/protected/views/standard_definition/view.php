<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

echo '<h2>'.$model->name.'</h2>';
echo '</br>';
echo CHtml::link('Add', array('StandardDefinitionItem/add'));
//echo '<h2>'.$model->id.'</h2>';

        $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>new CArrayDataProvider($model->items), 
        'columns'=>array(
            'id',          // display the 'title' attribute
            'standard_definition_section_id',
            'name', 'description', 'weight',
    // display the 'name' attribute of the 'category' relation
            array(            // display a column with "view", "update" and "delete" buttons
                'class'=>'CButtonColumn',
                'template'=>'{view}{update}',
                'updateButtonUrl'=>'Yii::app()->createUrl("/StandardDefinition/UpdateItem", array("id" =>$data->id))'
            ),
        ),
    ));
?>