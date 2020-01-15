<?php

namespace App\Controller;

class BandsController extends AppController
{
    public function index()
    {
        $this->loadComponent('Paginator');
        $bands = $this->Paginator->paginate($this->Bands->find());
        $this->set(compact('bands'));
    }

    public function view($slug = null)
    {
        $band = $this->Bands->findBySlug($slug)->firstOrFail();
        $this->set(compact('band'));
    }
}