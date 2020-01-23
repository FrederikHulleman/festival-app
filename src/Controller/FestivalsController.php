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

    public function initialize()
    {
        parent::initialize();

        $this->festival = $this->Festivals->find('all')
            ->contain(['Dates', 'Stages', 'Tickets', 'Timetables'])
            ->firstOrFail();

        $this->set('festival', $this->festival);

    }

    /**
     * View method
     *
     * @param string|null $id Festival id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {

    }

    /**
     * Edit method
     *
     * @param string|null $id Festival id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {

        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->festival = $this->Festivals->patchEntity($this->festival, $this->request->getData());
            if ($this->Festivals->save($this->festival)) {
                $this->Flash->success(__('The festival has been saved.'));

                return $this->redirect(['action' => 'view']);
            }
            $this->Flash->error(__('The festival could not be saved. Please, try again.'));
        }
        $dates = $this->Festivals->Dates->find('all')
            ->where(['dates.festival_id' => $this->festival->id]);

        $this->set(compact('dates'));
    }
}
