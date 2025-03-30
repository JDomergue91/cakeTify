<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Artists Controller
 *
 * @property \App\Model\Table\ArtistsTable $Artists
 */
class ArtistsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        
        $query = $this->Artists->find();
        $artists = $this->paginate($query);

        $this->Authorization->skipAuthorization();

        $this->set(compact('artists'));
    }

    /**
     * View method
     *
     * @param string|null $id Artist id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $artist = $this->Artists->get($id, [
            'contain' => ['Albums', 'Favorites', 'Follows' => ['Users']]
        ]);
        $this->Authorization->authorize($artist);

        $isFavorite = false;
        $isFollowing = false;
        $userId = $this->request->getAttribute('identity')?->getIdentifier();

        if ($userId) {
            $isFollowing = collection($artist->follows)
                ->some(fn($f) => $f->user_id === $userId);
        }

        $userId = $this->request->getAttribute('identity')?->getIdentifier();

        if ($userId) {
            $isFavorite = collection($artist->favorites)
                ->some(fn($fav) => $fav->user_id === $userId);
        }

        $this->set(compact('artist', 'isFavorite', 'isFollowing'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $artist = $this->Artists->newEmptyEntity();
        $this->Authorization->authorize($artist, 'add');

        if ($this->request->is('post')) {
            $artist = $this->Artists->patchEntity($artist, $this->request->getData());
            if ($this->Artists->save($artist)) {
                $this->Flash->success(__('The artist has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The artist could not be saved. Please, try again.'));
        }
        $this->set(compact('artist'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Artist id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $artist = $this->Artists->get($id, contain: []);
        $this->Authorization->authorize($artist);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $artist = $this->Artists->patchEntity($artist, $this->request->getData());
            if ($this->Artists->save($artist)) {
                $this->Flash->success(__('The artist has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The artist could not be saved. Please, try again.'));
        }
        $this->set(compact('artist'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Artist id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $artist = $this->Artists->get($id);
        $this->Authorization->authorize($artist);

        if ($this->Artists->delete($artist)) {
            $this->Flash->success(__('The artist has been deleted.'));
        } else {
            $this->Flash->error(__('The artist could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        
        $this->Authentication->allowUnauthenticated(['view', 'index']);

        $this->Authorization->skipAuthorization();
    }
}
