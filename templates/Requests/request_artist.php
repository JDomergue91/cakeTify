<div class="content">
    <h1>Request Artist</h1>

    <?= $this->Form->create($request) ?>
    <fieldset>
        <?= $this->Form->control('data', [
            'label' => 'Artist Name',
            'type' => 'text',
            'required' => true
        ]) ?>
    </fieldset>

    <?= $this->Form->button('Send Request') ?>
    <?= $this->Form->end() ?>
</div>
