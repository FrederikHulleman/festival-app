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
    public function initialize()
    {
        parent::initialize();

        //there will be one festival to work with, but if somehow more festivals would be present, the first is retrieved to work with
        $this->festival = $this->Timetables->Festivals->find('all')
            ->contain(['Dates', 'Stages', 'Tickets', 'Timetables'])
            ->firstOrFail();

        $this->set('festival', $this->festival);

        $this->Auth->allow(['index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        //to generate the full timetable for the festival dates, retrieve the dates model and it's properties
        $query = $this->Timetables->Dates->find('all')
                                ->where(['dates.festival_id' => $this->festival->id])
                                ->order(['dates.date' => 'ASC']);
        $all_festival_dates = $query->all();

        //to generate the full timetable for the festival stages, retrieve the stages model and it's properties
        $query = $this->Timetables->Stages->find('all')
            ->where(['stages.festival_id' => $this->festival->id])
            ->order(['stages.name' => 'ASC']);
        $all_festival_stages = $query->all();

        //loop through each date & stage, and for each date/stage combination, loop through each hour (from starttime to endtime)
        //and in case a band is planned on a certain date, stage and starttime, add the details to the timetables array
        //in case no band is planned, only the starttime is written to the array
        $timetables = array();
        $starttimes_with_planned_bands = array();
        foreach($all_festival_dates as $date) {
            $timetables[$date->id]['date'] = $date->date;
            foreach($all_festival_stages as $stage) {
                $timetables[$date->id][$stage->id]['stage'] = $stage->name;

                $query = $this->Timetables->find('all')
                    ->contain(['Bands', 'Festivals', 'Dates', 'Stages'])
                    ->where(['timetables.festival_id' => $this->festival->id, 'timetables.stage_id' => $stage->id,'timetables.date_id' => $date->id])
                    ->order(['timetables.date_id' => 'ASC', 'timetables.stage_id' => 'ASC', 'timetables.starttime' => 'ASC']);
                $timeslots_with_planned_bands = $query->all();
                $timeslots_with_planned_bands_array = $timeslots_with_planned_bands->toArray();

                //now only retrieve the starttimes for each planned band,
                // so we can use that to match this array with the full time table
                $starttimes_with_planned_bands = array_column($timeslots_with_planned_bands_array, 'starttime');

                for ($i = $date->starttime; $i < $date->endtime; $i = $i->modify("+1 hour")) {

                    $date_time_stage_key = $date->id . '-' . $i->format('H') . '-' . $stage->id;

                    //check whether for this hour ($i) a band is scheduled
                    $key = array_search($i, $starttimes_with_planned_bands);
                    if ($key !== FALSE) {
                        $timetables[$date->id][$stage->id][$date_time_stage_key] = $timeslots_with_planned_bands_array[$key];
                    } else {
                        $timetables[$date->id][$stage->id][$date_time_stage_key]['starttime'] = $i;
                    }

                }
            }
        }
        //debug($timetables);
        $this->set(compact('timetables'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Timetable id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($date_time_stage_key)
    {
        $key_elements = explode('-',$date_time_stage_key);

        $date_id = $key_elements[0];
        $start_hour_string = $key_elements[1];
        $start_time_search_string = $start_hour_string . ":00:00";
        $stage_id = $key_elements[2];

        $query = $this->Timetables->find('all')
            ->contain(['Dates', 'Stages', 'Bands', 'Festivals'])
            ->where([
                'timetables.festival_id' => $this->festival->id,
                'timetables.date_id' => $date_id,
                'timetables.starttime' => $start_time_search_string,
                'timetables.stage_id' => $stage_id
            ]);

        if(!empty($query->count()) && $query->count() > 0) {
            $mode = "edit";
            $timetable = $query->firstOrFail();
            debug($query->count());
        }
        else {
            $mode = "add";
            $timetable = $this->Timetables->newEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->getData();
            //debug($data);
            if($mode == "edit") {
                $this->Timetables->delete($timetable);
                $timetable = $this->Timetables->newEntity();
            }
            $timetable->band = $this->Timetables->Bands->get($data['band']['id']);
            $timetable->stage = $this->Timetables->Stages->get($stage_id);
            $timetable->festival = $this->festival;
            $timetable->date = $this->Timetables->Dates->get($date_id);
            $timetable->starttime = $data['starttime'];
            $timetable->endtime = $data['endtime'];
            //debug($timetable);

            if ($this->Timetables->save($timetable)) {
                $this->Flash->success(__('The timetable has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The timetable could not be saved. Please, try again.'));
        }
        else {
            if($mode == "add") {
                $timetable->festival = $this->festival;
                $timetable->date = $this->Timetables->Dates->get($date_id);
                $timetable->stage = $this->Timetables->Stages->get($stage_id);
                $timetable->starttime = Time::createFromFormat(
                    'H',
                    $start_hour_string
                );
                $timetable->endtime = Time::createFromFormat(
                    'H',
                    $start_hour_string
                )->modify("+45 minutes");
            }


        }
        $bands = $this->Timetables->Bands->find('list', ['limit' => 200]);

        $this->set(compact('timetable', 'bands'));


    }

    /**
     * Delete method
     *
     * @param string|null $id Timetable id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($date_time_stage_key)
    {
        $this->request->allowMethod(['post', 'delete']);

        $key_elements = explode('-',$date_time_stage_key);

        $date_id = $key_elements[0];
        $start_hour_string = $key_elements[1];
        $start_time_search_string = $start_hour_string . ":00:00";
        $stage_id = $key_elements[2];

        $timetable = $this->Timetables->find('all')
            ->contain(['Dates', 'Stages', 'Bands', 'Festivals'])
            ->where([
                'timetables.festival_id' => $this->festival->id,
                'timetables.date_id' => $date_id,
                'timetables.starttime' => $start_time_search_string,
                'timetables.stage_id' => $stage_id,
            ])->firstOrFail();

        if ($this->Timetables->delete($timetable)) {
            $this->Flash->success(__('The timetable has been deleted.'));
        } else {
            $this->Flash->error(__('The timetable could not be deleted. Please, try again.'));
        }

          return $this->redirect(['action' => 'index']);
    }
}
