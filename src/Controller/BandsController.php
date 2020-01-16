<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bands Controller
 *
 * @property \App\Model\Table\BandsTable $Bands
 *
 * @method \App\Model\Entity\Band[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BandsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $bands = $this->paginate($this->Bands);

        $this->set(compact('bands'));
    }

    /**
     * View method
     *
     * @param string|null $id Band id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $band = $this->Bands->findBySlug($slug)->firstOrFail();
        // $band = $this->Bands->findBySlug($slug, [
        //     'contain' => ['Timetable'],
        // ])->firstOrFail();

        $this->set('band', $band);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $band = $this->Bands->newEntity();
        if ($this->request->is('post')) {
            $band = $this->Bands->patchEntity($band, $this->request->getData());
            if ($this->Bands->save($band)) {
                $this->Flash->success(__('The band has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The band could not be saved. Please, try again.'));
        }
        $this->set(compact('band'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Band id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        $band = $this->Bands->findBySlug($slug)->firstOrFail();
        // $band = $this->Bands->findBySlug($slug, [
        //     'contain' => [],
        // ])->firstOrFail();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $band = $this->Bands->patchEntity($band, $this->request->getData());
            if ($this->Bands->save($band)) {
                $this->Flash->success(__('The band has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The band could not be saved. Please, try again.'));
        }
        $this->set(compact('band'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Band id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($slug = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $band = $this->Bands->findBySlug($slug)->firstOrFail();
        if ($this->Bands->delete($band)) {
            $this->Flash->success(__('The band has been deleted.'));
        } else {
            $this->Flash->error(__('The band could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
