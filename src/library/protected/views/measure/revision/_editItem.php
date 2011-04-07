<?php
$form = $this->beginWidget('CActiveForm', array(
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
?>
<ul class="form">
    <li class="row">
        <?php echo $form->errorSummary($model); ?>
    </li>
    <li class="rowHeader">
        <h3>Measure</h3>
    </li>
    <li class="row">
        <span class="columnHeader">
            <?php echo $form->labelEx($model, 'standard_definition_item_id') ?>
        </span>
        <span class="columnElement">
            <span class="element">
                <?php echo $form->dropDownList($model, 'standard_definition_item_id',
                        CHtml::listData(StandardDefinitionItem::model()->findAll(), 'id', 'name')); ?>
                </span>
        </span>
    </li>
    <li class="row">
        <span class="columnHeader">
            <?php echo $form->labelEx($model, 'body') ?>
        </span>
        <span class="columnElement">
            <span class="element">
                <?php echo $form->textArea($model, 'body', array('class' => 'medium')); ?>
            </span>
        </span>
    </li>
    <li class="row buttons">
        <?php echo CHtml::submitButton('Save'); ?>
    </li>
</ul>
<?php $this->endWidget(); ?>