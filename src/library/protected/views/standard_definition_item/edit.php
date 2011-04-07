<?php
echo CHtml::link('Add Item', array('standard_definition_item/addItem'));
echo '<br />';
echo CHtml::link('Finalise Revision', array('StandaradDefinitionItem/finaliseRevision', 'id'=>$model->id));
echo '<br />';
echo $model->latestRevision->description;
echo '<br />';
if($model->latestRevision->is_locked) {
   echo 'Locked';
} else {
    echo 'Not Locked';
}
echo '<br />';

?>