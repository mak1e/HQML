<?php
$form = $this->beginWidget('CActiveForm', array(
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
?>
<div class="form">
    <div class="row">
        <?php echo $form->labelEx($model, 'standard_definition_section_id'); ?>
        <?php echo $form->dropDownList($model, 'standard_definition_section_id',
        StandardDefinitionSection::getListData()); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'attribute_type'); ?>
        <?php echo $form->dropDownList($model, 'attribute_type',
                StandardDefinitionItem::getAttributesListData()); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'object_type_id'); ?>
        <?php echo $form->dropDownList($model, 'object_type_id',
                    ObjectType::getListData()); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'is_required'); ?>
        <?php echo $form->checkBox($model, 'is_required'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'is_multiple'); ?>
        <?php echo $form->checkBox($model, 'is_multiple'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'weight'); ?>
        <?php echo $form->textField($model, 'weight'); ?>
    </div>
    <div class="row">
        <?php echo CHtml::submitButton('Add Standard Definition Item'); ?>
    </div>
</div>
<?php $this->endWidget(); ?>