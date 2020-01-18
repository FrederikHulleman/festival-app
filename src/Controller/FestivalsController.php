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
     * View method
     *
     * @param string|null $id Festival id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug)
    {
        $festival = $this->Festivals->find('bySlug', ['slug' => $slug])->firstOrFail();

        $this->set('festival', $festival);
    }

    /**
     * Edit method
     *
     * @param string|null $id Festival id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($slug)
    {
        $festival = $this->Festivals->find('bySlug', ['slug' => $slug])->firstOrFail();

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
}
