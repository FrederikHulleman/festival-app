<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Stages Controller
 *
 * @property \App\Model\Table\StagesTable $Stages
 *
 * @method \App\Model\Entity\Stage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StagesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['view','index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Festivals'],
        ];
        $stages = $this->paginate($this->Stages);

        $this->set(compact('stages'));
    }

    /**
     * View method
     *
     * @param string|null $id Stage id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug)
    {
        $stage = $this->Stages->find('bySlug', ['slug' => $slug])->firstOrFail();
        $this->set('stage', $stage);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stage = $this->Stages->newEntity();
        if ($this->request->is('post')) {
            //there will be one festival to work with, but if somehow more festivals would be present, the first is retrieved to work with
            $query = $this->Stages->Festivals->find('all');
            $festival = $query->firstOrFail();

            $stage->festival = $festival;
            $stage = $this->Stages->patchEntity($stage, $this->request->getData());

            //first the stage is saved without an id
            if ($this->Stages->save($stage)) {
                $this->Flash->success(__('The stage has been saved.'));
                //now the stage has an ID, the slug generated should be saved
                $stage->slug = $this->Stages->createSlug($stage);
                $this->Stages->save($stage);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stage could not be saved. Please, try again.'));
        }
        $festivals = $this->Stages->Festivals->find('list', ['limit' => 200]);
        $this->set(compact('stage'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Stage id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($slug)
    {
        $stage = $this->Stages->find('bySlug', ['slug' => $slug])->firstOrFail();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stage = $this->Stages->patchEntity($stage, $this->request->getData());
            if ($this->Stages->save($stage)) {
                $this->Flash->success(__('The stage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stage could not be saved. Please, try again.'));
        }
        $festivals = $this->Stages->Festivals->find('list', ['limit' => 200]);
        $this->set(compact('stage'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Stage id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($slug)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stage = $this->Stages->find('bySlug', ['slug' => $slug])->firstOrFail();
        if ($this->Stages->delete($stage)) {
            $this->Flash->success(__('The stage has been deleted.'));
        } else {
            $this->Flash->error(__('The stage could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
