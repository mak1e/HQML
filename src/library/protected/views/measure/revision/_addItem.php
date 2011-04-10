<?php
if($model->definitionItem->attribute_type == 'object_data_id') {
    $this->renderPartial('/measure/revision/_addItemObject',
                array('model'=>$model));
} else if($model->definitionItem->attribute_type == 'blob') {
    $this->renderPartial('/measure/revision/_addItemBlob',
                array('model'=>$model));
}
?>