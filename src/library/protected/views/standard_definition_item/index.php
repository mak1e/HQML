<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
echo CHtml::link('Add', array('StandardDefinitionItem/add'));
echo '</br>';
        $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$model,
        'columns'=>array(
            'id',          // display the 'title' attribute
            'standard_definition_section_id',
            'name', 'description', 'weight',
    // display the 'name' attribute of the 'category' relation
            array(            // display a column with "view", "update" and "delete" buttons
                'class'=>'CButtonColumn', 'template'=>'{view}{update}',
            ),
        ),
    ));
?>
