<div class="grid_11">
    <div>
        <h1>
            <?php echo $data->title; ?>
        </h1>
        <p>
            <?php
            if ($revision->is_locked) {
                echo 'Final';

                if ($revision->id == $data->latestRevision->id) {
                    echo ' | ';
                    echo CHtml::link('Create New Revision',
                            array('/measure/createRevision', 'id' => $data->id));
                }
            } else {
                echo 'Not Final';
                echo ' | ';
                echo CHtml::link('Make Final', array('measure/finaliseRevision',
                    'id' => $data->id));
            }
            ?>
        </p>
    </div>
    <div>
<?php foreach (StandardDefinitionSection::model()->findAll() as $section) { ?>
        <table class="sectionTable">
            <tr>
               <th colspan="2">
                    <?php echo $section->name; ?>
               </th>
            </tr>
        <?php foreach ($section->items as $item) { ?>
            <tr>
                <td class="standardItem"
                    id="standardItem_<?php echo $item->id ?>">
                    <?php echo $item->name; ?>
                    <?php
                    if (!$revision->is_locked) {
                        echo CHtml::ajaxLink('Update Item',
                                array('/measure/addItem', 'id' => $data->id,
                                    'item_id' => $item->id), array(
                                        'update' => '#measureItem_' . $item->id,
                                    ));
                    }
                    ?>
                </td>
                <td class="measureItem">
                    <div id="measureItem_<?php echo $item->id ?>">
                    <?php if ($item->is_multiple) {
                        $itemData = MeasureItem::model()->findAll(
                                        'standard_definition_item_id = :definitionId'
                                        . ' AND revision_id = :revisionId', array(
                                    ':definitionId' => $item->id,
                                    ':revisionId' => $revision->id));
                        $this->renderPartial('/measure/_item/viewMultiple',
                                array('data' => $itemData));
                    } else {
                        $itemData = MeasureItem::model()->find(
                                        'standard_definition_item_id = :definitionId'
                                        . ' AND revision_id = :revisionId', array(
                                    ':definitionId' => $item->id,
                                    ':revisionId' => $revision->id));
                        $this->renderPartial('/measure/_item/view',
                                array('data' => $itemData));
                    } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </table>
<?php } ?>
<?php
//            foreach (StandardDefinitionSection::model()->findAll() as $section) {
//                echo '<table border="1" style="width:100%;">';
//                echo '<tr>';
//                echo '<th colspan=2>';
//                echo $section->name;
//                echo '</th>';
//                echo '</tr>';
//                foreach ($section->items as $item) {
//                    echo '<tr>';
//                    echo '<td width="200px">';
//                    echo $item->name;
//                    echo '</td>';
//                    echo '<td>';
//                    if ($item->is_multiple) {
//                        $itemData = MeasureItem::model()->findAll(
//                                        'standard_definition_item_id = :definitionId'
//                                        . ' AND revision_id = :revisionId', array(
//                                    ':definitionId' => $item->id,
//                                    ':revisionId' => $revision->id));
//                        $this->renderPartial('/measure/_item/viewMultiple',
//                                array('data' => $itemData));
//                    } else {
//                        $itemData = MeasureItem::model()->find(
//                                        'standard_definition_item_id = :definitionId'
//                                        . ' AND revision_id = :revisionId', array(
//                                    ':definitionId' => $item->id,
//                                    ':revisionId' => $revision->id));
//                        $this->renderPartial('/measure/_item/view',
//                                array('data' => $itemData));
//                    }
//                    if (!$revision->is_locked) {
//                        echo CHtml::link('Add Item',
//                                array('/measure/addItem', 'id' => $data->id,
//                                    'item_id' => $item->id));
//                    }
//
//
//                    echo '</td>';
//                    echo '</tr>';
//                }
//                echo '</table>';
//            }
?>
        </div>
    </div>
    <div class="grid_4">
        <div class="section">
            <h3>Basic Facts</h3>
<?php echo ' ' . CHtml::link('Edit',
                    array('/measure/edit', 'id' => $data->id)); ?>
            <div class="sectionBody">
                <table>
                    <tr>
                        <td><?php echo $data->getAttributeLabel('id'); ?></td>
                        <td><?php echo $data->id; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $data->getAttributeLabel('creation_date'); ?></td>
                        <td><?php echo $data->creation_date; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $data->getAttributeLabel('owner_organisation_id'); ?></td>
                        <td><?php echo $data->ownerOrganisation->name; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $data->getAttributeLabel('owner_contact'); ?></td>
                        <td><?php echo $data->owner_contact; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $data->getAttributeLabel('creator_organisation_id'); ?></td>
                        <td><?php echo $data->creatorOrganisation->name; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $data->getAttributeLabel('creator_contact'); ?></td>
                        <td><?php echo $data->creator_contact; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="section">
            <h3>Revisions</h3>
            <div class="sectionBody">
<?php
            foreach ($data->revisions as $revision) {
                $this->renderPartial('/measure/view/_revision',
                        array('data' => $revision));
            }
?>
        </div>
    </div>
</div>
<?php
//                $itemData = MeasureItem::model()->findAll('standard_definition_item_id = :definitionId'
//                        . ' AND revision_id = :revisionId', array(
//                            ':definitionId' => $item->id,
//                            ':revisionId' => $revision->id));
//                if (!empty($itemData)) {
//                    foreach ($itemData as $test) {
//                        echo $test->getItemData();
//                    }
//                    if (!$revision->is_locked) {
//                        echo ' ' . CHtml::link('Edit Item',
//                        array('/measure/editItem', 'id' => $data->id,
//                            'item_id' => $itemData->id));
//                    }
//                } else {
//                    if (!$revision->is_locked) {
//                        echo CHtml::link('Add Item',
//                        array('/measure/addItem', 'id' => $data->id,
//                            'item_id' => $item->id));
//                    } else {
//                        echo '';
//                    }
//                }
?>