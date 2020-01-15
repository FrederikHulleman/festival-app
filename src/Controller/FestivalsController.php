<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Festivals Controller
 *
 * @property \App\Model\Table\FestivalsTable $Festivals
 *
 * @method \App\Model\Entity\Festival[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FestivalsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $festivals = $this->paginate($this->Festivals);

        $this->set(compact('festivals'));
    }

    /**
     * View method
     *
     * @param string|null $id Festival id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $festival = $this->Festivals->get($id, [
            'contain' => [],
        ]);

        $this->set('festival', $festival);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $festival = $this->Festivals->newEntity();
        if ($this->request->is('post')) {
            $festival = $this->Festivals->patchEntity($festival, $this->request->getData());
            if ($this->Festivals->save($festival)) {
                $this->Flash->success(__('The festival has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The festival could not be saved. Please, try again.'));
        }
        $this->set(compact('festival'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Festival id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $festival = $this->Festivals->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $festival = $this->Festivals->patchEntity($festival, $this->request->getData());
            if ($this->Festivals->save($festival)) {
                $this->Flash->success(__('The festival has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The festival could not be saved. Please, try again.'));
        }
        $this->set(compact('festival'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Festival id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $festival = $this->Festivals->get($id);
        if ($this->Festivals->delete($festival)) {
            $this->Flash->success(__('The festival has been deleted.'));
        } else {
            $this->Flash->error(__('The festival could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
