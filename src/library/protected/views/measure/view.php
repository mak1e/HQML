<div class="grid_11 measurePage">
    <div>
        <h1>
            <?php echo $data->title; ?>
        </h1>
<!--        <p>
            <?php
//            if ($revision->is_locked) {
//                echo 'Final';
//
//                if ($revision->id == $data->latestRevision->id) {
//                    echo ' | ';
//                    echo CHtml::link('Create New Revision',
//                            array('/measure/createRevision', 'id' => $data->id));
//                }
//            } else {
//                echo 'Not Final';
//                echo ' | ';
//                echo CHtml::link('Make Final', array('measure/finaliseRevision',
//                    'id' => $data->id));
//            }
            ?>
        </p>-->
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
                    <br />
                    <?php
//                    if (!$revision->is_locked) {
//                        echo CHtml::ajaxLink('Update Item',
//                                array('/measure/addItem', 'id' => $data->id,
//                                    'item_id' => $item->id), array(
//                                        'update' => '#measureItem_' . $item->id,
//                                    ));
//                    }
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
    </div>
    </div>
    <div class="grid_5 measureSideBar">
        <div class="section">
            <h3>Overview</h3>
<?php //echo ' ' . CHtml::link('Edit',
                    //array('/measure/edit', 'id' => $data->id)); ?>
            <div class="sectionBody">
                <table class="sideBarTable">
                    <tr>
                        <td class="overviewLabel"><?php echo $data->getAttributeLabel('id'); ?></td>
                        <td><?php echo $data->id; ?></td>
                    </tr>
                    <tr>
                        <td class="overviewLabel"><?php echo $data->getAttributeLabel('creation_date'); ?></td>
                        <td><?php echo $data->creation_date; ?></td>
                    </tr>
                    <tr>
                        <td class="overviewLabel"><?php echo $data->getAttributeLabel('owner_organisation_id'); ?></td>
                        <td><?php echo $data->ownerOrganisation->name; ?></td>
                    </tr>
                    <tr>
                        <td class="overviewLabel"><?php echo $data->getAttributeLabel('owner_contact'); ?></td>
                        <td><?php echo $data->owner_contact; ?></td>
                    </tr>
                    <tr>
                        <td class="overviewLabel"><?php echo $data->getAttributeLabel('creator_organisation_id'); ?></td>
                        <td><?php echo $data->creatorOrganisation->name; ?></td>
                    </tr>
                    <tr>
                        <td class="overviewLabel"><?php echo $data->getAttributeLabel('creator_contact'); ?></td>
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