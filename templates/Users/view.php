<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<?php
$isOwnProfile = $this->Identity->get('id') === $user->id;
$isAdmin = $this->Identity->get('role') === 'admin';
?>

<div class="row">
    <?php if ($isAdmin): ?>
        <aside class="column">
            <div class="side-nav">
                <h4 class="heading"><?= __('Actions') ?></h4>
                <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
                <?= $this->Form->postLink(
                    __('Delete User'),
                    ['action' => 'delete', $user->id],
                    [
                        'confirm' => __('Are you sure you want to delete # {0}?', $user->id),
                        'class' => 'side-nav-item'
                    ]
                ) ?>
                <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            </div>
        </aside>
    <?php endif; ?>

    <div class="column <?= $isAdmin ? 'column-80' : 'column-100' ?>">
        <div class="users view content">
            <h3><?= h($user->email) ?></h3>
            <table>
                <tr>
                    <th><?= __('ID') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= h($user->role) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= $this->Time->format($user->created, 'dd/MM/yyyy') ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= $this->Time->format($user->modified, 'dd/MM/yyyy') ?></td>
                </tr>
            </table>

            <?php if (!empty($user->favorites)) : ?>
                <div class="related">
                    <h4><?= __('Favorites') ?></h4>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Type') ?></th>
                                <th><?= __('Name') ?></th>
                                <th><?= __('Added on') ?></th>
                            </tr>
                            <?php foreach ($user->favorites as $favorite) : ?>
                                <tr>
                                    <td><?= ucfirst(h($favorite->favoritable_type)) ?></td>
                                    <td>
                                        <?php if ($favorite->favoritable_type === 'artist') : ?>
                                            <?= $this->Html->link(
                                                h($favorite->artist->name ?? '[Deleted Artist]'),
                                                ['controller' => 'Artists', 'action' => 'view', $favorite->favoritable_id]
                                            ) ?>
                                        <?php elseif ($favorite->favoritable_type === 'album') : ?>
                                            <?= $this->Html->link(
                                                h($favorite->album->title ?? '[Deleted Album]'),
                                                ['controller' => 'Albums', 'action' => 'view', $favorite->favoritable_id]
                                            ) ?>
                                        <?php else: ?>
                                            <?= '[Unknown object]' ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $this->Time->format($favorite->created, 'dd/MM/yyyy') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($user->follows)) : ?>
                <div class="related">
                    <h4><?= __('Followed Artists') ?></h4>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Artist') ?></th>
                                <th><?= __('Since') ?></th>
                            </tr>
                            <?php foreach ($user->follows as $follow) : ?>
                                <tr>
                                    <td>
                                        <?= $this->Html->link(
                                            h($follow->artist->name ?? '[Deleted Artist]'),
                                            ['controller' => 'Artists', 'action' => 'view', $follow->artist_id]
                                        ) ?>
                                    </td>
                                    <td><?= $this->Time->format($follow->created, 'dd/MM/yyyy') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($user->requests)): ?>
                <div class="related">
                    <h4><?= __('Related Requests') ?></h4>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('ID') ?></th>
                                <th><?= __('Type') ?></th>
                                <th><?= __('Status') ?></th>
                                <th><?= __('Created') ?></th>
                            </tr>
                            <?php foreach ($user->requests as $request): ?>
                                <tr>
                                    <td><?= h($request->id) ?></td>
                                    <td><?= h($request->type) ?></td>
                                    <td><?= h($request->status) ?></td>
                                    <td><?= $this->Time->format($request->created, 'dd/MM/yyyy') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    table  {
        display: flex;
        justify-content: space-between;
    }
    table th,
    table td {
        width: 250px;
        text-align: left;
        box-sizing: border-box;
    }

    .table-responsive th:first-child,
    .table-responsive td:first-child {
        width: 250px;
    }

    .table-responsive table {
        border-collapse: collapse;
        width: 100%;
    }

</style>
