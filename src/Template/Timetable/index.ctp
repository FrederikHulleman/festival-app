<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timetable[]|\Cake\Collection\CollectionInterface $timetable
 */
?>
<div class="timetable index large-9 medium-8 columns content">
    <h3><?= __('Timetable') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('band_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_slug') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stage_slug') ?></th>
                <th scope="col"><?= $this->Paginator->sort('starttime') ?></th>
                <th scope="col"><?= $this->Paginator->sort('endtime') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($timetable_grouped_by_date as $timetable): ?>
            <tr>
                <td><?= $timetable->has('band') ? $this->Html->link($timetable->band->name, ['controller' => 'Bands', 'action' => 'view', $timetable->band->slug]) : '' ?></td>
                <td><?= h($timetable->date->slug) ?></td>
                <td><?= h($timetable->stage->name) ?></td>
                <td><?= h($timetable->starttime) ?></td>
                <td><?= h($timetable->endtime) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
