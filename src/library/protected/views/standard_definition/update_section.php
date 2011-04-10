<?php
$form = $this->beginWidget('CActiveForm', array(
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
?>
<div class="form">
    <div class="rowHeader">
        <h3>Standard Definition Section</h3>
    </div>
    <div class="row">
        <span class="columnHeader">
            <?php echo $form->labelEx($model, 'name') ?>
        </span>
        <span class="columnElement">
            <span class="element">
                <?php echo $form->textField($model, 'name', array('class' => 'medium')); ?>
            </span>
        </span>
    </div>
    <div class="row">
        <span class="columnHeader">
            <?php echo $form->labelEx($model, 'description') ?>
        </span>
        <span class="columnElement">
            <span class="element">
                <?php echo $form->textArea($model, 'description', array('class' => 'medium')); ?>
            </span>
        </span>
    </div>
    <div class="row">
        <span class="columnHeader">
            <?php echo $form->labelEx($model, 'weight') ?>
        </span>
        <span class="columnElement">
            <span class="element">
                <?php echo $form->textField($model, 'weight', array('class' => 'medium')); ?>
            </span>
        </span>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Add Standard Definition Section'); ?>
    </div>
</div>
<?php $this->endWidget(); ?>