<div class="grid_11">
    <div>
        <h2>
            <?php echo $data->title; ?>
        </h2>
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
        <?php
        foreach (StandardDefinitionSection::model()->findAll() as $section) {
            echo '<table border="1">';
            echo '<tr>';
            echo '<th colspan=2>';
            echo $section->name;
            echo '</th>';
            echo '</tr>';
            foreach ($section->items as $item) {
                echo '<tr>';
                echo '<td width="200px">';
                echo $item->name;
                echo '</td>';
                echo '<td>';
                $itemData = MeasureItem::model()->find('standard_definition_item_id = :definitionId'
                        . ' AND revision_id = :revisionId', array(
                            ':definitionId' => $item->id,
                            ':revisionId' => $revision->id));
                if (isset($itemData)) {
                    echo $itemData->body;
                } else {
                    if (!$revision->is_locked) {
                        echo CHtml::link('Add Item',
                        array('/measure/addItem', 'id' => $data->id,
                            'item_id' => $item->id));
                    } else {
                        echo '';
                    }
                }
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
?>
    </div>
</div>
<div class="grid_4">
    <div class="section">
        <h3>Basic Facts</h3>
        <div class="sectionBody">
            <table>
                <tr>
                    <td><?php echo $data->getAttributeLabel('id'); ?></td>
                    <td><?php echo $data->id; ?></td>
                </tr>
                <tr>
                    <td><?php echo $data->getAttributeLabel('status'); ?></td>
                    <td><?php echo $data->status; ?></td>
                </tr>
                <tr>
                    <td><?php echo $data->getAttributeLabel('creation_date'); ?></td>
                    <td><?php echo $data->creation_date; ?></td>
                </tr>
                <tr>
                    <td><?php echo $data->getAttributeLabel('usage'); ?></td>
                    <td><?php echo $data->usage; ?></td>
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