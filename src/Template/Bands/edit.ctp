<h1>Edit Band</h1>
<?php
    echo $this->Form->create($band);
    //echo $this->Form->control('user_id', ['type' => 'hidden']);
    echo $this->Form->control('name');
    echo $this->Form->control('description', ['rows' => '3']);
    echo $this->Form->button(__('Save Band'));
    echo $this->Form->end();
?>