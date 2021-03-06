<?php

namespace Xigen\Testimonial\Controller\Adminhtml\Testimonial;

use Magento\Framework\Exception\LocalizedException;

/**
 * Save controller class
 */
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Xigen\Testimonial\Model\TestimonialFactory
     */
    protected $testimonialFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Xigen\Testimonial\Model\TestimonialFactory $testimonialFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->testimonialFactory = $testimonialFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('testimonial_id');

            $model = $this->testimonialFactory
                ->create()
                ->load($id);

            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Testimonial no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Testimonial.'));
                $this->dataPersistor->clear('xigen_testimonial_testimonial');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['testimonial_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage(
                    $e,
                    __('Something went wrong while saving the Testimonial.')
                );
            }

            $this->dataPersistor->set('xigen_testimonial_testimonial', $data);
            return $resultRedirect->setPath('*/*/edit', ['testimonial_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
