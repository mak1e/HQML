<div class="measureItem">
    <?php echo CHtml::link($data->title, array(
        'measure/view', 'id' => $data->id)); ?>
    <br />
    <?php echo $data->status; ?>
</div>