<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Band $band
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $band->slug],
                ['confirm' => __('Are you sure you want to delete # {0}?', $band->slug)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Bands'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Timetable'), ['controller' => 'Timetable', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Timetable'), ['controller' => 'Timetable', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bands form large-9 medium-8 columns content">
    <?= $this->Form->create($band) ?>
    <fieldset>
        <legend><?= __('Edit Band') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
