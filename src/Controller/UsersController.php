<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->addUnauthenticatedActions(['login', 'register']);

        $this->Authorization->skipAuthorization(['login', 'register']);
    }

    public function register()
    {
        $this->request->allowMethod(['get', 'post']);
        $user = $this->Users->newEmptyEntity();

        // Vérifiez si l'utilisateur est authentifié
        $identity = $this->request->getAttribute('identity');
        if ($identity) {
            // Si l'utilisateur est authentifié, vous pouvez l'autoriser
            $this->Authorization->authorize($identity);
        } else {
            // Si l'utilisateur n'est pas authentifié, vous pouvez choisir de ne pas appeler authorize
            // ou de gérer cela différemment
        }

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            debug($data); // Affichez les données soumises pour le débogage
            $user = $this->Users->patchEntity($user, $data);
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Compte créé ! Vous pouvez maintenant vous connecter.'));
                return $this->redirect(['action' => 'login']);
            } else {
                // Affichez les erreurs de validation
                $errors = $user->getErrors();
                if (!empty($errors)) {
                    $errorMessages = [];
                    foreach ($errors as $fieldErrors) {
                        foreach ($fieldErrors as $error) {
                            $errorMessages[] = $error;
                        }
                    }
                    $this->Flash->error(implode(', ', $errorMessages));
                }
            }
        }

        $this->set(compact('user'));
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $user = $this->request->getAttribute('identity');

        if ($user->get('role') !== 'admin') {
            throw new \Cake\Http\Exception\ForbiddenException('Accès interdit');
        }

        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }


    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $identity = $this->request->getAttribute('identity');
        $user = $this->Users->get($id, [
            'contain' => [
                'Favorites' => ['Artists', 'Albums'],
                'Follows' => ['Artists'],
                'Requests'
            ]
        ]);

        if ($identity->get('role') !== 'admin' && $identity->getIdentifier() != $user->id) {
            throw new \Cake\Http\Exception\ForbiddenException('You don\'t have access to this page');
        }

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        $this->Authorization->authorize($user, 'add');

        $this->Authorization->skipAuthorization();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->Authorization->authorize($user, 'edit');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $this->Authorization->authorize($user, 'delete');

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        $this->Authorization->skipAuthorization();

        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect();

            if ($target === '/users/login') {
                $target = ['controller' => 'Home', 'action' => 'index'];
            }

            return $this->redirect($target ?: ['controller' => 'Home', 'action' => 'index']);
        }

        if ($this->request->is('post')) {
            $this->Flash->error('Wrong email or password.');
        }
    }



    public function logout()
    {
        $this->Authentication->logout();

        $this->Flash->success('Déconnexion réussie.');
        return $this->redirect(['controller' => 'Home', 'action' => 'index']);
    }
}
