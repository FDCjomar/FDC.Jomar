<?php echo $this->Html->css('profile', ['block' => 'css']); ?>

<section>
    <div class="header-page"><h1>Edit User Profile</h1></div>
    
    <div class="row">
        <div class="column">
        <?php $imageUrl = $this->Url->image('default-pic.png', ['fullBase' => true]); ?>
        <?= $this->Html->image($imageUrl, ['alt' => 'User Profile Image']) ?>
        </div>
        
        <div class="column user-data">
            <?= $this->Form->label('profile_img', 'Profile Image') ?>
            <?= $this->Form->file('profile_img') ?>
        </div>
    </div>
    
    <div class="row">
        
        <fieldset>
            <?= $this->Form->control('name', ['label' => 'Name'])?>
            <?= $this->Form->control('birthdate', ['label' => 'Birthdate', 'id' => 'birthdate'])?>
            <?= $this->Form->label('gender', 'Gender')?>
            <?= $this->Form->radio('gender', ['M' => 'Male', 'F' => 'Female'])?>
            <?= $this->Form->label('hobby', 'Hubby') ?>
            <?= $this->Form->textarea('hobby', ['rows' => '10', 'cols' => '50'])?>
       </fieldset>
    </div>
    <div class="row">
        <a href="">Edit Profile</a>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('#birthdate').datepicker({
            dateFormat: 'yy-mm-dd', 
            changeMonth: true,
            changeYear: true,
            yearRange: '1900:' + new Date().getFullYear() 
        });
    });
</script>