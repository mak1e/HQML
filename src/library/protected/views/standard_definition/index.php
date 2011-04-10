<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
echo CHtml::link('Add', array('/StandardDefinition/addSection'));
$this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$model,
        'columns'=>array(
            'id',          // display the 'id' attribute
            'name',  // display the 'title' attribute of the 'category' relation
            'description', // display the 'description' attribute
            'weight', // display the 'weight' attribute
            array(            // display a column with "view", "update" and "delete" buttons
                'class'=>'CButtonColumn',
                'template'=>'{view}{update}',
            ),
        ),
    ));
?>