<?php
$form = $this->beginWidget('CActiveForm', array(
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
?>
<ul class="form">
    <li class="rowHeader">
        <h3>Subdomain</h3>
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
        <?php echo CHtml::submitButton('Edit Subdomain'); ?>
    </li>
</ul>
<?php $this->endWidget(); ?>