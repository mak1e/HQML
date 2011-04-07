<div id="test">
    <?php echo CHtml::link($data->last_updated, array('/measure/view',
        'id' => $data->measure_id, 'revision' => $data->id)); ?>
    <p>
        <?php echo $data->description; ?>
    </p>
</div>