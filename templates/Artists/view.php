<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Artist $artist
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>

            <?php if ($this->Identity->get('role') === 'admin') : ?>
                <?= $this->Html->link(__('Edit Artist'), ['action' => 'edit', $artist->id], ['class' => 'side-nav-item']) ?>
                <?= $this->Form->postLink(
                    __('Delete Artist'),
                    ['action' => 'delete', $artist->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $artist->id), 'class' => 'side-nav-item']
                ) ?>
            <?php endif; ?>

            <?= $this->Html->link(__('List Artists'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="artists view content">
            <div style="display: flex; gap: 1rem;" >
            <h3 style="white-space: nowrap;"><?= h($artist->name) ?></h3>
            <?php if ($this->Identity->isLoggedIn()) : ?>
                <div style="display: flex; gap: 1rem; width: 100%;">
                    <div style="margin-top: 0.15rem;">
                    <?= $this->Form->postLink(
                        $isFavorite ? __('Retirer des favoris') : __('Ajouter aux favoris'),
                        ['controller' => 'Favorites', 'action' => 'toggle', 'artist', $artist->id],
                        ['style' => 'font-size: 1rem; background: none; border: none;', 'escape' => false]
                    ) ?>
                    </div>
                    <div style="margin-left: auto;"><?= $this->Form->postLink(
                        $isFollowing ? 'Abonné' : 'S\'abonner',
                        ['controller' => 'Follows', 'action' => 'toggle', $artist->id],
                        ['class' => 'button']
                    ) ?>
                    </div>
                </div>
            <?php endif; ?>
            </div>

            <?php if (!empty($artist->spotify_link)) : ?>
                <div style="margin: 2rem 0;">
                    <iframe
                        src="<?= h($artist->spotify_link) ?>"
                        width="100%"
                        height="152"
                        frameborder="0"
                        allowtransparency="true"
                        allow="encrypted-media"
                        style="border-radius: 12px;"></iframe>
                </div>
            <?php endif; ?>

            <table>
                <tr><th><?= __('Name') ?></th><td><?= h($artist->name) ?></td></tr>
                <tr><th><?= __('Description') ?></th><td><?= h($artist->description) ?></td></tr>
                <!-- <tr><th><?= __('Created') ?></th><td><?= h($artist->created) ?></td></tr>
                <tr><th><?= __('Modified') ?></th><td><?= h($artist->modified) ?></td></tr> -->
            </table>

            <?php if (!empty($artist->albums)) : ?>
                <div class="related">
                    <h4><?= __('Albums') ?></h4>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Title') ?></th>
                                <th><?= __('Release Date') ?></th>
                                <th><?= __('Spotify') ?></th>
                                <?php if ($this->Identity->get('role') === 'admin') : ?>
                                    <th class="actions"><?= __('Actions') ?></th>
                                <?php endif; ?>
                            </tr>
                            <?php foreach ($artist->albums as $album): ?>
                                <tr>
                                    <td>
                                        <?= $this->Html->link($album->title, ['controller' => 'Albums', 'action' => 'view', $album->id]) ?>
                                    </td>
                                    <td><?= h($album->release_date) ?></td>
                                    <td>
                                        <?php if (!empty($album->spotify_link)) : ?>
                                            <iframe
                                                src="<?= h($album->spotify_link) ?>"
                                                width="250"
                                                height="80"
                                                frameborder="0"
                                                allowtransparency="true"
                                                allow="encrypted-media"
                                                style="border-radius: 8px;"></iframe>
                                        <?php endif; ?>
                                    </td>
                                    <?php if ($this->Identity->get('role') === 'admin') : ?>
                                        <td class="actions">
                                            <?= $this->Html->link(__('Edit'), ['controller' => 'Albums', 'action' => 'edit', $album->id]) ?>
                                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Albums', 'action' => 'delete', $album->id], [
                                                'confirm' => __('Are you sure?')
                                            ]) ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($artist->follows)) : ?>
                <div class="related">
                    <h4><?= __('Followed by') ?></h4>
                    <ul>
                        <?php foreach ($artist->follows as $follow): ?>
                            <li>
                                <?= $this->Html->link(
                                    h($follow->user->email ?? '[Deleted User]'),
                                    ['controller' => 'Users', 'action' => 'view', $follow->user_id]
                                ) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
