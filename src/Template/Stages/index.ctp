<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Stage[]|\Cake\Collection\CollectionInterface $stages
 */
?>

<div class="stages index large-9 medium-8 columns content">
    <h3><?= __('Stages') ?></h3>
    <?php if (!empty($user)): ?>
    <p><?= $this->Html->link(__('New stage'), ['controller' => 'Stages', 'action' => 'add']) ?> </p>
    <?php endif; ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <?php if (!empty($user)): ?>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stages as $stage): ?>
            <tr>
                <td><?= $this->Html->link(__($stage->name), ['action' => 'view', $stage->slug]) ?></td>
                <?php if (!empty($user)): ?>
                <td class="actions">

                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $stage->slug]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $stage->slug], ['confirm' => __('Are you sure you want to delete # {0}?', $stage->slug)]) ?>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
