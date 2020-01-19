<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Festival $festival
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Festival'), ['action' => 'edit', $festival->slug]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Festival'), ['action' => 'delete', $festival->slug], ['confirm' => __('Are you sure you want to delete # {0}?', $festival->slug)]) ?> </li>
        <li><?= $this->Html->link(__('List Festivals'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Festival'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Dates'), ['controller' => 'Dates', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Date'), ['controller' => 'Dates', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stages'), ['controller' => 'Stages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stage'), ['controller' => 'Stages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Timetable'), ['controller' => 'Timetable', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Timetable'), ['controller' => 'Timetable', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Order Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('View Bands'), ['controller' => 'Bands', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('View Timetable'), ['controller' => 'Timetable', 'action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="festivals view large-9 medium-8 columns content">
    <h3>ADMIN PAGE <?= h($festival->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($festival->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($festival->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($festival->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($festival->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($festival->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Dates') ?></h4>
        <?php if (!empty($festival->dates)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Festival Id') ?></th>
                <th scope="col"><?= __('Starttime') ?></th>
                <th scope="col"><?= __('Endtime') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($festival->dates as $dates): ?>
            <tr>
                <td><?= h($dates->id) ?></td>
                <td><?= h($dates->festival_id) ?></td>
                <td><?= h($dates->starttime) ?></td>
                <td><?= h($dates->endtime) ?></td>
                <td><?= h($dates->created) ?></td>
                <td><?= h($dates->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Dates', 'action' => 'view', $dates->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Dates', 'action' => 'edit', $dates->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Dates', 'action' => 'delete', $dates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dates->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Stages') ?></h4>
        <?php if (!empty($festival->stages)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Festival Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($festival->stages as $stages): ?>
            <tr>
                <td><?= h($stages->id) ?></td>
                <td><?= h($stages->festival_id) ?></td>
                <td><?= h($stages->name) ?></td>
                <td><?= h($stages->created) ?></td>
                <td><?= h($stages->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Stages', 'action' => 'view', $stages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Stages', 'action' => 'edit', $stages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Stages', 'action' => 'delete', $stages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tickets') ?></h4>
        <?php if (!empty($festival->tickets)): ?>
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
            <?php foreach ($festival->tickets as $tickets): ?>
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
        <?php if (!empty($festival->timetable)): ?>
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
            <?php foreach ($festival->timetable as $timetable): ?>
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