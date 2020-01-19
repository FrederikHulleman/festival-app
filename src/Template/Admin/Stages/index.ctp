<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Stage[]|\Cake\Collection\CollectionInterface $stages
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Stage'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Festivals'), ['controller' => 'Festivals', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Festival'), ['controller' => 'Festivals', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Timetable'), ['controller' => 'Timetable', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Timetable'), ['controller' => 'Timetable', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stages index large-9 medium-8 columns content">
    <h3><?= __('Stages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('festival_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stages as $stage): ?>
            <tr>
                <td><?= $this->Number->format($stage->id) ?></td>
                <td><?= $stage->has('festival') ? $this->Html->link($stage->festival->title, ['controller' => 'Festivals', 'action' => 'view', $stage->festival->id]) : '' ?></td>
                <td><?= h($stage->name) ?></td>
                <td><?= h($stage->created) ?></td>
                <td><?= h($stage->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $stage->slug]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $stage->slug]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $stage->slug], ['confirm' => __('Are you sure you want to delete # {0}?', $stage->slug)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>