<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ticket $ticket
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ticket'), ['action' => 'edit', $ticket->visitor_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ticket'), ['action' => 'delete', $ticket->visitor_id], ['confirm' => __('Are you sure you want to delete # {0}?', $ticket->visitor_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tickets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ticket'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Festivals'), ['controller' => 'Festivals', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Festival'), ['controller' => 'Festivals', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Dates'), ['controller' => 'Dates', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Date'), ['controller' => 'Dates', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Visitors'), ['controller' => 'Visitors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Visitor'), ['controller' => 'Visitors', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tickets view large-9 medium-8 columns content">
    <h3><?= h($ticket->visitor_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Festival') ?></th>
            <td><?= $ticket->has('festival') ? $this->Html->link($ticket->festival->title, ['controller' => 'Festivals', 'action' => 'view', $ticket->festival->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= $ticket->has('date') ? $this->Html->link($ticket->date->slug, ['controller' => 'Dates', 'action' => 'view', $ticket->date->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Visitor') ?></th>
            <td><?= $ticket->has('visitor') ? $this->Html->link($ticket->visitor->id, ['controller' => 'Visitors', 'action' => 'view', $ticket->visitor->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($ticket->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($ticket->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Confirmed') ?></th>
            <td><?= $ticket->confirmed ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
