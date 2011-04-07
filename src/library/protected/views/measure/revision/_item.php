<?php
if (!$data->revision->is_locked) {
    echo CHtml::link('Edit', array('measure/editItem', 'id' => $data->id));
    echo ' | ';
    echo CHtml::link('Delete', array('measure/deleteItem', 'id' => $data->id));
}
?>
<h3>
<?php echo $data->definitionItem->name; ?>
</h3>
<p>
<?php echo $data->body; ?>
</p>