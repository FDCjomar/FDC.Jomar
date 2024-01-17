<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        $success = true;

    if ($this->request->is('post')) {
        $user = $this->Users->patchEntity($user, $this->request->getData());
        $success = $this->Users->save($user);

        if ($success) {
            // Update user_last_login upon successful registration
            $this->updateLastLoginTime($user->id);

            // Set authentication identity and redirect
            $this->Authentication->setIdentity($user);
            $this->set('message', 'Registration successful');
            return $this->redirect(['controller' => 'Pages', 'action' => 'thankYou']);
        } else {
            $this->set('errors', $user->getErrors());
        }
    }

        $this->set(compact('user', 'success'));
        $this->viewBuilder()->setOption('serialize', ['user', 'errors', 'success', 'message']);

    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
         // Get the currently logged-in user
        $user = $this->Users->get($this->Auth->user('id'), ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your profile has been updated.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Your profile could not be updated. Please, try again.'));
        }

        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
   

public function login()
{
    $this->request->allowMethod(['get', 'post']);
    $result = $this->Authentication->getResult();

    if ($result && $result->isValid()) {
        $user = $this->Authentication->getIdentity();
        $this->updateLastLoginTime($user->id);

        $redirect = $this->request->getQuery('redirect', [
            'controller' => 'Pages',
            'action' => 'thankYou',
        ]);
        return $this->redirect($redirect);
    }

    if ($this->request->is('post') && !$result->isValid()) {
        $this->Flash->error(__('Invalid username or password'));
    }
}
public function logout()
{
    $result = $this->Authentication->getResult();
    if ($result && $result->isValid()) {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
}

protected function updateLastLoginTime($userId)
{
    $usersTable = TableRegistry::getTableLocator()->get('Users');
    $user = $this->Users->get($userId);
    $user->user_last_login = Time::now();

    if ($this->Users->save($user)) {
        $this->log('Last login time updated for user ID ' . $userId, 'debug');
    } else {
        $this->log('Failed to update last login time for user ID ' . $userId, 'error');
    }
}



}
