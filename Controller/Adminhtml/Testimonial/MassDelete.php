<?php

namespace Xigen\Testimonial\Controller\Adminhtml\Testimonial;

/**
 * Mass-Delete Controller.
 */
class MassDelete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Xigen_Testimonial::top_level';

    /**
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    private $filter;

    /**
     * @var \Xigen\Testimonial\Model\TestimonialFactory
     */
    private $testimonialFactory;

    /**
     * assDelete constructor
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
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $ids = $this->getRequest()->getPost('selected');
        if ($ids) {
            $collection = $this->testimonialFactory->create()
                ->getCollection()
                ->addFieldToFilter('testimonial_id', ['in' => $ids]);
            $collectionSize = $collection->getSize();
            $deletedItems = 0;
            foreach ($collection as $item) {
                try {
                    $item->delete();
                    $deletedItems++;
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                }
            }
            if ($deletedItems != 0) {
                if ($collectionSize != $deletedItems) {
                    $this->messageManager->addErrorMessage(
                        __('Failed to delete %1 testimonial item(s).', $collectionSize - $deletedItems)
                    );
                }
                $this->messageManager->addSuccessMessage(
                    __('A total of %1 testimonial item(s) have been deleted.', $deletedItems)
                );
            }
        }
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
