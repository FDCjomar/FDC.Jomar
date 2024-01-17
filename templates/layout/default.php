<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <?= $this->Html->script('https://code.jquery.com/jquery-3.6.4.min.js') ?>
    <?= $this->Html->script('https://code.jquery.com/ui/1.12.1/jquery-ui.min.js') ?>
    <?= $this->Html->css('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
        <?php if (isset($checkAuth)): ?>
            <a href="<?= $this->Url->build('/Profiles') ?>"><span><?php echo h($checkAuth->name); ?></span></a>
        <?php endif; ?>
        </div>
        <div class="top-nav-links">
            <?php if (!isset($checkAuth)): ?>
                <a rel="noopener" href="<?= $this->Url->Build('users/login') ?>">Login</a>
                <a rel="noopener" href="<?= $this->Url->Build('users/add') ?>">Register</a>
            <?php else: ?>
                <a rel="noopener" href="<?= $this->Url->Build('users/login') ?>">Account</a>
                <a rel="noopener" href="<?= $this->Url->Build('/Profiles') ?>">Profile</a>
                <a rel="noopener" href="<?= $this->Url->Build('users/logout') ?>">Logout</a>
            <?php endif; ?>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
