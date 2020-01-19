<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Band[]|\Cake\Collection\CollectionInterface $bands
 */
?>
<div class="bands index large-9 medium-8 columns content">
    <h3><?= __('Bands') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bands as $band): ?>
            <tr>
                <td><?= $this->Html->link(__(h($band->name)), ['action' => 'view', $band->slug]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
