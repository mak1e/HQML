<?php
echo CHtml::link('Add', array('StandardDefinitionItem/add'));
echo '</br>';
        $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$model,
        'columns'=>array(
            array(
                'name' => 'Section',
                'value' => $data->section->name
            ),
            'name', 'description', 'weight',
    // display the 'name' attribute of the 'category' relation
            array(            // display a column with "view", "update" and "delete" buttons
                'class'=>'CButtonColumn', 'template'=>'{view}{update}',
            ),
        ),
    ));
?>
