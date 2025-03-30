<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

class HomeController extends AppController
{

    public function index()
    {
        $artistsTable = TableRegistry::getTableLocator()->get('Artists');

        $lastArtists = $artistsTable->find()
            ->orderBy(['created' => 'DESC'])
            ->limit(5)
            ->all();

        $this->Authorization->skipAuthorization();
        $this->set(compact('lastArtists'));
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        
        // Permet aux utilisateurs non connectés d’accéder à certaines actions
        $this->Authentication->allowUnauthenticated(['view', 'index']);

        $this->Authorization->skipAuthorization();
    }
}
