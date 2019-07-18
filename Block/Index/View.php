<?php

namespace Xigen\Testimonial\Block\Index;

/**
 * Index Block class
 */
class View extends \Magento\Framework\View\Element\Template
{

    /**
     * @var \Xigen\Testimonial\Model\TestimonialFactory
     */
    protected $testimonial;

    /**
     * @var int
     */
    protected $limit;

    /**
     * Constructor
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Xigen\Testimonial\Model\TestimonialFactory $testimonialFactory,
        array $data = []
    ) {
        $this->testimonialFactory = $testimonialFactory;
        $this->limit = \Xigen\Testimonial\Helper\Testimonial::TESTIMONIALS_PER_PAGE;
        parent::__construct($context, $data);
    }

    /**
     * @return $this|\Magento\Framework\View\Element\Template
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Testimonials'));
        if ($this->getCustomCollection()) {
            $pager = $this->getLayout()
                ->createBlock(
                    \Magento\Theme\Block\Html\Pager::class,
                    'custom.history.pager'
                )
                ->setAvailableLimit([
                    $this->limit * 1 => $this->limit * 1,
                    $this->limit * 2 => $this->limit * 2,
                    $this->limit * 3 => $this->limit * 3,
                ])
                ->setShowPerPage(true)->setCollection(
                    $this->getCustomCollection()
                );
            $this->setChild('pager', $pager);
            $this->getCustomCollection()->load();
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @return mixed
     */
    public function getCustomCollection()
    {
        $get = $this->getRequest()->getParams();
        $page = $get['p'] ?? 1;
        $pageSize = $get['limit'] ?? $this->limit;
        $collection = $this->testimonialFactory
            ->create()
            ->getCollection()
            ->addFieldToFilter("status", ["eq" => \Xigen\Testimonial\Helper\Testimonial::APPROVED]);
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }
}
