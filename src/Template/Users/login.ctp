<div class="users form large-9 medium-8 columns content">
    <h1>Login</h1>
    <fieldset>
        <?= $this->Form->create() ?>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password') ?>
        <?= $this->Form->button('Login') ?>
        <?= $this->Form->end() ?>
    </fieldset>
</div>
