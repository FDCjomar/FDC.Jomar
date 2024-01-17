<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<style>
    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb;
        border-radius: 5px;
    }

    .error-message {
        margin-bottom: 5px;
    }
</style>
<div class="row">
    <div class="column column-80">
        <div class="users form content">
        <div class="error-messages">
            
            <div id="validation-errors-container"></div>

            <?php foreach ($user->getErrors() as $field => $errors): ?>
                <?php foreach ($errors as $error): ?>
                    <div class="error-message"><?= $error ?></div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
        <?= $this->Form->create($user, ['id' => 'register-form']) ?>
    <fieldset>
        <legend><?= __('Registration') ?></legend>
        <?php
            echo $this->Form->control('name', ['label' => 'Name', 'error' => false, 'required' => false]);
            echo $this->Form->control('email', ['label' => 'Email', 'error' => false, 'required' => false]);
            echo $this->Form->control('password', ['label' => 'Password', 'error' => false, 'required' => false]);
            echo $this->Form->control('confirm_password', ['label' => 'Confirm Password', 'type' => 'password', 'error' => false, 'required' => false]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['id' => 'submit-btn']) ?>
<?= $this->Form->end() ?>
        </div>
    </div>
</div>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js') ?>
<script>

</script>

