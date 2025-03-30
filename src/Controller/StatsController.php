<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Stats Controller
 *
 * @property \Authorization\Controller\Component\AuthorizationComponent $Authorization
 */
class StatsController extends AppController
{
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Authorization.Authorization');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        // Top 5 artistes les plus suivis
        $topFollowedArtists = $this->fetchTable('Artists')->find()
            ->select(['id', 'name', 'follow_count' => 'COUNT(Follows.id)'])
            ->leftJoinWith('Follows')
            ->groupBy(['Artists.id'])
            ->orderByDesc('follow_count')
            ->limit(5)
            ->all();

        // Top 5 artistes les moins suivis
        $leastFollowedArtists = $this->fetchTable('Artists')->find()
            ->select(['id', 'name', 'follow_count' => 'COUNT(Follows.id)'])
            ->leftJoinWith('Follows')
            ->groupBy(['Artists.id'])
            ->orderByAsc('follow_count')
            ->limit(5)
            ->all();

        // Top 5 albums les plus ajoutés en favoris
        $topFavoritedAlbums = $this->fetchTable('Albums')->find()
            ->select(['id', 'title', 'fav_count' => 'COUNT(Favorites.id)'])
            ->leftJoinWith('Favorites', function ($q) {
                return $q->where(['Favorites.favoritable_type' => 'album']);
            })
            ->groupBy(['Albums.id'])
            ->orderByDesc('fav_count')
            ->limit(5)
            ->all();

        // Top 5 albums les moins ajoutés en favoris
        $leastFavoritedAlbums = $this->fetchTable('Albums')->find()
            ->select(['id', 'title', 'fav_count' => 'COUNT(Favorites.id)'])
            ->leftJoinWith('Favorites', function ($q) {
                return $q->where(['Favorites.favoritable_type' => 'album']);
            })
            ->groupBy(['Albums.id'])
            ->orderByAsc('fav_count')
            ->limit(5)
            ->all();

        // Top 5 utilisateurs avec le plus de favoris
        $topUsersFavorites = $this->fetchTable('Users')->find()
            ->select(['id', 'email', 'fav_count' => 'COUNT(Favorites.id)'])
            ->leftJoinWith('Favorites')
            ->groupBy(['Users.id'])
            ->orderByDesc('fav_count')
            ->limit(5)
            ->all();

        $this->set(compact(
            'topFollowedArtists',
            'leastFollowedArtists',
            'topFavoritedAlbums',
            'leastFavoritedAlbums',
            'topUsersFavorites'
        ));
    }

    /**
     * View method
     *
     * @param string|null $id Stat id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stat = $this->Stats->get($id, contain: []);
        $this->Authorization->authorize($stat);
        $this->set(compact('stat'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stat = $this->Stats->newEmptyEntity();
        $this->Authorization->authorize($stat);
        if ($this->request->is('post')) {
            $stat = $this->Stats->patchEntity($stat, $this->request->getData());
            if ($this->Stats->save($stat)) {
                $this->Flash->success(__('The stat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stat could not be saved. Please, try again.'));
        }
        $this->set(compact('stat'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Stat id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stat = $this->Stats->get($id, contain: []);
        $this->Authorization->authorize($stat);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stat = $this->Stats->patchEntity($stat, $this->request->getData());
            if ($this->Stats->save($stat)) {
                $this->Flash->success(__('The stat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stat could not be saved. Please, try again.'));
        }
        $this->set(compact('stat'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Stat id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stat = $this->Stats->get($id);
        $this->Authorization->authorize($stat);
        if ($this->Stats->delete($stat)) {
            $this->Flash->success(__('The stat has been deleted.'));
        } else {
            $this->Flash->error(__('The stat could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
