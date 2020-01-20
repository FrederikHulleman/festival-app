<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Timetables Controller
 *
 * @property \App\Model\Table\TimetablesTable $Timetables
 *
 * @method \App\Model\Entity\Timetable[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TimetablesController extends AppController
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
        $timetables = $this->paginate($this->Timetables);

        $timetables_grouped_by_date = array();
        foreach ($timetables as $element) {
            $timetables_grouped_by_date[$element['date_id']][] = $element;
        }
        debug($timetables_grouped_by_date);
        $this->set(compact('timetables_grouped_by_date'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $timetable = $this->Timetables->newEntity();
        if ($this->request->is('post')) {
            $timetable = $this->Timetables->patchEntity($timetable, $this->request->getData());
            if ($this->Timetables->save($timetable)) {
                $this->Flash->success(__('The timetable has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The timetable could not be saved. Please, try again.'));
        }
        $bands = $this->Timetables->Bands->find('list', ['limit' => 200]);
        $festivals = $this->Timetables->Festivals->find('list', ['limit' => 200]);
        $dates = $this->Timetables->Dates->find('list', ['limit' => 200]);
        $stages = $this->Timetables->Stages->find('list', ['limit' => 200]);
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
        $timetable = $this->Timetables->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $timetable = $this->Timetables->patchEntity($timetable, $this->request->getData());
            if ($this->Timetables->save($timetable)) {
                $this->Flash->success(__('The timetable has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The timetable could not be saved. Please, try again.'));
        }
        $bands = $this->Timetables->Bands->find('list', ['limit' => 200]);
        $festivals = $this->Timetables->Festivals->find('list', ['limit' => 200]);
        $dates = $this->Timetables->Dates->find('list', ['limit' => 200]);
        $stages = $this->Timetables->Stages->find('list', ['limit' => 200]);
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
        $timetable = $this->Timetables->get($id);
        if ($this->Timetables->delete($timetable)) {
            $this->Flash->success(__('The timetable has been deleted.'));
        } else {
            $this->Flash->error(__('The timetable could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
