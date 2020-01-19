<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Timetable Controller
 *
 * @property \App\Model\Table\TimetableTable $Timetable
 *
 * @method \App\Model\Entity\Timetable[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TimetableController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bands', 'Festivals', 'Dates', 'Stages'],
        ];
        $timetable = $this->paginate($this->Timetable);

        $timetable_grouped_by_date = array();
        foreach ($timetable as $element) {
            $timetable_grouped_by_date[$element['date_id']][] = $element;
        }

        $this->set(compact('timetable_grouped_by_date'));
    }

    /**
     * View method
     *
     * @param string|null $id Timetable id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id)
    {
        $timetable = $this->Timetable->get($id, [
            'contain' => ['Bands', 'Festivals', 'Dates', 'Stages'],
        ]);

        $this->set('timetable', $timetable);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $timetable = $this->Timetable->newEntity();
        if ($this->request->is('post')) {
            $timetable = $this->Timetable->patchEntity($timetable, $this->request->getData());
            if ($this->Timetable->save($timetable)) {
                $this->Flash->success(__('The timetable has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The timetable could not be saved. Please, try again.'));
        }
        $bands = $this->Timetable->Bands->find('list', ['limit' => 200]);
        $festivals = $this->Timetable->Festivals->find('list', ['limit' => 200]);
        $dates = $this->Timetable->Dates->find('list', ['limit' => 200]);
        $stages = $this->Timetable->Stages->find('list', ['limit' => 200]);
        $this->set(compact('timetable', 'bands', 'festivals', 'dates', 'stages'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Timetable id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id)
    {
        $timetable = $this->Timetable->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $timetable = $this->Timetable->patchEntity($timetable, $this->request->getData());
            if ($this->Timetable->save($timetable)) {
                $this->Flash->success(__('The timetable has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The timetable could not be saved. Please, try again.'));
        }
        $bands = $this->Timetable->Bands->find('list', ['limit' => 200]);
        $festivals = $this->Timetable->Festivals->find('list', ['limit' => 200]);
        $dates = $this->Timetable->Dates->find('list', ['limit' => 200]);
        $stages = $this->Timetable->Stages->find('list', ['limit' => 200]);
        $this->set(compact('timetable', 'bands', 'festivals', 'dates', 'stages'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Timetable id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $timetable = $this->Timetable->get($id);
        if ($this->Timetable->delete($timetable)) {
            $this->Flash->success(__('The timetable has been deleted.'));
        } else {
            $this->Flash->error(__('The timetable could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
