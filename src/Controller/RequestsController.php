<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Requests Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 */
class RequestsController extends AppController
{
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $query = $this->Requests->find()->contain(['Users']);
        $requests = $this->paginate($query);

        $this->set(compact('requests'));
    }

    public function view($id = null)
    {
        $request = $this->Requests->get($id, contain: ['Users']);
        $this->Authorization->authorize($request);

        $this->set(compact('request'));
    }

    public function add()
    {
        $request = $this->Requests->newEmptyEntity();
        $this->Authorization->authorize($request);

        if ($this->request->is('post')) {
            $request = $this->Requests->patchEntity($request, $this->request->getData());
            if ($this->Requests->save($request)) {
                $this->Flash->success(__('The request has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request could not be saved. Please, try again.'));
        }

        $users = $this->Requests->Users->find('list', limit: 200)->all();
        $this->set(compact('request', 'users'));
    }

    public function edit($id = null)
    {
        $request = $this->Requests->get($id, contain: []);
        $this->Authorization->authorize($request);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $request = $this->Requests->patchEntity($request, $this->request->getData());
            if ($this->Requests->save($request)) {
                $this->Flash->success(__('The request has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request could not be saved. Please, try again.'));
        }

        $users = $this->Requests->Users->find('list', limit: 200)->all();
        $this->set(compact('request', 'users'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $request = $this->Requests->get($id);
        $this->Authorization->authorize($request);

        if ($this->Requests->delete($request)) {
            $this->Flash->success(__('The request has been deleted.'));
        } else {
            $this->Flash->error(__('The request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function requestArtist()

    {
        $request = $this->Requests->newEmptyEntity();
        $this->Authorization->skipAuthorization();


        if ($this->request->is('post')) {
            $request = $this->Requests->patchEntity($request, $this->request->getData());

            $request->user_id = $this->Authentication->getIdentity()->get('id');
            $request->type = 'artist';
            $request->status = 'pending';

            $this->Authorization->authorize($request);

            if ($this->Requests->save($request)) {
                $this->Flash->success(__('Your request has been sent.'));
                return $this->redirect(['controller' => 'Requests', 'action' => 'index']);
            }

            $this->Flash->error(__('Error, please try again.'));
        }

        $this->set(compact('request'));
    }


    public function requestAlbum()
{
    $this->Authorization->skipAuthorization();

    $request = $this->Requests->newEmptyEntity();

    if ($this->request->is('post')) {
        $title = $this->request->getData('album_title');
        $artist = $this->request->getData('album_artist');

        $request->type = 'album';
        $request->data = "Title: $title\nArtist: $artist";
        $request->user_id = $this->Authentication->getIdentity()->get('id');
        $request->status = 'pending';

        if ($this->Requests->save($request)) {
            $this->Flash->success(__('Request sent successfully.'));
            return $this->redirect(['controller' => 'Requests', 'action' => 'index']);
        }

        $this->Flash->error(__('Error, please try again.'));
    }

    $this->set(compact('request'));
}


    public function approve($id)
    {
        $request = $this->Requests->get($id);
        $this->Authorization->authorize($request, 'approve');

        $request->status = 'approved';
        $this->Requests->save($request);
        $this->Flash->success('Request approved.');
        return $this->redirect(['action' => 'index']);
    }

    public function reject($id)
    {
        $request = $this->Requests->get($id);
        $this->Authorization->authorize($request, 'reject');

        $request->status = 'rejected';
        $this->Requests->save($request);
        $this->Flash->error('Request denied.');
        return $this->redirect(['action' => 'index']);
    }
}
