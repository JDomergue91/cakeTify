<div class="content">
    <h1>Sign up</h1>

    <?= $this->Form->create($user) ?>
    <?= $this->Form->control('username', ['label' => 'Username']) ?>
    <?= $this->Form->control('email') ?>
    <?= $this->Form->control('password') ?>
    <?= $this->Form->button(__('Register')) ?>
<?= $this->Form->end() ?>

<?php if ($user->getErrors()): ?>
    <div class="error-messages">
        <?php foreach ($user->getErrors() as $field => $errors): ?>
            <p><?= h($field) ?>: <?= implode(', ', $errors) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

    <p><?= $this->Html->link('Connexion', ['action' => 'login']) ?></p>
</div>