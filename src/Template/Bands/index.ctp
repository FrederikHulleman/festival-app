<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Band[]|\Cake\Collection\CollectionInterface $bands
 */
?>
<div class="bands index large-9 medium-8 columns content">
    <h3><?= __('Bands') ?></h3>
    <?php if (!empty($user)): ?>
    <p><?= $this->Html->link(__('New Band'), ['action' => 'add']) ?></p>
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
            <?php foreach ($bands as $band): ?>
            <tr>
                <td><?= $this->Html->link(__(h($band->name)), ['action' => 'view', $band->slug]) ?></td>
                <?php if (!empty($user)): ?>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $band->slug]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $band->slug], ['confirm' => __('Are you sure you want to delete # {0}?', $band->slug)]) ?>
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
