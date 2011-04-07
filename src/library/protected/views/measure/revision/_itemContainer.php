<div id="<?php echo 'measureItem_' . $data->id ?>">
    <?php $this->renderPartial('/measure/revision/_item',
            array('data'=>$data, 'update' => 'measureItem_' . $data->id)); ?>
</div>