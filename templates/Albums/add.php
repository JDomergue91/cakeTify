<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Album $album
 * @var \Cake\Collection\CollectionInterface|string[] $artists
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Albums'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="albums form content">
            <?= $this->Form->create($album) ?>
            <fieldset>
                <legend><?= __('Add Album') ?></legend>
                <?php
                    echo $this->Form->control('title', ['label' => 'Titre']);
                    echo $this->Form->control('artist_id', ['options' => $artists, 'label' => 'Artiste']);
                    echo $this->Form->control('release_date', ['label' => 'Date de sortie']);
                    echo $this->Form->control('spotify_link', [
                        'label' => 'Link',
                        
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
