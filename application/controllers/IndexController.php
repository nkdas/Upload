<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $form = new Application_Form_Image();
        $form->upload->setLabel('Upload');
        $this->view->form = $form;
        $imageName = $form->getValue('file');
        try {
            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                    $upload = new Zend_File_Transfer_Adapter_Http();
                    $upload->setDestination(APPLICATION_PATH.'/../public/images/');

                    try {
                        // This takes care of the moving and making sure the file is there
                        $upload->receive();
                        // Dump out all the file info
                        Zend_Debug::dump($upload->getFileInfo());
                    } catch (Zend_File_Transfer_Exception $e) {
                        echo $e->message();
                    }

                    $images = new Application_Model_DbTable_Images();
                    $status = $images->addImage($imageName);
                }
            }
        } catch (Exception $ex) {
            echo $ex->message();
        }

        $image_details = new Application_Model_DbTable_Images();
        $this->view->image_details = $image_details->fetchAll();
    }

    public function uploadAction()
    {
        // action body
    }


}



