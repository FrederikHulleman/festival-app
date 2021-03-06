<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timetable[]|\Cake\Collection\CollectionInterface $timetables
 */
?>
<div class="timetables index large-9 medium-8 columns content">
    <h3><?= __('Timetables') ?></h3>


    <?php foreach ($timetables as $date_key => $dates): ?>

        <h4><?= $dates['date']->format('F jS, Y'); ?></h4>

        <?php foreach ($dates as $stage_key => $stages): ?>

            <?php if ($stage_key !== 'date'): ?>

                <h5><?= $stages['stage']; ?></h5>

                 <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">Timeslot</th>
                            <th scope="col">Band</th>
                            <?php if (!empty($user)): ?>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($stages as $timetable_key => $timetable): ?>
                        <?php if ($timetable_key !== 'stage'): ?>
                            <tr>
                                <td><?= h($timetable['starttime']->format('H:i A')) ?>

                                <?php if ($timetable instanceof App\Model\Entity\Timetable): ?>

                                    <?= " - " . h($timetable->endtime->format('H:i A')) ?></td>
                                    <td><?= $this->Html->link($timetable->band->name, ['controller' => 'Bands', 'action' => 'view', $timetable->band->slug]) ?></td>
                                <?php else: ?>
                                    </td>
                                    <td>No band planned</td>
                                <?php endif; ?>

                                <?php if (!empty($user)): ?>
                                    <td class="actions">
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit',$timetable_key]) ?>
                                        <?php if ($timetable instanceof App\Model\Entity\Timetable):
                                            $message = $dates['date']->format('F jS, Y') . " - " . $stages['stage'] . " - " . $timetable['starttime']->format('H:i A');
                                            ?>
                                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete',$timetable_key], ['confirm' => __('Are you sure you want to delete the band for timeslot # {0}?', $message)]) ?>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>

                            </tr>

                        <?php endif; ?>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>



</div>
