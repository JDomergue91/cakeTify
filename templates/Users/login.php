<div class="content">
    <h1>Login</h1>

    <?= $this->Form->create() ?>
    <?= $this->Form->control('email', ['label' => 'Email']) ?>
    <?= $this->Form->control('password', [
        'label' => 'Password',
        'type' => 'password'
    ]) ?>
    <?= $this->Form->button('Login') ?>
    <?= $this->Form->end() ?>

    <p><?= $this->Html->link('Inscription', ['action' => 'register']) ?></p>
</div>