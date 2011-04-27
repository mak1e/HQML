<?php
$form = $this->beginWidget('CActiveForm', array(
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
?>
<div class="form">
    <div class="rowHeader">
        <h3>Add New Measure</h3>
    </div>
    <div class="row">
        <?php echo $form->errorSummary($model); ?>
    </div>
    <div class="row">
        <span class="columnHeader">
            <?php echo $form->labelEx($model, 'reference_number') ?>
        </span>
        <br />
        <span class="columnElement">
            <span class="element">
                <?php echo $form->textField($model, 'reference_number', array('class'=>'styled')); ?>
            </span>
        </span>
    </div>
    <div class="row">
        <span class="columnHeader">
            <?php echo $form->labelEx($model, 'title') ?>
        </span>
        <br />
        <span class="columnElement">
            <span class="element">
                <?php echo $form->textField($model, 'title', array('class'=>'styled')); ?>
            </span>
        </span>
    </div>
    <div class="row">
        <span class="columnHeader">
            <?php echo $form->labelEx($model, 'owner_organisation_id') ?>
        </span>
        <br />
        <span class="columnElement">
            <span class="element">
                <?php echo $form->dropDownList($model, 'owner_organisation_id',
                        Organisation::getListData()); ?>
            </span>
        </span>
    </div>
    <div class="row">
        <span class="columnHeader">
            <?php echo $form->labelEx($model, 'owner_contact') ?>
        </span>
        <br />
        <span class="columnElement">
            <span class="element">
                <?php echo $form->textArea($model, 'owner_contact', array('class'=>'styled')); ?>
            </span>
        </span>
    </div>
    <div class="row">
        <span class="columnHeader">
            <?php echo $form->labelEx($model, 'creator_organisation_id') ?>
        </span>
        <br />
        <span class="columnElement">
            <span class="element">
                <?php echo $form->dropDownList($model, 'creator_organisation_id',
                        Organisation::getListData()); ?>
            </span>
        </span>
    </div>
    <div class="row">
        <span class="columnHeader">
            <?php echo $form->labelEx($model, 'creator_contact') ?>
        </span>
        <br />
        <span class="columnElement">
            <span class="element">
                <?php echo $form->textArea($model, 'creator_contact'); ?>
            </span>
        </span>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Add Measure'); ?>
    </div>
</div>
<?php $this->endWidget(); ?>