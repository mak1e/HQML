<div class="grid_11 measurePage">
    <div>
        <h1>
            <?php echo $data->title; ?>
        </h1>
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
            <div class="sectionBody">
                <table class="sideBarTable">
                    <tr>
                        <td class="overviewLabel"><?php echo $data->getAttributeLabel('reference_number'); ?></td>
                        <td><?php echo $data->reference_number; ?></td>
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
            foreach ($data->revisions as $eachRevision) {
                $current = false;
                if ($revision->id == $eachRevision->id) {
                    $current = true;
                }
                $this->renderPartial('/measure/view/_revision',
                        array('data' => $eachRevision, 'current' => $current));
            }
?>
        </div>
    </div>
</div>