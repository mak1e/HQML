<div class="_measureItem">
    <?php echo CHtml::link($data->title, array(
        'measure/view', 'id' => $data->id), array('class'=>'mainLink')); ?>
    <?php $generalDescription = MeasureItem::model()->find(
                'standard_definition_item_id = :stdId AND revision_id = :revId',
                array(':stdId'=>4, ':revId'=>$data->latestRevision->id)); ?>
    <?php if ($generalDescription != NULL) {
    echo '<p>';
        $this->renderPartial('/measure/_item/view', array('data'=>$generalDescription));
    echo '</p>';
    } ?>
    <?php if ($data->creatorOrganisation != NULL) {
    echo '<span><b>Created by:</b> ';
        echo $data->creatorOrganisation->name;
    echo '</span>';
    } ?>
    <?php $stages = MeasureItem::model()->findAll(
                'standard_definition_item_id = :stdId AND revision_id = :revId',
                array(':stdId'=>1, ':revId'=>$data->latestRevision->id)); ?>
    <?php if ($stages != NULL) {
    echo '<span><b>Stage of development:</b> ';
        $this->renderPartial('/measure/_item/viewMultiple', array('data'=>$stages));
    echo '</span>';
    } ?>
    <?php $domains = MeasureItem::model()->findAll(
                'standard_definition_item_id = :stdId AND revision_id = :revId',
                array(':stdId'=>6, ':revId'=>$data->latestRevision->id)); ?>
    <?php if ($domains != NULL) {
    echo '<span><b>Domains of quality:</b> ';
        $this->renderPartial('/measure/_item/viewMultiple', array('data'=>$domains));
    echo '</span>';
    } ?>
</div>