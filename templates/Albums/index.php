<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Album> $albums
 */
?>
<div class="albums index content">
    <?php if ($this->Identity->get('role') === 'admin') : ?>
        <?= $this->Html->link(__('New Album'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?php else : ?>
        <?= $this->Html->link(__('Request Album'), ['controller' => 'Requests', 'action' => 'requestAlbum', 'album'], ['class' => 'button float-right']) ?>
    <?php endif; ?>

    <h3><?= __('Albums') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('artist_id', 'Artist') ?></th>
                    <th><?= $this->Paginator->sort('release_date') ?></th>
                    <!-- <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th> -->
                    <?php if ($this->Identity->get('role') === 'admin') : ?>
                        <th class="actions"><?= __('Actions') ?></th>
                    <?php endif; ?>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($albums as $album): ?>
                    <tr>
                        <td><?= $this->Number->format($album->id) ?></td>
                        <td>
                            <?= $this->Html->link(h($album->title), ['action' => 'view', $album->id]) ?>
                        </td>

                        <td>
                            <?= $album->artist ? $this->Html->link(h($album->artist->name), ['controller' => 'Artists', 'action' => 'view', $album->artist->id]) : '' ?>
                        </td>
                        <td><?= $this->Time->format($album->release_date, 'dd/MM/yyyy') ?></td>
                        <!-- <td><?= h($album->created) ?></td>
                        <td><?= h($album->modified) ?></td> -->
                        <?php if ($this->Identity->get('role') === 'admin') : ?>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $album->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $album->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $album->id], [
                                    'confirm' => __('Are you sure you want to delete # {0}?', $album->id),
                                ]) ?>
                            </td>
                        <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>