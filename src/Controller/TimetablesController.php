<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

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
        //there will be one festival to work with, but if somehow more festivals would be present, the first is retrieved to work with 
        $this->loadModel('Festivals');
        $query = $this->Festivals->find('all');
        $festival = $query->firstOrFail();

        //debug($timetables_raw);

        //group all existing timetable entries by date & starttime 
        // $timetables_group_by_date_starttime = array();
        // foreach ($timetables_raw as $key => $element) {
        //     //$timetables_group_by_date_starttime[$element->date_id]['date'] = $element->date->date;
        //     $timetables_group_by_date_starttime[$element->date_id][$key] = [
        //                                                                 'starttime' => $element->starttime,
        //                                                                 //$element
        //                                                             ];
        // }
        //debug($timetables_group_by_date_starttime);

        //to generate the full timetable for the festival dates, retrieve the dates model and it's properties
        $this->loadModel('Dates');
        $query = $this->Dates->find('all')->where(['dates.festival_id' => $festival->id]);
        $all_festival_dates = $query->all();

        //debug($timetables_group_by_date_starttime[1]);
        //debug($timetables_group_by_date_starttime[2]);

        $timetables = array();
        $starttimes_with_bands = array();
        foreach($all_festival_dates as $date) {
            $timetables[$date->id]['date'] = $date->date;
            
            $query = $this->Timetables->find('all')
                            //->contain(['Bands', 'Festivals', 'Dates', 'Stages'])
                            ->where(['timetables.festival_id' => $festival->id,'timetables.date_id' => $date->id])
                            //->order(['timetables.date_id' => 'ASC','timetables.starttime' => 'ASC'])
                            ;
            $timetables_with_bands = $query->all()->toArray();    
            //debug($timetables_raw);
            
            $starttimes_with_bands = array_column($timetables_with_bands, 'starttime');
            //debug($starttimes_with_bands);
            
            $i = $date->starttime;
            while($i<$date->endtime) {
                //$full_time_table[$date->id]['date'] = $date->date;
                
                // debug($i);
                $key = array_search($i,$starttimes_with_bands);
                if($key !== FALSE) {
                    $timetables[$date->id][] = [
                        'starttime' => $i,
                        $timetables_with_bands[$key]
                    ];
                    //$full_time_table[$date->id][] = ['starttime' => $i,$timetables_group_by_date_starttime[$date->id][$key]];
                    //debug("found");
                    // debug($date);
                    // debug($i);
                    // debug($key);
                    // debug($timetables_group_by_date_starttime[$date->id][$key]);
                    // debug("end");
                }
                else {
                    $timetables[$date->id][] = [
                        'starttime' => $i
                    ];
                }

                

                $i = $i->modify("+1 hour");
            }
        }
        debug($timetables);
        $this->set(compact('timetables')); 
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
