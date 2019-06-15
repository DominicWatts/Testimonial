<?php
namespace Xigen\Testimonial\Controller\Adminhtml\Testimonial;

/**
 * Mass-Status Controller.
 */
class MassStatus extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Xigen_Testimonial::top_level';
    private $filter;
    private $collectionFactory;
    private $testimonialFactory;

    /**
     * MassStatus constructor
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Ui\Component\MassAction\Filter $filter
     * @param \Xigen\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory $collectionFactory
     * @param \Xigen\Testimonial\Model\TestimonialFactory $testimonialFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Xigen\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory $collectionFactory,
        \Xigen\Testimonial\Model\TestimonialFactory $testimonialFactory
    ) {
        $this->filter = $filter;
        $this->testimonialFactory = $testimonialFactory;
        parent::__construct($context);
    }
    /**
     * Execute action.
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $ids = $this->getRequest()->getPost('selected');
        $status = $this->getRequest()->getParam('status');
        if ($ids) {
            $collection = $this->testimonialFactory->create()
                ->getCollection()
                ->addFieldToFilter('testimonial_id', ['in' => $ids]);
            $collectionSize = $collection->getSize();
            $updatedItems = 0;
            foreach ($collection as $item) {
                try {
                    $item->setStatus($status);
                    $item->save();
                    $updatedItems++;
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                }
            }
            if ($updatedItems != 0) {
                if ($collectionSize != $updatedItems) {
                    $this->messageManager->addErrorMessage(
                        __('Failed to update %1 testimonial item(s).', $collectionSize - $updatedItems)
                    );
                }
                $this->messageManager->addSuccessMessage(
                    __('A total of %1 testimonial item(s) have been updated.', $updatedItems)
                );
            }
        }
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
