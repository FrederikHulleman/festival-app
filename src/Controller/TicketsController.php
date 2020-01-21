<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tickets Controller
 *
 * @property \App\Model\Table\TicketsTable $Tickets
 *
 * @method \App\Model\Entity\Ticket[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TicketsController extends AppController
{
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
        //there will be one festival to work with, but if somehow more festivals would be present, the first is retrieved to work with 
        $query = $this->Tickets->Festivals->find('all');
        $festival = $query->firstOrFail();

        if ($this->request->is('post')) {
            $data = $this->request->getData(); 
            
            foreach($data['dates']['_ids'] as $date) {
                $ticket = $this->Tickets->newEntity();
                
                $date = $this->Tickets->Dates->get($date);
                $visitor = $this->Tickets->Visitors->findOrCreate(['email' => $data['visitor']['email']]);

                $ticket->date = $date;
                $ticket->visitor = $visitor;
                $ticket->festival = $festival; 

                if (!$this->Tickets->save($ticket)) {
                    $this->Flash->error(__('The ticket could not be saved. Please, try again.'));
                    exit;
                }
                
            }
            if(count($data['dates']['_ids']) == 1) {
                $this->Flash->success(__('The ticket has been saved.'));
            }
            else {
                $this->Flash->success(__('The tickets have been saved.'));
            }
            return $this->redirect(['controller' => 'Festivals', 'action' => 'view','leidsche-rijn-mahler-festival']);
        }

        $ticket = $this->Tickets->newEntity();

        //$festivals = $this->Tickets->Festivals->find('list', ['limit' => 200]);
        $dates = $this->Tickets->Dates->find('list', ['limit' => 200]);
        $visitors = $this->Tickets->Visitors->find('list', ['limit' => 200]);
    
        $this->set(compact('ticket', 'festival', 'dates', 'visitors'));
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
