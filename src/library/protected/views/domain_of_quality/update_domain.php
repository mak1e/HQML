<?php
$form = $this->beginWidget('CActiveForm', array(
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
?>
<ul class="form">
    <li class="rowHeader">
        <h3>Domain of Quality</h3>
    </li>
    <li class="row">
        <span class="columnHeader">
            <?php echo $form->labelEx($model, 'name') ?>
        </span>
        <span class="columnElement">
            <span class="element">
                <?php echo $form->textField($model, 'name', array('class' => 'medium')); ?>
            </span>
        </span>
    </li>

    <li class="row buttons">
        <?php echo CHtml::submitButton('Save Domain of Quality'); ?>
    </li>
</ul>
<?php $this->endWidget(); ?>