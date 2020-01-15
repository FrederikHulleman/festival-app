<?php

namespace App\Controller;

class BandsController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }
    
    public function index()
    {
        $bands = $this->Paginator->paginate($this->Bands->find());
        $this->set(compact('bands'));
    }

    public function view($slug = null)
    {
        $band = $this->Bands->findBySlug($slug)->firstOrFail();
        $this->set(compact('band'));
    }

    public function add()
    {
        $band = $this->Bands->newEntity();
        if ($this->request->is('post')) {
            $band = $this->Bands->patchEntity($band, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            // $article->user_id = 1;

            if ($this->Bands->save($band)) {
                $this->Flash->success(__('Your band has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your band.'));
        }
        $this->set('band', $band);
    }

    public function edit($slug)
    {
        $band = $this->Bands->findBySlug($slug)->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Bands->patchEntity($band, $this->request->getData());
            if ($this->Bands->save($band)) {
                $this->Flash->success(__('Your band has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your band.'));
        }

        $this->set('band', $band);
    }
}