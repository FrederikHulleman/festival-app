<h1>Add Band</h1>
<?php
    echo $this->Form->create($band);
    // Hard code the user for now.
    //echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
    echo $this->Form->control('name');
    echo $this->Form->control('description', ['rows' => '3']);
    echo $this->Form->button(__('Save Band'));
    echo $this->Form->end();
?>