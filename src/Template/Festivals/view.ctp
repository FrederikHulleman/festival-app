<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Festival $festival
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Order Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('View Bands'), ['controller' => 'Bands', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('View Timetable'), ['controller' => 'Timetable', 'action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="festivals view large-9 medium-8 columns content">
    <h3>VISITOR PAGE <?= h($festival->title) ?></h3>
    <div class="row">
        <?= $this->Text->autoParagraph(h($festival->description)); ?>
    </div>
    <div class="related">
        <?php if (!empty($festival->dates)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Starttime') ?></th>
                <th scope="col"><?= __('Endtime') ?></th>
            </tr>
            <?php foreach ($festival->dates as $dates): ?>
            <tr>
                <td><?= h($dates->starttime) ?></td>
                <td><?= h($dates->endtime) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
