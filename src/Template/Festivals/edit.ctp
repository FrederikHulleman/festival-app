<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Festival $festival
 */
?>
<div class="festivals form large-9 medium-8 columns content">
    <?= $this->Form->create($festival) ?>
    <fieldset>
        <legend><?= __('Edit Festival') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('description');
            foreach($dates as $date):
                echo $this->Form->control('dates.date',['value' => $date->date]);
            endforeach;
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
