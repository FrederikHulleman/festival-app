<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timetable $timetable
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Timetable'), ['action' => 'edit', $timetable->band_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Timetable'), ['action' => 'delete', $timetable->band_id], ['confirm' => __('Are you sure you want to delete # {0}?', $timetable->band_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Timetable'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Timetable'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bands'), ['controller' => 'Bands', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Band'), ['controller' => 'Bands', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Festivals'), ['controller' => 'Festivals', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Festival'), ['controller' => 'Festivals', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Dates'), ['controller' => 'Dates', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Date'), ['controller' => 'Dates', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stages'), ['controller' => 'Stages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stage'), ['controller' => 'Stages', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="timetable view large-9 medium-8 columns content">
    <h3><?= h($timetable->band_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Band') ?></th>
            <td><?= $timetable->has('band') ? $this->Html->link($timetable->band->name, ['controller' => 'Bands', 'action' => 'view', $timetable->band->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Festival') ?></th>
            <td><?= $timetable->has('festival') ? $this->Html->link($timetable->festival->title, ['controller' => 'Festivals', 'action' => 'view', $timetable->festival->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= $timetable->has('date') ? $this->Html->link($timetable->date->id, ['controller' => 'Dates', 'action' => 'view', $timetable->date->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stage') ?></th>
            <td><?= $timetable->has('stage') ? $this->Html->link($timetable->stage->name, ['controller' => 'Stages', 'action' => 'view', $timetable->stage->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Starttime') ?></th>
            <td><?= h($timetable->starttime) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Endtime') ?></th>
            <td><?= h($timetable->endtime) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($timetable->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($timetable->modified) ?></td>
        </tr>
    </table>
</div>
