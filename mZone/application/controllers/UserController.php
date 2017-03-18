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

       //    if ((!$authorization->hasIdentity() && !isset($fbsession->first_name)) && ($actionName != 'login' && $actionName != 'fblogin' && $actionName !='fbcallback'))
       //    {

       //        $this->redirect('/user/login');
       //    }


       //    if (($authorization->hasIdentity() || isset($fbsession->first_name)) && ($actionName == 'login' || $actionName == 'fblogin'))
       //    {
            // $this->redirect('/user/home');
       //    }

   






    }

    public function indexAction()
    {
        // action body
    }



//---------------------------------------------------

public function homeAction()
	{

// just for test login 
    }
//-----------------------------------------
    // sign up operation 

    public function addAction()
	{


	    $form=new Application_Form_SignUp();
	    $this->view->signup_form=$form;
		$request=$this->getRequest();
		if($request->ispost())
		{

	    	if($form->isValid($request->getParams()))
			{

				$user_model = new Application_Model_User();
				$user_model->Register($request->getParams());
				$this->redirect("/user/home");
			}
		}
	}// end add action 


//-----------------------------------------

// user login 
	public function loginAction()





	// $auth=Zend_Auth::getInstance();
 //    $storage=$auth->getStorage();
 //    $userdata=$storage->read();
	{


		$loginform=new Application_Form_Login();
		$this->view->login_form = $loginform;

		$request = $this->getRequest ();

		if($request-> isPost()){

			if($loginform-> isValid($request-> getPost()))
			{

				$email=$request->getParam('email');
				$password=$request->getParam('password');
				//we get object of ZendDbAdapter to know which database we connect on
				$db=zend_Db_Table::getDefaultAdapter();



				$adapter=new Zend_Auth_Adapter_DbTable($db,'user','email','password');

				$adapter->setIdentity($email);

				$adapter->setCredential($password);
				//execute qyery
				$result=$adapter->authenticate();

					if($result->isValid())
					{
    					print_r('authentiacte');

//session steps 
					    $sessionDataObj=$adapter->getResultRowObject(['email','password','username','isBlocked','type']);
					    if($sessionDataObj->isBlocked == 0 &&$sessionDataObj->type == 1 )
					    {
					    $auth=Zend_Auth::getInstance();
					    $storage=$auth->getStorage();
					    $storage->write($sessionDataObj);
					    $this->redirect('/user/admin');
					}

						if($sessionDataObj->isBlocked == 0 &&$sessionDataObj->type == 2 )
					    {
					    $auth=Zend_Auth::getInstance();
					    $storage=$auth->getStorage();
					    $storage->write($sessionDataObj);
					    $this->redirect('/user/shopUser');
					}

					if($sessionDataObj->isBlocked == 0 &&$sessionDataObj->type == 3 )
					    {
					    $auth=Zend_Auth::getInstance();
					    $storage=$auth->getStorage();
					    $storage->write($sessionDataObj);
					    $this->redirect('/user/home');
					}

					else
					{
						echo " <br>  You are blocked connect to admin ";
					}



					}

					else
					{

   						$this->redirect('/user/add');
					}

				} // if form is vaild & requset is post


			}//if request is post

		} // end of login action 

//-----------------------------------------------

				public function logoutAction()
          {
		    $auth=Zend_Auth::getInstance();
		    $auth->clearIdentity();
		    Zend_Session::namespaceUnset('facebook');
		    return $this->redirect('user/login');


       }

//---------------------------------------------

   public function fbloginAction()
{
   

$fb = new Facebook\Facebook([
'app_id' => '1309536932472952', // Replace {app-id} with your app id
'app_secret' => '54d56b6a83dbb448a42a4b26e26ba401',
'default_graph_version' => 'v2.2',
]);
$helper = $fb->getRedirectLoginHelper();
$loginUrl = $helper->getLoginUrl($this->view->serverUrl().'/user/fbcallback');
$this->view->facebook_url = $loginUrl;

}

//--------------------------------------------------------
public function fbcallbackAction()
{
$fb = new Facebook\Facebook([
'app_id' => '1309536932472952', // Replace {app-id} with your app id
'app_secret' => '54d56b6a83dbb448a42a4b26e26ba401',
'default_graph_version' => 'v2.2',
]);

$helper = $fb->getRedirectLoginHelper();

try {
$accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
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
$response = $fb->get('/me?fields=id,first_name,last_name,email,gender,middle_name,birthday');

$userNode = $response->getGraphUser();
var_dump($userNode);
// $a=$user_profile->getProperty("email");
// echo $a;
// $graphObject = $response->getGraphGroup();
// $femail = $response->getEmail('email');
// var_dump($femail);
 // exit;

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


  $this->fpS->first_name = $userNode['first_name'];
  $this->fpS->last_name = $userNode['last_name'];
  $this->fpS->middle_name = $userNode['middle_name'];
  $this->fpS->gender = $userNode['gender'];
 // $this->redirect('/user/home');


                $user_model = new Application_Model_User();
				// $user_model->InsertFB($userNode->all());


}




//--------------------------------------

}// end of class 

