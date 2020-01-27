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

        //to generate the full timetable for the festival dates, retrieve the dates model and it's properties
        $this->loadModel('Dates');
        $query = $this->Dates->find('all')
                                ->where(['dates.festival_id' => $festival->id])
                                ->order(['dates.date' => 'ASC']);
        $all_festival_dates = $query->all();

        //loop through each date, and for each date, loop through each hour (from starttime to endtime)
        //and in case a band is planned on a certain date and starttime, add the details to the timetables array
        //in case no band is planned, only the
        $timetables = array();
        $starttimes_with_planned_bands = array();
        foreach($all_festival_dates as $date) {
            $timetables[$date->id]['date'] = $date->date;

            $query = $this->Timetables->find('all')
                            ->contain(['Bands', 'Festivals', 'Dates', 'Stages'])
                            ->where(['timetables.festival_id' => $festival->id,'timetables.date_id' => $date->id])
                            ->order(['timetables.date_id' => 'ASC','timetables.starttime' => 'ASC'])
                            ;
            $timeslots_with_planned_bands = $query->all();
            $timeslots_with_planned_bands_array = $timeslots_with_planned_bands->toArray();

            //now only retrieve the starttimes for each planned band,
            // so we can use that to match this array with the full time table
            $starttimes_with_planned_bands = array_column($timeslots_with_planned_bands_array, 'starttime');


            for($i = $date->starttime; $i<$date->endtime; $i = $i->modify("+1 hour")) {

                //check whether for this hour ($i) a band is scheduled
                $key = array_search($i,$starttimes_with_planned_bands);
                if($key !== FALSE) {
                    $timetables[$date->id][] = $timeslots_with_planned_bands_array[$key];
                }
                else {
                    $timetables[$date->id][]['starttime'] = $i;
                }

            }
        }
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
    public function edit()
    {
        //there will be one festival to work with, but if somehow more festivals would be present, the first is retrieved to work with
        $this->loadModel('Festivals');
        $query = $this->Festivals->find('all');
        $festival = $query->firstOrFail();

        //to generate the full timetable for the festival dates, retrieve the dates model and it's properties
        $this->loadModel('Dates');
        $query = $this->Dates->find('all')
            ->where(['dates.festival_id' => $festival->id])
            ->order(['dates.date' => 'ASC']);
        $all_festival_dates = $query->all();

        //loop through each date, and for each date, loop through each hour (from starttime to endtime)
        //and in case a band is planned on a certain date and starttime, add the details to the timetables array
        //in case no band is planned, only the
        $timetables = array();
        $starttimes_with_bands = array();
        foreach($all_festival_dates as $date) {
            $timetables[$date->id]['date'] = $date->date;

            $query = $this->Timetables->find('all')
                ->contain(['Bands', 'Festivals', 'Dates', 'Stages'])
                ->where(['timetables.festival_id' => $festival->id,'timetables.date_id' => $date->id])
                ->order(['timetables.date_id' => 'ASC','timetables.starttime' => 'ASC'])
            ;
            $timeslots_with_planned_bands = $query->all();
            $timeslots_with_planned_bands_array = $timeslots_with_planned_bands->toArray();

            $starttimes_with_planned_bands = array_column($timeslots_with_planned_bands_array, 'starttime');

            $i = $date->starttime;
            while($i<$date->endtime) {

                //check whether for this hour ($i) a band is scheduled
                $key = array_search($i,$starttimes_with_planned_bands);
                if($key !== FALSE) {
                    $timetables[$date->id][] = $timeslots_with_planned_bands_array[$key];
                }
                else {
                    $timetables[$date->id][]['starttime'] = $i;
                }
                $i = $i->modify("+1 hour");
            }
        }
        $this->set(compact('timetables'));
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
