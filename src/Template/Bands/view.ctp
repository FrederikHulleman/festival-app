<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Band $band
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Band'), ['action' => 'edit', $band->slug]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Band'), ['action' => 'delete', $band->slug], ['confirm' => __('Are you sure you want to delete # {0}?', $band->slug)]) ?> </li>
        <li><?= $this->Html->link(__('List Bands'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Band'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Timetable'), ['controller' => 'Timetable', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Timetable'), ['controller' => 'Timetable', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bands view large-9 medium-8 columns content">
    <h3><?= h($band->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($band->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($band->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($band->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($band->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Timetable') ?></h4>
        <?php if (!empty($band->timetable)): ?>
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
            <?php foreach ($band->timetable as $timetable): ?>
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
