<?php

class UserController extends Zend_Controller_Action
{
    public $fpS;
    public function init()
    {
        /* Initialize action controller here */
        $authorization = Zend_Auth::getInstance();
        $fbsession = new Zend_Session_Namespace('facebook');
        $this->fpS = new Zend_Session_Namespace('facebook');

        $request=$this->getRequest();
        $actionName=$request->getActionName();

         if ((!$authorization->hasIdentity()
         && !isset($fbsession->email)
         && !isset($_SESSION['access_token']))
         && ($actionName != 'login'
         && $actionName != 'fblogin'
         && $actionName != 'fbcallback'
         && $actionName != 'gplogin'
         && $actionName != 'add'
         && $actionName != 'gpcallback'))
         {
             $this->redirect('/user/login');
         }


         if (($authorization->hasIdentity()
         || isset($fbsession->email)
         || isset($_SESSION['access_token']))
         && ($actionName == 'login'
         || $actionName == 'fblogin'
         || $actionName == 'gplogin'))
         {
           $this->redirect('/user');
         }
    }

    public function indexAction()
    {
        // action body

    }

    public function listAllAction()
    {
        // action body
        $user_model = new Application_Model_User();
        $allUsers = $user_model->listAll();
        $this->view->allUsers = $allUsers;
    }

    public function homeAction()
    {
        // just for test login
        $form = new Application_Form_Search();
        $this->view->search_form=$form;

    $category_model = new Application_Model_Category();
   $all=$category_model->listCategory();
    $this->view->category=$all;


    $request=$this->getRequest();
        if($request->ispost())
        {

            if($form->isValid($request->getParams()))
            {

        $product_model=new Application_Model_Product();
       
        $search=$product_model->searchByPname($request->getParam('search'));
        $this->view->searchproduct=$search;

               // echo $request->getParam('search');
            

    
        
            }
        }



     
    
        
    }
    //----------------------------

public function showAction()

    {


     }

//----------------------------------

    public function catproductAction()
    {


        $product_model=new Application_Model_Product();
         $cat_id = $this->_request->getParam("cid");
        
        
        $all=$product_model->displayallproduct($cat_id);
        $this->view->catproduct=$all;
        
    }



    //---------------------------------------------------
    // sign up operation
    public function addAction()
    {
        $form=new Application_Form_SignUp();
        $email = $this->_request->getParam('email');
        $msg = $this->_request->getParam('msg');
        $msg = "<strong>".$msg."</strong><hr>";
        $data['email'] = $email;
        $data['msg'] = $msg;
        $form->populate($data);

        $this->view->signup_form=$form;
        $request=$this->getRequest();
        if($request->ispost())
        {

            if($form->isValid($request->getParams()))
            {
                $user_model = new Application_Model_User();
                $user_model->Register($request->getParams());
                $this->redirect('/');
            }
        }
    }

    // user login
    public function loginAction()
    {
        //$auth=Zend_Auth::getInstance();
        //$storage=$auth->getStorage();
        //$userdata=$storage->read();
        $loginform=new Application_Form_Login();
        $this->view->login_form = $loginform;

        $request = $this->getRequest ();

        if($request-> isPost()){

            if($loginform-> isValid($request-> getPost()))
            {
                $email=$request->getParam('email');
                $password=$request->getParam('password');

                $this->authUserAction($email,$password, 2);

            } // if form is vaild & requset is post


        }//if request is post
        $this->_helper->_layout->setLayout('home');
    }

    //-----------------------------------------------

    public function logoutAction()
    {
        $auth=Zend_Auth::getInstance();
        $auth->clearIdentity();
        Zend_Session::namespaceUnset('facebook');
        session_destroy();
        return $this->redirect('/user/login');
    }

    //---------------------------------------------

    public function fbloginAction()
    {
        $fb = new Facebook\Facebook([
            'app_id' => Zend_Registry::getInstance()->myresources->FACEBOOK_KEY, // Replace {app-id} with your app id
            'app_secret' => Zend_Registry::getInstance()->myresources->FACEBOOK_SECRETE,
            'default_graph_version' => 'v2.5',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // optional
        $loginUrl = $helper->getLoginUrl($this->view->serverUrl().'/user/fbcallback', $permissions);
        $this->view->facebook_url = $loginUrl;
    }

    //--------------------------------------------------------
    public function fbcallbackAction()
    {
        $fb = new Facebook\Facebook([
            'app_id' => Zend_Registry::getInstance()->myresources->FACEBOOK_KEY, // Replace {app-id} with your app id
            'app_secret' => Zend_Registry::getInstance()->myresources->FACEBOOK_SECRETE,
            'default_graph_version' => 'v2.5',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        }
        catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }
        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

        if (! $accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                exit;
            }
            echo '<h3>Long-lived</h3>';
        }
        $fb->setDefaultAccessToken($accessToken);
        try {
            $response = $fb->get('/me?fields=email',$accessToken);

            $userNode = $response->getGraphUser();
        }
        catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            Exit;
        }
        catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            Exit;
        }
        $user_model = new Application_Model_User();
        // $user_model->InsertFB($userNode->all());
        $email = $userNode['email'];
        $row = $user_model->fetchRow($user_model->select()->where('email like ?', $email));
        if($row)
            $password = $row['password'];
            $this->authUserAction($email,$password);
        else{
            $this->redirect('/user/add/email/'.$email.'/msg/You need to register');
        }
    }

    public function createAction()
    {
        // action body
        $form=new Application_Form_SignUp();
        $email = $this->_request->getParam('email');
        $msg = $this->_request->getParam('msg');
        $msg = "<strong>".$msg."</strong><hr>";
        $data['email'] = $email;
        $data['msg'] = $msg;
        $form->populate($data);

        $this->view->signup_form=$form;
        $request=$this->getRequest();
        if($request->ispost())
        {

            if($form->isValid($request->getParams()))
            {
                $user_model = new Application_Model_User();
                $user_model->Register($request->getParams());
                $this->redirect('/User/list-All');
            }
        }
    }

    public function retrieveAction()
    {
        // action body
    }

    public function deleteAction()
    {
        // action body
    }

    public function updateAction()
    {
        // action body
    }

    public function blockAction()
    {
        // action body
        $user_model = new Application_Model_User();
        $u_id = $this->_request->getParam("uid");
        $user_model->block($u_id);
        $this->redirect('/User/list-All');
    }

    public function unblockAction()
    {
        // action body
        $user_model = new Application_Model_User();
        $u_id = $this->_request->getParam("uid");
        $user_model->unblock($u_id);
        $this->redirect('/User/list-All');
    }

    public function makeShopUserAction()
    {
        // action body
        $user_model = new Application_Model_User();
        $u_id = $this->_request->getParam("uid");
        $user_model->makeShopUser($u_id);
        $this->redirect('/User/list-All');
    }

    public function deleteShopUserAction()
    {
        // action body
        $user_model = new Application_Model_User();
        $u_id = $this->_request->getParam("uid");
        $user_model->deleteShopUser($u_id);
        $this->redirect('/User/list-All');
    }

    public function makeAdminUserAction()
    {
        // action body
        $user_model = new Application_Model_User();
        $u_id = $this->_request->getParam("uid");
        $user_model->makeAdminUser($u_id);
        $this->redirect('/User/list-All');
    }

    public function deleteAdminUserAction()
    {
        // action body
        $user_model = new Application_Model_User();
        $u_id = $this->_request->getParam("uid");
        $user_model->deleteAdminUser($u_id);
        $this->redirect('/User/list-All');
    }

    public function authUserAction($email, $password, $type = 1)
    {
        // action body
        //we get object of ZendDbAdapter to know which database we connect on
        $db=zend_Db_Table::getDefaultAdapter();
        $identity = "email";

        if($type != 1){
          $dbm = new Application_Model_User();
          $user = $dbm->fetchRow($dbm->select()->where('username like ?', $email));

          if($user['username']){
            $identity = "username";
          }
        }
        $adapter = new Zend_Auth_Adapter_DbTable($db,'user', $identity,'password');
        $adapter->setIdentity($email);

        $adapter->setCredential($password);

        //execute qyery
        $result=$adapter->authenticate();
        if($result->isValid())
        {
            //print_r('authentiacte');
            //session steps
            $sessionDataObj=$adapter->getResultRowObject(['id','email','name','name_ar','username','isBlocked','type']);

            if($sessionDataObj->isBlocked == 0 && $sessionDataObj->type == 1 )
            {
                $auth=Zend_Auth::getInstance();
                $storage=$auth->getStorage();
                $storage->write($sessionDataObj);
                $this->redirect('/dashboard');
            }

            if($sessionDataObj->isBlocked == 0 &&$sessionDataObj->type == 2 )
            {
                $auth=Zend_Auth::getInstance();
                $storage=$auth->getStorage();
                $storage->write($sessionDataObj);
                $this->redirect('/dashboard');
            }

            if($sessionDataObj->isBlocked == 0 && $sessionDataObj->type == 3 )
            {
                $auth=Zend_Auth::getInstance();
                $storage=$auth->getStorage();
                $storage->write($sessionDataObj);
                $this->redirect('/user');
            }
            else
            {
                $this->redirect('/user/add/email/'.$email.'/msg/You are blocked, contact Admin');
            }
        }

        else
        {
            $this->redirect('/user/add/email/'.$email.'/msg/User Not Found, Create New Account');
        }
    }

    public function gploginAction()
    {
        // action body
        session_start();
        $client = new Google_Client();
        $client->setClientId(Zend_Registry::getInstance()->myresources->GOOGLE_KEY);
        $client->setClientSecret(Zend_Registry::getInstance()->myresources->GOOGLE_SECRETE);
        //$client->setAuthConfig('client_secrets.json');
        $client->addScope('email');
        $service = new Google_Service_Oauth2($client);

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
        } else {
            $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/user/gpcallback';
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }

    }

    public function gpcallbackAction()
    {
        // action body
        //session_start();
        $client = new Google_Client();
        $client->setClientId(Zend_Registry::getInstance()->myresources->GOOGLE_KEY);
        $client->setClientSecret(Zend_Registry::getInstance()->myresources->GOOGLE_SECRETE);
        //$client->setAuthConfig('client_secrets.json');
        $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/user/gpcallback');
        $client->addScope('email');
        $service = new Google_Service_Oauth2($client);

        if (! isset($_GET['code'])) {
            $auth_url = $client->createAuthUrl();
            header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
        } else {
            $client->authenticate($_GET['code']);
            $userNode = $service->userinfo->get(); //get user info
            $user_model = new Application_Model_User();
            // $user_model->InsertFB($userNode->all());
            $email = $userNode->email;
            $row = $user_model->fetchRow($user_model->select()->where('email like ?', $email));
            $password = $row['password'];
            if($row){
                $_SESSION['access_token'] = $client->getAccessToken();
                $this->authUserAction($email,$password);
            }
            else{
                $this->redirect('/user/add/email/'.$email.'/msg/You need to register');
            }
        }
    }

}
