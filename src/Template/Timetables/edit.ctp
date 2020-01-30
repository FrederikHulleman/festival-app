<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timetable $timetable
 */
?>
<div class="timetable form large-9 medium-8 columns content">
    <?= $this->Form->create($timetable) ?>
    <fieldset>
        <legend><?= __('Edit Timetable') ?></legend>
        <?php
            //debug($timetable);
            echo $this->Form->hidden('festival.id',['value' => $timetable->festival->id]);
            echo $this->Form->hidden('date.id',['value' => $timetable->date->id]);
            echo $this->Form->hidden('stage.id',['value' => $timetable->stage->id]);
            echo $this->Form->hidden('starttime',['value' => $timetable->starttime]);
            echo $this->Form->hidden('endtime',['value' => $timetable->endtime]);

            echo $this->Form->label('Timeslot');
            echo h($timetable->date->date->format('F jS, Y'))
                   . ": " . h($timetable->starttime->format("H:i A"))
                   . " - " . h($timetable->endtime->format("H:i A"));
            ?><br><br><?php
            echo $this->Form->label('Stage');
            echo h($timetable->stage->name);
            ?><br><br><?php
            echo $this->Form->label('Select band');

            if(!empty($timetable->band)) {
                $options = ['label' => 'Band','value' => $timetable->band_id, 'required' => true];
            }
            else {
                $options = ['label' => 'Band','empty' => '(select band)', 'required' => true];
            }
            echo $this->Form->select('band.id',
                                        $bands,
                                        $options
                                );
            ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
