<?php

class WishlistController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body

        $wishlist_model=new Application_Model_Wishlist();
        $uid=1;
        $wishlist=$wishlist_model->wishlist($uid);
        $product_model=new Application_Model_Product();
          $array=array();
          foreach ($wishlist as $key => $value ) {
            if($key == "productid"){
            $array[]=$product_model->productdetails($value);
            }
          $defaultNamespace = new Zend_Session_Namespace('Default');
             $defaultNamespace->session_array=  $array;
            # code...


          }

        $this->view->wishlist_user = $wishlist;
        $this->view->prd_array=$array;

    }

    public function addAction()
    {
      //  $product_id=$this->_request->getParam("uid");
       $product_id=3;
       $user_id=3;
       $wishlist_model = new Application_Model_Wishlist();
        $check=$wishlist_model->find($product_id,$user_id)->toArray();
        if(!empty($check))
        {
          echo "already added before";
        }
        else{
          //addNewproduct
          $row=$wishlist_model->createRow();
          $row->userid=$user_id;
          $row->productid=$product_id;
          $row->save();
          echo"sucessfully added";
          
        }


    }

    public function removeAction()
    {
        // action body
      $product_id=3;
       $user_id=3;
       $wishlist_model = new Application_Model_Wishlist();
        $wishlist_model->delete("productid=$product_id");
    }

    public function checkuniqueAction($prd_id,$u_id)
    {
        // action body

        $check=$this->find($prd_id,$u_id)->toArray();
        if(!empty($check))
        {
            return TRUE;
        }
        else{
          return FALSE;
        }


    }


}
