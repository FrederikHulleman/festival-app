<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timetable[]|\Cake\Collection\CollectionInterface $timetables
 */
?>
<div class="timetables index large-9 medium-8 columns content">
    <h3><?= __('Timetables') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('starttime') ?></th>
                <th scope="col"><?= $this->Paginator->sort('endtime') ?></th>
                <th scope="col"><?= $this->Paginator->sort('band_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stage_slug') ?></th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($timetables as $dates): ?>
            
            <tr>
                <td colspan=4><?= $dates['date']->format('F jS, Y') ?></td>
            </tr>
                <?php foreach ($dates as $key => $timetable): 
                    
                    ?>
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
                            
                        </tr>
                    
                    <?php endif; ?>
                
                <?php endforeach; ?> 
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
