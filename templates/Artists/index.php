<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Artist> $artists
 */
?>
<div class="artists index content">
    <?php if ($this->Identity->get('role') === 'admin') : ?>
        <?= $this->Html->link(__('New Artist'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?php else : ?>
        <?= $this->Html->link(__('Request Artist'), ['controller' => 'Requests', 'action' => 'requestArtist', 'artist'], ['class' => 'button float-right']) ?>
    <?php endif; ?>

    <h3><?= __('Artists') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <!-- <th><?= $this->Paginator->sort('spotify_link') ?></th> -->
                    <!-- <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th> -->
                    <?php if ($this->Identity->get('role') === 'admin') : ?><th class="actions"><?= __('Actions') ?></th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artists as $artist): ?>
                    <tr>
                        <td><?= $this->Number->format($artist->id) ?></td>
                        <td>
                            <?= $this->Html->link(h($artist->name), ['action' => 'view', $artist->id]) ?>
                        </td>

                        <!-- <td><?= h($artist->spotify_link) ?></td> -->
                        <!-- <td><?= h($artist->created) ?></td>
                        <td><?= h($artist->modified) ?></td> -->
                        <?php if ($this->Identity->get('role') === 'admin') : ?>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $artist->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $artist->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $artist->id], [
                                    'confirm' => __('Are you sure you want to delete # {0}?', $artist->id),
                                ]) ?>
                            </td>
                        <?php endif; ?>

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