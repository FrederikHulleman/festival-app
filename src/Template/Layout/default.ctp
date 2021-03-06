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
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><?= $this->Html->link(__('Home'), ['controller' => 'Festivals', 'action' => 'view']) ?></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <?php
                    if (!empty($user)):?>
                    <li><?= $this->Html->link(__($user['email']), ['controller' => 'Users', 'action' => 'index']); ?></li>
                <?php endif; ?>
                <li>
                    <?php
                    if (!empty($user)):
                        echo $this->Html->link(__('logout'), ['controller' => 'Users', 'action' => 'logout']);
                    else:
                        echo $this->Html->link(__('login'), ['controller' => 'Users', 'action' => 'login']);
                    endif;
                    ?> </li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <nav class="large-3 medium-4 columns" id="actions-sidebar">
            <ul class="side-nav">
                <?php if (!empty($user)): ?>
                    <li><?= $this->Html->link(__('Edit festival info'), ['controller' => 'Festivals', 'action' => 'edit']) ?> </li>
                    <li><?= $this->Html->link(__('Edit bands'), ['controller' => 'Bands', 'action' => 'index']) ?> </li>
                    <li><?= $this->Html->link(__('Edit stages'), ['controller' => 'Stages', 'action' => 'index']) ?> </li>
                    <li><?= $this->Html->link(__('Edit timetables'), ['controller' => 'Timetables', 'action' => 'index']) ?> </li>
                    <li><?= $this->Html->link(__('Edit users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>

                <?php else: ?>
                    <li><?= $this->Html->link(__('Order Ticket'), ['controller' => 'Tickets', 'action' => 'order']) ?> </li>
                    <li><?= $this->Html->link(__('Bands'), ['controller' => 'Bands', 'action' => 'index']) ?> </li>
                    <li><?= $this->Html->link(__('Stages'), ['controller' => 'Stages', 'action' => 'index']) ?> </li>
                    <li><?= $this->Html->link(__('Timetables'), ['controller' => 'Timetables', 'action' => 'index']) ?> </li>
                <?php endif ?>
            </ul>
        </nav>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
