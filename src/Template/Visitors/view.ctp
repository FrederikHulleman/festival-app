<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visitor $visitor
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Visitor'), ['action' => 'edit', $visitor->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Visitor'), ['action' => 'delete', $visitor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $visitor->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Visitors'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Visitor'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="visitors view large-9 medium-8 columns content">
    <h3><?= h($visitor->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($visitor->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($visitor->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($visitor->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($visitor->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Tickets') ?></h4>
        <?php if (!empty($visitor->tickets)): ?>
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
            <?php foreach ($visitor->tickets as $tickets): ?>
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
</div>
