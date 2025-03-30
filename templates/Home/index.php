<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Artist[] $lastArtists
 */
?>
<div class="home content">
    <h2><?= __('Last added artists') ?></h2>

    <?php if (!empty($lastArtists)) : ?>
        <div class="artist-list" style="display: grid; gap: 2rem;">
            <?php foreach ($lastArtists as $artist): ?>
                <div class="artist-card">
                    <h4><?= $this->Html->link($artist->name, ['controller' => 'Artists', 'action' => 'view', $artist->id]) ?></h4>
                    <?php if (!empty($artist->spotify_link)) : ?>
                        <iframe
                            src="<?= h($artist->spotify_link) ?>"
                            width="100%"
                            height="152"
                            frameborder="0"
                            allowtransparency="true"
                            allow="encrypted-media"
                            style="border-radius: 12px;"
                        ></iframe>
                    <?php else: ?>
                        <p><?= __('No Spotify link provided.') ?></p>
                    <?php endif; ?>
                    <p><small><?= __('Added on') ?>: <?= h($artist->created->format('d/m/Y')) ?></small></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p><?= __('No artists found.') ?></p>
    <?php endif; ?>
</div>
