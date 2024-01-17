<?php echo $this->Html->css('profile', ['block' => 'css']); ?>
<section>
    <div class="header-page"><h1>User Profile</h1></div>
    <div class="row">
        <div class="column">
    <?php if(isset($user->profile_img)): ?>
    <?php
    // Append a query parameter with the current timestamp to the image URL
    $imageUrl = $this->Url->image('uploads/' . $user->profile_img, [
        'fullBase' => true,
        'timestamp' => true,
    ]);
    ?>
    <?= $this->Html->image($imageUrl, ['alt' => 'User Profile Image']) ?>
<?php else: ?>
    <?php $imageUrl = $this->Url->image('default-pic.png', ['fullBase' => true]); ?>
    <?= $this->Html->image($imageUrl, ['alt' => 'User Profile Image']) ?>
<?php endif; ?>
        </div>
        <div class="column user-data">
            <p class="profile-name"><?= $user->name ?></p>
            <p class="gender"><span>Gender: </span> July 13, 1995</p>
            <p class="joined"><span>Joined: </span> August 13, 2014 9am</p>
            <p class="last-login"><span>Last Login: </span> August 14, 2014 11am</p>
        </div>
    </div>
    <div class="row">
        <div class="hubby">
        <p class="hubby-header">Hubby</p>
       <p><?= $user->hobby ?></p>
        </div>
    </div>
    <div class="row">
        <a href="<?= $this->Url->Build('/Profiles/edit') ?>">Edit Profile</a>
    </div>
</section>