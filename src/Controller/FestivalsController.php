<?php
// src/Controller/FestivalsController.php

namespace App\Controller;

class FestivalsController extends AppController
{
    public function index()
    {
        $this->loadComponent('Paginator');
        $festivals = $this->Paginator->paginate($this->Festivals->find());
        $this->set(compact('festivals'));
    }

    public function view($id = null)
    {
        $festival = $this->Festivals->findById($id)->firstOrFail();
        $this->set(compact('festival'));
    }
}