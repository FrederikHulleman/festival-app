<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Date $date
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Date'), ['action' => 'edit', $date->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Date'), ['action' => 'delete', $date->id], ['confirm' => __('Are you sure you want to delete # {0}?', $date->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Dates'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Date'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Festivals'), ['controller' => 'Festivals', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Festival'), ['controller' => 'Festivals', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Timetable'), ['controller' => 'Timetable', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Timetable'), ['controller' => 'Timetable', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="dates view large-9 medium-8 columns content">
    <h3><?= h($date->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Festival') ?></th>
            <td><?= $date->has('festival') ? $this->Html->link($date->festival->title, ['controller' => 'Festivals', 'action' => 'view', $date->festival->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($date->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Starttime') ?></th>
            <td><?= h($date->starttime) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Endtime') ?></th>
            <td><?= h($date->endtime) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($date->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($date->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Tickets') ?></h4>
        <?php if (!empty($date->tickets)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Festival Id') ?></th>
                <th scope="col"><?= __('Date Id') ?></th>
                <th scope="col"><?= __('Visitor Id') ?></th>
                <th scope="col"><?= __('Confirmed') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($date->tickets as $tickets): ?>
            <tr>
                <td><?= h($tickets->festival_id) ?></td>
                <td><?= h($tickets->date_id) ?></td>
                <td><?= h($tickets->visitor_id) ?></td>
                <td><?= h($tickets->confirmed) ?></td>
                <td><?= h($tickets->created) ?></td>
                <td><?= h($tickets->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tickets', 'action' => 'view', $tickets->visitor_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tickets', 'action' => 'edit', $tickets->visitor_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tickets', 'action' => 'delete', $tickets->visitor_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tickets->visitor_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Timetable') ?></h4>
        <?php if (!empty($date->timetable)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Band Id') ?></th>
                <th scope="col"><?= __('Festival Id') ?></th>
                <th scope="col"><?= __('Date Id') ?></th>
                <th scope="col"><?= __('Stage Id') ?></th>
                <th scope="col"><?= __('Start Time') ?></th>
                <th scope="col"><?= __('End Time') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($date->timetable as $timetable): ?>
            <tr>
                <td><?= h($timetable->band_id) ?></td>
                <td><?= h($timetable->festival_id) ?></td>
                <td><?= h($timetable->date_id) ?></td>
                <td><?= h($timetable->stage_id) ?></td>
                <td><?= h($timetable->start_time) ?></td>
                <td><?= h($timetable->end_time) ?></td>
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
