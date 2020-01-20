<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timetable $timetable
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $timetable->band_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $timetable->band_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Timetable'), ['action' => 'index']) ?></li>
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
<div class="timetable form large-9 medium-8 columns content">
    <?= $this->Form->create($timetable) ?>
    <fieldset>
        <legend><?= __('Edit Timetable') ?></legend>
        <?php
            echo $this->Form->control('starttime');
            echo $this->Form->control('endtime');
            echo $this->Form->control('festivals._ids', ['options' => $festivals]);
            echo $this->Form->control('dates._ids', ['options' => $dates]);
            echo $this->Form->control('bands._ids', ['options' => $bands]);
            echo $this->Form->control('stages._ids', ['options' => $stages]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
