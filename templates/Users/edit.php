<h1>Modifier l’utilisateur #<?= h($user->id) ?></h1>

<?= $this->Form->create($user) ?>
<?= $this->Form->control('email', ['label' => 'Adresse e-mail']) ?>
<?= $this->Form->control('password', [
    'label' => 'Mot de passe',
    'type' => 'password',
    'value' => ''
]) ?>
<?= $this->Form->control('role', [
    'label' => 'Rôle',
    'options' => ['user' => 'Utilisateur', 'admin' => 'Administrateur']
]) ?>
<?= $this->Form->button('Mettre à jour') ?>
<?= $this->Form->end() ?>

<p><?= $this->Html->link('Retour à la liste', ['action' => 'index']) ?></p>
