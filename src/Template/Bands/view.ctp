<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Band $band
 */
?>
<div class="bands view large-9 medium-8 columns content">
    <h3><?= h($band->name) ?></h3>
    <div class="row">
        <?= $this->Text->autoParagraph(h($band->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Performs') ?></h4>
        <?php if (!empty($band->timetables)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Start') ?></th>
                <th scope="col"><?= __('End') ?></th>
                <th scope="col"><?= __('Stage') ?></th>
            </tr>
            <?php foreach ($band->timetables as $timetable): ?>
            <tr>
                <td><?= h($timetable->date->date->format('F jS, Y')) ?></td>
                <td><?= h($timetable->starttime->format('H:i A')) ?></td>
                <td><?= h($timetable->endtime->format('H:i A')) ?></td>
                <td><?= h($timetable->stage->name) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
