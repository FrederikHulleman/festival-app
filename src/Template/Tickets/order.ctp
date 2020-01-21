<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ticket $ticket
 */
?>
<div class="tickets form large-9 medium-8 columns content">
    <?= $this->Form->create($ticket) ?>
    <fieldset>
        <legend><?= __('Order Ticket') ?></legend>
        <?php
            echo $this->Form->control('visitor.email', ['type' => 'email']);
            echo $this->Form->control('dates._ids', ['options' => $dates]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
