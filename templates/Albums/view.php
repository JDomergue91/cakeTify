<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Album $album
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>

            <?php if ($this->Identity->get('role') === 'admin') : ?>
                <?= $this->Html->link(__('Edit Album'), ['action' => 'edit', $album->id], ['class' => 'side-nav-item']) ?>
                <?= $this->Form->postLink(
                    __('Delete Album'),
                    ['action' => 'delete', $album->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $album->id), 'class' => 'side-nav-item']
                ) ?>
            <?php endif; ?>

            <?= $this->Html->link(__('List Albums'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="albums view content">
            <div style="display: flex; gap: 1rem;">
            <h3><?= h($album->title) ?></h3>
            <?php if ($this->Identity->isLoggedIn()) : ?>
                <div style="margin-top: 0.15rem;">
                <?= $this->Form->postLink(
                        $isFavorite ? __('Retirer des favoris') : __('Ajouter aux favoris'),
                        ['controller' => 'Favorites', 'action' => 'toggle', 'artist', $artist->id],
                        ['style' => 'font-size: 1rem; background: none; border: none;', 'escape' => false]
                    ) ?>
                </div>
            <?php endif; ?>
            </div>

            <?php if (!empty($album->spotify_link)) : ?>
                <div style="margin: 2rem 0;">
                    <iframe
                        src="<?= h($album->spotify_link) ?>"
                        width="100%"
                        height="152"
                        frameborder="0"
                        allowtransparency="true"
                        allow="encrypted-media"
                        style="border-radius: 12px;"></iframe>
                </div>
            <?php endif; ?>

            

            <table>
                <tr><th><?= __('Title') ?></th><td><?= h($album->title) ?></td></tr>
                <tr><th><?= __('Artist') ?></th>
                    <td>
                        <?= $album->artist ? $this->Html->link($album->artist->name, ['controller' => 'Artists', 'action' => 'view', $album->artist->id]) : '' ?>
                    </td>
                </tr>
                <tr><th><?= __('Release Date') ?></th><td><?= $this->Time->format($album->release_date, 'dd/MM/yyyy') ?></td></tr>
                <!-- <tr><th><?= __('Created') ?></th><td><?= h($album->created) ?></td></tr>
                <tr><th><?= __('Modified') ?></th><td><?= h($album->modified) ?></td></tr> -->
            </table>
        </div>
    </div>
</div>
