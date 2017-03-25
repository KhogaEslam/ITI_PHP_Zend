
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
        // $product_model=new Application_Model_Product();
        //$product_model->getTopProducts();
    }

    public function displayAction()
    {
        // action body
        $this->_helper->_layout->setLayout('home');

        $product_model = new Application_Model_Product();
        $this->view->product = $product_model->displayproduct();
    }

    public function detailsAction()
    {
        $product_model = new Application_Model_Product();
        $product_id = $this->_request->getParam("pid");
        $product = $product_model->productdetails($product_id);
        $this->view->product = $product[0];
        // var_dump($product);
        // die;

    }

    public function addAction()
    {
        // action body
        $form = new Application_Form_Productform();
        $request = $this->getRequest();
        if ($request->isPost()) {
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
        $product_id = $this->_request->getParam("uid");
        $product = $product_model->deleteproduct($product_id);
        $this->redirect("/product/list-all");
    }

    public function updateAction()
    {
        // action body
        $form = new Application_Form_Productform();
        $id = $this->_request->getParam('pid');
        $product_model = new Application_Model_Product();
        $data = $product_model->productdetails($id)[0];
        $form->populate($data);
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $product_model = new Application_Model_Product();
                //$original_filename = $form->image->getFileName(null, false);
                if ($form->image->receive()) {
                    //$model->saveUpload($this->_identity, $form->image->getFileName(null, false), $original_filename);
                    $image = $form->image->getFileName(null, false);
                    $product_model->updateproduct($id, $request->getParams(), $image);
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
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $product_model = new Application_Model_Product();
                $original_filename = $form->image->getFileName(null, false);
                if ($form->image->receive()) {
                    //$model->saveUpload($this->_identity, $form->image->getFileName(null, false), $original_filename);
                    $product_model->createproduct($request->getParams(), $form->image->getFileName(null, false));
                }

                $this->redirect("/product/list-all");

            }
        }
        $this->view->product_form = $form;
    }

    public function retrieveAction()
    {

        // action body
        $this->_helper->_layout->setLayout('home');

        // action body
        $product_model = new Application_Model_Product();
        $p_id = $this->_request->getParam("pid");
        $product = $product_model->productdetails($p_id)[0];
        $this->view->product = $product;
        //var_dump($product[0]);
        //die;
        $reviewModel = new Application_Model_Review();
        $allReviews = $reviewModel->getProductReviews($p_id);
        $this->view->reviews = $allReviews;

        $form = new Application_Form_Comment();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
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
                $comment_model->createData($data);
                $this->redirect('/Product/retrieve/' . $data['product_id']);
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


    public function avgrateAction()
    {
        $product_rate = $this->_request->getParam("rate");
        $product_id = $this->_request->getParam("pid");
        $user_id = $this->_request->getParam("uid");

        $product_model = new Application_Model_Product();
        $Rate = new Application_Model_Rate();
        $Rate->addRate($product_rate, $user_id, $product_id);
        $db = zend_Db_Table::getDefaultAdapter();
        echo "<pre>";
        $rates = $Rate->fetchAll("pro_id=$product_id")->toArray();
        $sum = 0;
        $num = 0;
        foreach($rates as $key=>$value){
            $sum += $value['rate'];
            $num+=1;
        }
        $avg_rate = intval($sum/$num);
        $product_model->updateRate($avg_rate, $product_id);

        $this->redirect("/product/detailsforcustomer/pid/".$product_id);
    }

    //--------------------------search-----------------
    public function searchAction()
    {
        // $this->_helper->viewRenderer->setNoRender();
        // $this->_helper->getHelper('layout')->disableLayout();
        // $product_name = $this->_request->getParam('name');
        // $product = (new Application_Model_Product())->searchByPname($product_name);

        // var_dump(json_encode($product));
    }

    //---------------------------------------------

    public function statisticsAction()
    {
        $history_model = new Application_Model_History();
        $data = $history_model->product_statistics();
        $this->view->statisticproduct = $data;
        return $data;

    }
    // public function categorystatisticsAction()
    // // {
    // //   $TopProduct_model = new Application_Model_VW_TopSoldItems();

    // //   $this->view->statisticcategory=  $TopProduct_model->category_statistics();
    // // }

    public function displayforcustomerAction()
    {
        // action body
        $product_model = new Application_Model_Product();
        $this->view->product = $product_model->displayproduct();
    }

    public function detailsforcustomerAction()
    {
        $user_model = new Application_Model_User();
        $user_id = $user_model->getCurrentLoggedInUserID();
        $this->_helper->_layout->setLayout('home');
        $product_model = new Application_Model_Product();
        $product_id = (int)$this->_request->getParam("pid");
        $product = $product_model->productdetails($product_id)[0];
        $this->view->product = $product;
        $wishlist_model = new Application_Model_Wishlist();
        $check = $wishlist_model->find($user_id,$product_id)->toArray();
        $this->view->check = $check;

        $offer_model = new Application_Model_Offer();
        $offer = $offer_model->find($product_id)->toArray()[0];
        $this->view->offer = $offer;

        $reviews_model = new Application_Model_Review();
        $reviews = $reviews_model->getProductReviews($product_id);
        $this->view->reviews = $reviews;

        $users = "";
        foreach ($reviews as $key => $value){
            $users[$key] = $user_model->find($value['user_id'])->toArray()[0];
        }

        $this->view->users = $users;


        // action body
        $form = new Application_Form_Comment();
        $request = $this->getRequest();
        if($request->isPost()){
            if($form->isValid($request->getPost())){
                /*echo "<pre>";
                print_r($form);
                echo "</pre>";
                exit;*/
                $data['user_id'] = $user_id;
                $data['product_id'] = $product_id;
                $data['comment'] = $form->getValue('comment');
                $data['date'] = $form->getValue('date'); //current date-time
                $comment_model = new Application_Model_Review();
                $comment_model-> createData($data);
                $this->redirect("/product/detailsforcustomer/pid/".$product_id);
            }
        }
        $this->view->comment_form = $form;

    }

    public function addtowishlistAction()
    {
        $user_model = new Application_Model_User();
        $user_id = $user_model->getCurrentLoggedInUserID();
        $product_id = (int)$this->_request->getParam("pid");
        $wishlist_model = new Application_Model_Wishlist();
        $check = $wishlist_model->find($product_id, $user_id)->toArray();
        //$this->view->check = $check;
        if (!empty($check)) {
            echo "already added before";
        } else {
            //addNewproduct
            $add = $wishlist_model->add($user_id, $product_id);
            // echo"sucessfully added";
        }
        $this->redirect('/product/detailsforcustomer/pid/'.$product_id);
    }

    public function removeAction()
    {
        // action body
        $user_model = new Application_Model_User();
        $user_id = $user_model->getCurrentLoggedInUserID();
        $product_id = $this->_request->getParam("pid");
        $wishlist_model = new Application_Model_Wishlist();
        $wishlist_model->deleteData($product_id ,$user_id);
        $this->redirect('/product/detailsforcustomer/pid/'.$product_id);
    }

    public function gettopproductsAction()
    {
        $product_model = new Application_Model_Product();
        $cat_model = new Application_Model_Category();
        $tops = $product_model->TopProducts();
        $asize = sizeof($tops);
        $fullDetails = "";
        for ($i=0; $i<$asize; $i++){
            $cat_id = $tops[$i]['id'];
            $cate = $cat_model->categoryDetails($cat_id);
            $p_id = $tops[$i]['productID'];
            $pro = $product_model->productdetails($p_id);
            $fullDetails[$i]['cate'] = $cate;
            $fullDetails[$i]['pro'] = $pro;
        }
        $this->view->topproduct = $fullDetails;

    }

}

