<?php echo $this->Html->css('profile', ['block' => 'css']); ?>

<section>
    <div class="header-page"><h1>User Profile</h1></div>
    <div class="row">
        <div class="column">
        <?php $imageUrl = $this->Url->image('default-pic.png', ['fullBase' => true]); ?>
        <?= $this->Html->image($imageUrl, ['alt' => 'User Profile Image']) ?>
        </div>
        <div class="column user-data">
            <p class="profile-name">Lisa, Cruz 19</p>
            <p class="gender"><span>Gender: </span> July 13, 1995</p>
            <p class="joined"><span>Joined: </span> August 13, 2014 9am</p>
            <p class="last-login"><span>Last Login: </span> August 14, 2014 11am</p>
        </div>
    </div>
    <div class="row">
        <div class="hubby">
        <p class="hubby-header">Hubby</p>
       <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem esse perspiciatis fuga quidem debitis? At rem impedit accusamus, odit laudantium numquam ratione eaque debitis similique quo, reprehenderit eligendi esse corporis!</p>
        </div>
    </div>
    <div class="row">
        <a href="<?= $this->Url->Build('/Profiles/edit') ?>">Edit Profile</a>
    </div>
</section>