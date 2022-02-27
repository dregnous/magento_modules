<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Created By: MageDelight Pvt. Ltd.
 */
namespace Dev\Example\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Dev\Example\Model\Example;

class Save extends \Magento\Backend\App\Action
{
    /*
     * @var Example
     */
    protected $exampleModel;
    /**
     * @var Session
     */
    protected $adminSession;
    /**
     * @param Action\Context $context
     * @param Blog           $exampleModel
     * @param Session        $adminSession
     */
    public function __construct(
        Action\Context $context,
        Example $exampleModel,
        Session $adminSession
    ) {
        parent::__construct($context);
        $this->exampleModel = $exampleModel;
        $this->adminSession = $adminSession;
    }
    /**
     * Save Example record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $this->exampleModel->load($id);
            }
            $this->exampleModel->setData($data);
            try {
                $this->exampleModel->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->adminSession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath('*/*/edit', ['id' => $this->exampleModel->getId(), '_current' => true]);
                    }
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}