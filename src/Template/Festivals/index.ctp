<!-- File: src/Template/Festivals/index.ctp -->

<h1>Festivals</h1>
<table>
    <tr>
        <th>Title</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we iterate through our $festivals query object, printing out article info -->

    <?php foreach ($festivals as $festival): ?>
    <tr>
        <td>
            <?= $this->Html->link($festival->title, ['action' => 'view', $festival->id]) ?>
        </td>
        <td>
            <?= $festival->created->format(DATE_RFC850) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>