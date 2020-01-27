<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timetable[]|\Cake\Collection\CollectionInterface $timetables
 */
?>
<div class="timetables index large-9 medium-8 columns content">
    <h3><?= __('Timetables') ?></h3>

    <?php foreach ($timetables as $dates): ?>

         <h4><?= $dates['date']->format('F jS, Y') ?></h4>

         <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col">Start</th>
                    <th scope="col">End</th>
                    <th scope="col">Band</th>
                    <th scope="col">Stage</th>
                    <?php if (!empty($user)): ?>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>

            <?php foreach ($dates as $key => $timetable): ?>
                <?php if ($key !== 'date'): ?>
                    <tr>
                        <td><?= h($timetable['starttime']->format('H:i A')) ?></td>

                        <?php if ($timetable instanceof App\Model\Entity\Timetable): ?>

                            <td><?= h($timetable->endtime->format('H:i A')) ?></td>
                            <td><?= $this->Html->link($timetable->band->name, ['controller' => 'Bands', 'action' => 'view', $timetable->band->slug]) ?></td>
                            <td><?= h($timetable->stage->name) ?></td>
                        <?php else: ?>
                            <td>&nbsp;</td>
                            <td colspan=2>No band planned</td>
                        <?php endif; ?>

                        <?php if (!empty($user)): ?>
                            <td class="actions">
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete'], ['confirm' => __('Are you sure you want to delete # {0}?')]) ?>
                            </td>
                        <?php endif; ?>

                    </tr>

                <?php endif; ?>

            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endforeach; ?>



</div>
