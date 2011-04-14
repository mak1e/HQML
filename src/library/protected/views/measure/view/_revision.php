<div class="_revision">
    <?php $date = new DateTime($data->last_updated);
    if ($current == true) {
        echo $date->format('d F Y, g:iA');
    } else {
     echo CHtml::link($date->format('d F Y, g:iA'), array('/measure/view',
        'id' => $data->measure_id, 'revision' => $data->id));
    }?>
    <?php if($data->description!='') { ?>
    <span>
        <?php echo ' - ' . $data->description; ?>
    </span>
    <?php } ?>
</div>