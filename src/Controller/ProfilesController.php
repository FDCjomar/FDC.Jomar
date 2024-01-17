<?php
declare(strict_types=1);

namespace App\Controller;
use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;

/**
 * Profiles Controller
 *
 * @property \App\Model\Table\ProfilesTable $Profiles
 */
class ProfilesController extends AppController
{
    public $components = ['Authentication.Authentication'];
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
        $this->Users = TableRegistry::getTableLocator()->get('Users');
    }   
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    
    public function index()
    {
        
        $authUser = $this->Authentication->getIdentity();
        $user = $this->Users->get($authUser->id);
        // $query = $this->Profiles->find()
        //     ->contain(['Users']);
        // $profiles = $this->paginate($query);

        $this->set(compact('user'));
    }

    /**
     * View method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $profile = $this->Profiles->newEmptyEntity();
        if ($this->request->is('post')) {
            $profile = $this->Profiles->patchEntity($profile, $this->request->getData());
            if ($this->Profiles->save($profile)) {
                $this->Flash->success(__('The profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profile could not be saved. Please, try again.'));
        }
        $users = $this->Profiles->Users->find('list', limit: 200)->all();
        $this->set(compact('profile', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
         // Get the currently logged-in user
         $authUser = $this->Authentication->getIdentity();
         $user = $this->Users->get($authUser->id);
         $this->set(compact('user'));
         if ($this->request->is(['patch', 'post', 'put'])) {
             $user = $this->Users->patchEntity($user, $this->request->getData());
            
             if ($this->Users->save($user)) {
                $file = $this->request->getData('profile_img_file');
                $fileName = Text::uuid();
                $fileName = $fileName . "." . $file->getClientFileName();
                $file->moveTo(WWW_ROOT . 'img/uploads' . DS . $fileName);

                
                // Update the file name in the database
                $user->profile_img = $fileName;
                $this->Users->save($user); // Update the entity with the file name

                $this->Flash->success(__('Your profile has been updated.'));
 
                 return $this->redirect(['action' => 'index']);
             }
             $this->Flash->error(__('Your profile could not be updated. Please, try again.'));
         }
 
         
    }

    /**
     * Delete method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $profile = $this->Profiles->get($id);
        if ($this->Profiles->delete($profile)) {
            $this->Flash->success(__('The profile has been deleted.'));
        } else {
            $this->Flash->error(__('The profile could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
