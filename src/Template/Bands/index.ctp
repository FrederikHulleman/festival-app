<h1>Bands</h1>
<?= $this->Html->link('Add Band', ['action' => 'add']) ?>
<table>
    <tr>
        <th>Title</th>
        <th>Created</th>
    </tr>

    <?php foreach ($bands as $band): ?>
    <tr>
        <td>
            <?= $this->Html->link($band->name, ['action' => 'view', $band->slug]) ?>
        </td>
        <td>
            <?= $band->created->format(DATE_RFC850) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>