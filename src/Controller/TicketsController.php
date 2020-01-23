<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * Tickets Controller
 *
 * @property \App\Model\Table\TicketsTable $Tickets
 *
 * @method \App\Model\Entity\Ticket[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TicketsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['order']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Festivals', 'Dates', 'Visitors'],
        ];
        $tickets = $this->paginate($this->Tickets);

        $this->set(compact('tickets'));
    }

    /**
     * View method
     *
     * @param string|null $id Ticket id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ticket = $this->Tickets->get($id, [
            'contain' => ['Festivals', 'Dates', 'Visitors'],
        ]);

        $this->set('ticket', $ticket);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function order()
    {
        $continue = TRUE;
        $date_string = "";

        //there will be one festival to work with, but if somehow more festivals would be present, the first is retrieved to work with
        $query = $this->Tickets->Festivals->find('all');
        $festival = $query->firstOrFail();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            if(empty($data['dates']['_ids'])) {
                $continue = FALSE;
                $this->Flash->error(__('Please select the dates you want to visit ' . $festival->title));
            }
            else {
                if(count($data['dates']['_ids']) === 1) {
                    $start_succes_message = 'The ticket has ';
                    $start_error_message = 'The ticket ';
                    $date_string .= "for date ";
                }
                else {
                    $start_succes_message = 'The tickets have ';
                    $start_error_message = 'The tickets ';
                    $date_string .= "for ";
                }

                $dates = array();
                foreach($data['dates']['_ids'] as $key=>$date_id) {

                    if($continue) {

                        $ticket = $this->Tickets->newEntity();

                        $dates[$key] = $this->Tickets->Dates->get($date_id);
                        $visitor = $this->Tickets->Visitors->findOrCreate(['email' => $data['visitor']['email']]);

                        $ticket->date = $dates[$key];
                        $ticket->visitor = $visitor;
                        $ticket->festival = $festival;

                        if (!$this->Tickets->save($ticket)) {
                            $continue = FALSE;
                            //$this->Flash->error(__($start_error_message . 'could not be saved. Please, try again.'));
                        }

                        if($key !== 0) {
                            $date_string .= " and " . $dates[$key]->date->format('F jS, Y');
                        }
                        else {
                            $date_string .= $dates[$key]->date->format('F jS, Y');
                        }
                    }
                }

                if($continue) {
                    $email = new Email('gmail');
                    $email->to($data['visitor']['email'])
                        ->subject('Tickets ' . $festival->title)
                        //->send('My message')
                        ;

                    $body = 'Hi, congratulations, you successfully booked your '.$festival->title.' tickets '. $date_string .'. See you then! Cheers, the LRMF team';

                    if($email->send($body)) {
                        foreach($dates as $date) {
                            $query = $this->Tickets->find('all')
                                                ->where(['tickets.festival_id' => $festival->id,
                                                        'tickets.date_id' => $date->id,
                                                        'tickets.visitor_id' => $visitor->id
                                                    ]);
                            $ticket = $query->firstOrFail();
                            $ticket->confirmed = TRUE;
                            $this->Tickets->save($ticket);
                        }

                        $this->Flash->success(__($start_succes_message . ' been sent to your email address'));
                        return $this->redirect(['controller' => 'Festivals', 'action' => 'view']);
                    }
                }

                $this->Flash->error(__($start_error_message . 'could not be saved. Please, try again.'));
            }
        }
        $ticket = $this->Tickets->newEntity();

        //$festivals = $this->Tickets->Festivals->find('list', ['limit' => 200]);
        $dates = $this->Tickets->Dates->find('list', ['limit' => 200])
                                        ->where(['dates.festival_id' => $festival->id]);
        $visitors = $this->Tickets->Visitors->find('list', ['limit' => 200]);

        $this->set(compact('ticket', 'dates','festival'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ticket id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ticket = $this->Tickets->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->getData());
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('The ticket has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ticket could not be saved. Please, try again.'));
        }
        $festivals = $this->Tickets->Festivals->find('list', ['limit' => 200]);
        $dates = $this->Tickets->Dates->find('list', ['limit' => 200]);
        $visitors = $this->Tickets->Visitors->find('list', ['limit' => 200]);
        $this->set(compact('ticket', 'festivals', 'dates', 'visitors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ticket id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ticket = $this->Tickets->get($id);
        if ($this->Tickets->delete($ticket)) {
            $this->Flash->success(__('The ticket has been deleted.'));
        } else {
            $this->Flash->error(__('The ticket could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
