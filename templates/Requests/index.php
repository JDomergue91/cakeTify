<div class="content">

    <h1>Requests</h1>
    <div style="display: flex; gap: 1rem; justify-content: flex-end;">
        <?php if ($this->Identity->get('role') === 'user'): ?>
            <?= $this->Html->link('Request Artist', ['controller' => 'Requests', 'action' => 'requestArtist'], ['class' => 'button']) ?>
        <?php endif; ?>

        <?php if ($this->Identity->get('role') === 'user'): ?>
            <?= $this->Html->link('Request Album', ['controller' => 'Requests', 'action' => 'requestAlbum'], ['class' => 'button']) ?>
        <?php endif; ?>
    </div>


    <table>
        <tr>
            <th>User</th>
            <th>Type</th>
            <th>Details</th>
            <th>Status</th>
            <?php if ($this->Identity->get('role') === 'admin'): ?><th>Actions</th><?php endif; ?>
        </tr>
        <?php foreach ($requests as $req): ?>

            <tr>
                <td><?= h($req->user->email) ?></td>
                <td><?= ucfirst(h($req->type)) ?></td>
                <td><?= nl2br(h($req->data)) ?></td>
                <td>
                    <span style="color: <?= $req->status === 'approved' ? 'green' : ($req->status === 'rejected' ? 'red' : 'blue') ?>;">
                        <?= ucfirst(h($req->status)) ?>
                    </span>
                </td>

                <?php if ($this->Identity->get('role') === 'admin'): ?><td style="display: flex; gap: 1rem;">
                        <?= $this->Form->postLink('Approve', ['action' => 'approve', $req->id]) ?>
                        <?= $this->Form->postLink('Reject', ['action' => 'reject', $req->id]) ?>
                        |
                        <?= $this->Form->postLink(
                            'Delete',
                            ['action' => 'delete', $req->id],
                            [
                                'confirm' => 'Are you sure you want to delete this request?',
                                'class' => 'link-button',
                            ]
                        ) ?>
                    </td><?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    <div>