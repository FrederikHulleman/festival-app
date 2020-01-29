<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Festival $festival
 */
?>
<div class="festivals form large-9 medium-8 columns content">
    <?= $this->Form->create($festival) ?>
    <fieldset>
        <legend><?= __('Edit Festival') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('description');
            foreach($dates as $key=>$date):
                switch ($key):
                    case 0:
                        $label = "Saturday";
                        break;
                    case 1:
                        $label = "Sunday";
                        break;
                    default:
                        $label = "Choose date";
                        break;
                endswitch;
                echo $this->Form->hidden('dates.'.$date->id.'.id',['value' => $date->id]);
                echo $this->Form->control('dates.'.$date->id.'.date',['label' => $label,'value' => $date->date]);
            endforeach;
            echo $this->Form->label('Start & end times both days');
            echo h($date->starttime->format("H:i A"))
                . " - " . h($date->endtime->format("H:i A"));

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
