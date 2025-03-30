<div class="content">
    <h1>Request Album</h1>

    <?= $this->Form->create($request) ?>
    <fieldset>
        <legend><?= __('Album Information') ?></legend>

        <?= $this->Form->control('album_title', [
            'label' => 'Title',
            'required' => true
        ]) ?>

        <?= $this->Form->control('album_artist', [
            'label' => 'Artist',
            'required' => true
        ]) ?>
    </fieldset>

    <?= $this->Form->button('Send Request') ?>
    <?= $this->Form->end() ?>
</div>
