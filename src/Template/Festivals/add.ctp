<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Festival $festival
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Festivals'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="festivals form large-9 medium-8 columns content">
    <?= $this->Form->create($festival) ?>
    <fieldset>
        <legend><?= __('Add Festival') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('slug');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
