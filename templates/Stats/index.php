<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="stats index content">
    <h1>Stats</h1>

    <h2>Artiste le plus suivi</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Nombre de Suivis</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topFollowedArtists as $artist): ?>
                    <tr>
                        <td>
                            <?= $this->Html->link(h($artist->name), ['controller' => 'Artists', 'action' => 'view', $artist->id]) ?>
                        </td>
                        <td style="text-align: left;"><?= h($artist->follow_count) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h2>Artistes les moins suivis</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Nombre de Suivis</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leastFollowedArtists as $artist): ?>
                    <tr>
                        <td>
                            <?= $this->Html->link(h($artist->name), ['controller' => 'Artists', 'action' => 'view', $artist->id]) ?>
                        </td>
                        <td style="text-align: left;"><?= h($artist->follow_count) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h2>Albums les plus aimés</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Nombre de Favoris</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topFavoritedAlbums as $album): ?>
                    <tr>
                        <td>
                            <?= $this->Html->link(h($album->title), ['controller' => 'Albums', 'action' => 'view', $album->id]) ?>
                        </td>
                        <td style="text-align: left;"><?= h($album->fav_count) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h2>Albums les moins aimés</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Nombre de Favoris</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leastFavoritedAlbums as $album): ?>
                    <tr>
                        <td>
                            <?= $this->Html->link(h($album->title), ['controller' => 'Albums', 'action' => 'view', $album->id]) ?>
                        </td>
                        <td style="text-align: left;"><?= h($album->fav_count) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h2>Utilisateurs avec le plus de favoris</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Favoris</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topUsersFavorites as $user): ?>
                    <tr>
                        <td><?= h($user->email) ?></td>
                        <td style="text-align: left;"><?= h($user->fav_count) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
