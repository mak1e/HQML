<?php
echo CHtml::beginForm(array('search/index'), 'get');
//echo CHtml::textField('search');
$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
    'name'=>'search',
    'sourceUrl'=> array('/search/autocomplete'),
    //'source'=>Measure::getMeasureTitles(),
    // additional javascript options for the autocomplete plugin
    'options'=>array(
        'minLength'=>'2',
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));

echo CHtml::submitButton('Search');
echo CHtml::endForm();

?>

<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'/measure/index/_measure'
    ));
?>