<?php
$form = $this->beginWidget('CActiveForm', array(
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
?>
<div class="form">
    <div class="row">
        <?php echo $form->errorSummary($model); ?>
    </div>
    <div class="row">
        <h3><?php echo $model->definitionItem->name; ?></h3>
    </div>
    <div class="row">
        <span class="columnHeader">
            <?php echo $form->labelEx($model, 'body') ?>
        </span>
        <span class="columnElement">
            <span class="element">
                <?php echo $form->textArea($model, 'body', array('class' => 'medium')); ?>
            </span>
        </span>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Add Item'); ?>
    </div>
</div>
<?php $this->endWidget(); ?>