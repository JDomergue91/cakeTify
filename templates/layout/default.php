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
    <?php echo $this->Html->css('https://fonts.googleapis.com/css2?family=Poppins&display=swap', ['block' => true]); ?>
    <?php echo $this->Html->css('https://fonts.googleapis.com/css2?family=Gidole&family=Roboto+Slab:wght@100..900&display=swap', ['block' => true]); ?>

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>">CAKETIFY</a>
        </div>
        <div class="top-nav-links">
            <ul style="list-style: none; display: flex; gap: 1rem; align-items: center; margin: 0; padding: 0;">
                <li><?= $this->Html->link('Home', ['controller' => 'Home', 'action' => 'index']) ?></li>

                <?php if ($this->Identity->get('role') === 'admin') : ?>
                    <li><?= $this->Html->link('Users', ['controller' => 'Users', 'action' => 'index']) ?></li>
                <?php endif; ?>

                <li><?= $this->Html->link('Artists', ['controller' => 'Artists', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link('Albums', ['controller' => 'Albums', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link('Stats', ['controller' => 'Stats', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
                <li><?= $this->Html->link('Requests', ['controller' => 'Requests', 'action' => 'index']) ?></li>
                <?php if ($this->Identity->isLoggedIn()): ?>
                    <li>
                        <?= $this->Html->link(
                            h($this->Identity->get('email')),
                            ['controller' => 'Users', 'action' => 'view', $this->Identity->get('id')],
                            ['style' => 'color: var(--color-cakephp-blue);']
                        ) ?>
                    </li>
                <?php endif; ?>

                <?php if ($this->Identity->isLoggedIn()): ?>
                    <li>
                        <?= $this->Form->postLink('Logout', ['controller' => 'Users', 'action' => 'logout'], ['confirm' => 'Se déconnecter ?']) ?>

                    </li>
                <?php else: ?>
                    <li style="margin-left: auto;">
                        <?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login']) ?>
                    </li>
                <?php endif; ?>
            </ul>
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