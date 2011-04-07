<?php
$form = $this->beginWidget('CActiveForm', array(
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
?>
<div class="form">
    <div class="rowHeader">
        <h3>Measure</h3>
    </div>
    <div class="row">
        <?php echo $form->errorSummary($model); ?>
    </div>
    <div class="row">
        <span class="columnHeader">
            <?php echo $form->labelEx($model, 'title') ?>
        </span>
        <span class="columnElement">
            <span class="element">
                <?php echo $form->textField($model, 'title'); ?>
            </span>
        </span>
    </div>
    <div class="row">
        <span class="columnHeader">
            <?php echo $form->labelEx($model, 'status') ?>
        </span>
        <span class="columnElement">
            <span class="element">
                <?php echo $form->dropDownList($model, 'status', $model->getStatusOptions()); ?>
            </span>
        </span>
    </div>
    <div class="row">
        <span class="columnHeader">
            <?php echo $form->labelEx($model, 'usage') ?>
        </span>
        <span class="columnElement">
            <span class="element">
                <?php echo $form->textArea($model, 'usage'); ?>
            </span>
        </span>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Add Measure'); ?>
    </div>
</div>
<?php $this->endWidget(); ?>