<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Band $band
 */
?>
<div class="bands form large-9 medium-8 columns content">
    <?= $this->Form->create($band) ?>
    <fieldset>
        <legend><?= __('Add Band') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
