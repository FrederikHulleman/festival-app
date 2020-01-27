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
            echo $this->Form->label('Timeslot');
            echo h($timetable->date->date->format('F jS, Y'))
                   . ": " . h($timetable->starttime->format("H:i A"))
                   . " - " . h($timetable->endtime->format("H:i A"));
            ?><br><br><?php
            echo $this->Form->label('Select band');

            if(!empty($timetable->band)) {
                $options = ['value' => $timetable->band_id];
            }
            else {
                $options = ['empty' => '(select band)'];
            }

            echo $this->Form->select('bands.name',
                                        $bands,
                                        $options
                                );
            ?><br><br><?php
            echo $this->Form->label('Select stage');

            if(!empty($timetable->stage)) {
                $options = ['value' => $timetable->stage_id];
            }
            else {
                $options = ['empty' => '(select stage)'];
            }

            echo $this->Form->select('stages.name',
                                            $stages,
                                            $options
                                    );
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
