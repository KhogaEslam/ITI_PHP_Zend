    public function displayAction()
    {
        // action body
        $product_model=new Application_Model_Product ();
        $this->view->product=$product_model->displayproduct();



    }

    public function detailsAction()
    {
        // action body
      $product_model=new Application_Model_Product();
       $product_id=$this->_request->getParam("uid");
       $product=$product_model->productdetails($product_id);
       $this->view->product = $product;


    }

    public function addAction()
    {
        // action body
        $form = new Application_Form_Productform();
        $request = $this->getRequest();
        if($request->isPost()){
        if($form->isValid($request->getPost())){
        $product_model = new Application_Model_Product();
        $product_model-> addNewproduct($request->getParams());
        $this->redirect('/product/display');
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
    $this->redirect("/product/display");
    }

    public function updateAction()
    {
        // action body
        $form = new Application_Form_Productform();
        $id = $this->_request->getParam('uid');
        $product_model = new Application_Model_Product();
        $data = $product_model ->productdetails($id);
        $form->populate($data);
        $request = $this->getRequest();
        if($request->isPost()){
          if($form->isValid($request->getPost())){
          $product_model = new Application_Model_Product();
          $original_filename = $form->image->getFileName(null, false);
          if ($form->image->receive()) {
            //$model->saveUpload($this->_identity, $form->image->getFileName(null, false), $original_filename);
            $product_model->updateproduct($id,$request->getParams(),$form->image->getFileName(null, false));
          }

          $this->redirect("/product/display");

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

              $this->redirect("/product/display");

            }
          }
            $this->view->product_form = $form;
        }



}
