<?php
$form = $this->beginWidget('CActiveForm', array(
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
?>
<ul class="form">
    <li class="rowHeader">
        <h3>Standard Definition Item</h3>
    </li>

    
        <span class="columnElement">
            <span class="element">

                <?php
                //echo $form->textField($model, 'standard_definition_section_id', array('class' => 'medium'));

                echo '<li>'.$form->labelEx($model, 'standard_definition_section_id') ;
                echo $form->textField($model, 'standard_definition_section_id', array('class' => 'medium')).'</li>';

                echo '<li>'.$form->labelEx($model, 'name');
                echo $form->textField($model, 'name').'</li>';
               
                echo '<li>'.$form->labelEx($model, 'description') ;
                echo $form->textField($model, 'description').'</li>';
                echo '<li>'.$form->labelEx($model, 'weight') ;
                echo $form->textField($model, 'weight').'</li>';
                ?>
                </span>
            </span>
        
    
    <li class="row buttons">
        <?php echo CHtml::submitButton('Add Standard Definition Item'); ?>
    </li>
</ul>
<?php $this->endWidget(); ?>