<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Stage $stage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Stage'), ['action' => 'edit', $stage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Stage'), ['action' => 'delete', $stage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Stages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stage'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Festivals'), ['controller' => 'Festivals', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Festival'), ['controller' => 'Festivals', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Timetable'), ['controller' => 'Timetable', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Timetable'), ['controller' => 'Timetable', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="stages view large-9 medium-8 columns content">
    <h3><?= h($stage->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Festival') ?></th>
            <td><?= $stage->has('festival') ? $this->Html->link($stage->festival->title, ['controller' => 'Festivals', 'action' => 'view', $stage->festival->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($stage->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($stage->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($stage->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($stage->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($stage->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Timetable') ?></h4>
        <?php if (!empty($stage->timetable)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Band Id') ?></th>
                <th scope="col"><?= __('Festival Id') ?></th>
                <th scope="col"><?= __('Date Id') ?></th>
                <th scope="col"><?= __('Stage Id') ?></th>
                <th scope="col"><?= __('Starttime') ?></th>
                <th scope="col"><?= __('Endtime') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($stage->timetable as $timetable): ?>
            <tr>
                <td><?= h($timetable->band_id) ?></td>
                <td><?= h($timetable->festival_id) ?></td>
                <td><?= h($timetable->date_id) ?></td>
                <td><?= h($timetable->stage_id) ?></td>
                <td><?= h($timetable->starttime) ?></td>
                <td><?= h($timetable->endtime) ?></td>
                <td><?= h($timetable->created) ?></td>
                <td><?= h($timetable->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Timetable', 'action' => 'view', $timetable->band_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Timetable', 'action' => 'edit', $timetable->band_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Timetable', 'action' => 'delete', $timetable->band_id], ['confirm' => __('Are you sure you want to delete # {0}?', $timetable->band_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
