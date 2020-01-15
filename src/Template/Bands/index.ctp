<h1>Bands</h1>
<p><?= $this->Html->link('Add Band', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Title</th>
        <th>Created</th>
        <th>Action</th>
    </tr>

    <?php foreach ($bands as $band): ?>
    <tr>
        <td>
            <?= $this->Html->link($band->name, ['action' => 'view', $band->slug]) ?>
        </td>
        <td>
            <?= $band->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Html->link('Edit', ['action' => 'edit', $band->slug]) ?>
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $band->slug],
                ['confirm' => 'Are you sure?'])
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>