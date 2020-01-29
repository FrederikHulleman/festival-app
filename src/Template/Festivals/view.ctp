<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Festival $festival
 */
//$this->extend('../Layout/dashboard');
?>
<div class="festivals view large-9 medium-8 columns content">
    <h3>VISITOR PAGE <?= h($festival->title) ?></h3>
    <div class="row">
        <?= $this->Text->autoParagraph(h($festival->description)); ?>
    </div>
    <div class="related">
        <?php if (!empty($festival->dates)): ?>
        <table cellpadding="0" cellspacing="0" class="table">
            <tr>
                <th scope="col"><?= __('Takes place on...') ?></th>
            </tr>
            <?php foreach ($festival->dates as $dates): ?>
            <tr>
                <td><?= $this->Html->link(
                                        __(h($dates->date->format('F jS, Y')
                                        . " " . $dates->starttime->format('H:i A')
                                        . " - " . $dates->endtime->format('H:i A'))
                                        ), ['controller' => 'Timetables', 'action' => 'index']) ?>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
