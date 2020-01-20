<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timetable[]|\Cake\Collection\CollectionInterface $timetable
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Timetable'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bands'), ['controller' => 'Bands', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Band'), ['controller' => 'Bands', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Festivals'), ['controller' => 'Festivals', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Festival'), ['controller' => 'Festivals', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Dates'), ['controller' => 'Dates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Date'), ['controller' => 'Dates', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stages'), ['controller' => 'Stages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stage'), ['controller' => 'Stages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="timetable index large-9 medium-8 columns content">
    <h3><?= __('Timetable') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('band_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('festival_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stage_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('starttime') ?></th>
                <th scope="col"><?= $this->Paginator->sort('endtime') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($timetable as $timetable): ?>
            <tr>
                <td><?= $timetable->has('band') ? $this->Html->link($timetable->band->name, ['controller' => 'Bands', 'action' => 'view', $timetable->band->id]) : '' ?></td>
                <td><?= $timetable->has('festival') ? $this->Html->link($timetable->festival->title, ['controller' => 'Festivals', 'action' => 'view', $timetable->festival->id]) : '' ?></td>
                <td><?= $timetable->has('date') ? $this->Html->link($timetable->date->id, ['controller' => 'Dates', 'action' => 'view', $timetable->date->id]) : '' ?></td>
                <td><?= $timetable->has('stage') ? $this->Html->link($timetable->stage->name, ['controller' => 'Stages', 'action' => 'view', $timetable->stage->id]) : '' ?></td>
                <td><?= h($timetable->starttime) ?></td>
                <td><?= h($timetable->endtime) ?></td>
                <td><?= h($timetable->created) ?></td>
                <td><?= h($timetable->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $timetable->band_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $timetable->band_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $timetable->band_id], ['confirm' => __('Are you sure you want to delete # {0}?', $timetable->band_id)]) ?>
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
