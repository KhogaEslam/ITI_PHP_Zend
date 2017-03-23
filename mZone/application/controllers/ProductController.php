
<?php
class ProductController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function displayAction()
    {
        // action body
        $product_model=new Application_Model_Product();
        $this->view->product=$product_model->displayproduct();
    }

    public function detailsAction()
    {
        // action body
        $product_model=new Application_Model_Product();
        $product_id=$this->_request->getParam("pid");
        $product=$product_model->productdetails($product_id);
        $this->view->product = $product;


    }

    public function addAction()
    {
        // action body
        $form = new Application_Form_Productform();
        $request = $this->getRequest();
        if($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $product_model = new Application_Model_Product();
                //$original_filename = $form->image->getFileName(null, false);
                if ($form->image->receive()) {
                    //$model->saveUpload($this->_identity, $form->image->getFileName(null, false), $original_filename);
                    $image = $form->image->getFileName(null, false);
                    $product_model->addNewproduct($request->getParams(), $image);
                }

                $this->redirect("/product/shop-products");
            }
        }
        $this->view->product_form = $form;
    }

    public function deleteAction()
    {
        // action body
        $product_model = new Application_Model_Product();
        $product_id=$this->_request->getParam("uid");
        $product=$product_model->deleteproduct($product_id);
        $this->redirect("/product/list-all");
    }

    public function updateAction()
    {
        // action body
        $form = new Application_Form_Productform();
        $id = $this->_request->getParam('pid');
        $product_model = new Application_Model_Product();
        $data = $product_model ->productdetails($id);
        $form->populate($data);
        $request = $this->getRequest();
        if($request->isPost()){
          if($form->isValid($request->getPost())){
          $product_model = new Application_Model_Product();
          //$original_filename = $form->image->getFileName(null, false);
          if ($form->image->receive()) {
            //$model->saveUpload($this->_identity, $form->image->getFileName(null, false), $original_filename);
              $image = $form->image->getFileName(null, false);
            $product_model->updateproduct($id,$request->getParams(),$image);
          }

          $this->redirect("/product/list-all");

        }
      }
        $this->view->product_form = $form;
    }

    public function createAction()
    {
        // action body
            $form = new Application_Form_Productform();
            $request = $this->getRequest();
            if($request->isPost()){
              if($form->isValid($request->getPost())){
              $product_model = new Application_Model_Product();
              $original_filename = $form->image->getFileName(null, false);
              if ($form->image->receive()) {
                //$model->saveUpload($this->_identity, $form->image->getFileName(null, false), $original_filename);
                $product_model->createproduct($request->getParams(),$form->image->getFileName(null, false));
              }

              $this->redirect("/product/list-all");

            }
          }
            $this->view->product_form = $form;
    }

    public function retrieveAction()
    {
        // action body
        $product_model = new Application_Model_Product();
        $p_id = $this->_request->getParam("pid");
        $product = $product_model->productdetails($p_id);
        $this->view->product = $product;
        //var_dump($product[0]);
        //die;
        $reviewModel = new Application_Model_Review();
        $allReviews = $reviewModel->getProductReviews($p_id );
        $this->view->reviews = $allReviews;

        $form = new Application_Form_Comment();
        $request = $this->getRequest();
        if($request->isPost()){
            if($form->isValid($request->getPost())){
                /*echo "<pre>";
                print_r($form);
                echo "</pre>";
                exit;*/
                $data['user_id'] = $this->_request->getParam('user_id'); //$form->getValue('user_id'); //current logged in user from session
                $data['product_id'] = $this->_request->getParam('product_id'); //$form->getValue('product_id'); //current product id
                $data['comment'] = $form->getValue('comment');
                $data['date'] = $form->getValue('date'); //current date-time
                //var_dump($data);
                //die;
                $comment_model = new Application_Model_Review();
                $comment_model-> createData($data);
                $this->redirect('/Product/retrieve/'.$data['product_id']);
            }
        }
        $this->view->comment_form = $form;
    }

    public function listAllAction()
    {
        // action body
        $product_model = new Application_Model_Product();
        $this->view->products = $product_model->displayproduct();

        //$product_form = new Application_Form_Product();
        //$this->view->product_form = $product_form;
    }

    public function shopProductsAction()
    {
        // action body
        $sid = $this->_request->getParam('uid');
        $product_model = new Application_Model_Product();
        $products = $product_model->shopProducts();
        $this->view->products = $products;
    }


}


