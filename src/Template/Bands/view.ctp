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
        <h4><?= __('Related Timetable') ?></h4>
        <?php if (!empty($band->timetable)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Starttime') ?></th>
                <th scope="col"><?= __('Endtime') ?></th>
                <th scope="col"><?= __('Stage') ?></th>
            </tr>
            <?php foreach ($band->timetable as $timetable): ?>
            <tr>
                <td><?= h($timetable->date_id) ?></td>
                <td><?= h($timetable->starttime) ?></td>
                <td><?= h($timetable->endtime) ?></td>
                <td><?= h($timetable->stage_id) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
