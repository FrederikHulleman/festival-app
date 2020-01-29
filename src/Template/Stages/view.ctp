<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Stage $stage
 */
?>
<div class="stages view large-9 medium-8 columns content">
    <h3><?= h($stage->name) ?></h3>
    <?php if (!empty($stage->timetables)): ?>
    <div class="related">
        <h4><?= __('Performances') ?></h4>

        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Starttime') ?></th>
                <th scope="col"><?= __('Endtime') ?></th>
                <th scope="col"><?= __('Band') ?></th>
            </tr>
            <?php foreach ($stage->timetables as $timetables): ?>
            <tr>
                <td><?= h($timetables->date->date->format('F jS, Y')) ?></td>
                <td><?= h($timetables->starttime->format('H:i A')) ?></td>
                <td><?= h($timetables->endtime->format('H:i A')) ?></td>
                <td><?= h($timetables->band->name) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

    </div>
    <?php endif; ?>
</div>
