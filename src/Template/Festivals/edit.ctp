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
            echo $this->Form->hidden('dates.'.$date->id .'.id',['value' => $date->id]);
            switch ($key):
                case 0:
                    echo $this->Form->label('Start & end times both days');
                    echo h($date->starttime->format("H:i A"))
                        . " - " . h($date->endtime->format("H:i A"));
                    echo "<br><br>";
                    echo $this->Form->control('dates.'.$date->id.'.date',['type' => 'text','label'=>'Select a saturday','value' => $date->date,'class'=>'saturday']);
                    break;
                case 1:
                    echo $this->Form->control('dates.'.$date->id.'.date',['type' => 'text','label'=>'... and a sunday','value' => $date->date,'class'=>'sunday']);
                    break;
            endswitch;

        endforeach;

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<script>
    var dateFormat = 'yy-mm-dd';

    $( function() {
        $( ".saturday" ).datepicker({'dateFormat':'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            minDate: "-8D",
            maxDate: "+5Y",
            beforeShowDay: function(date){
                if(date.getDay() == 6){
                    return [true];
                } else {
                    return [false];
                }
            }
        });
    } );

    $( ".saturday" ).change(function() {
        var newDate = $(".saturday").datepicker('getDate');
        newDate.setDate(newDate.getDate()+1); //add one day
        $(".sunday").datepicker('setDate',newDate);
    });

    $( function() {
        $( ".sunday" ).datepicker({'dateFormat':'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            minDate: "-8D",
            maxDate: "+5Y",
            beforeShowDay: function(date){
                if(date.getDay() == 0){
                    return [true];
                } else {
                    return [false];
                }
            }
        });
    } );

    $( ".sunday" ).change(function() {
        var newDate = $(".sunday").datepicker('getDate');
        newDate.setDate(newDate.getDate()-1); //substract one day
        $(".saturday").datepicker('setDate',newDate);
    });
</script>
