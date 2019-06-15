<?php


namespace Xigen\Testimonial\Block\Index;

/**
 * Index Block class
 */
class Index extends \Magento\Framework\View\Element\Template
{

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Xigen\Testimonial\Helper\Testimonial $helper,
        array $data = []
    ) {
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * Returns action url for testimonial form
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('*/*/submit', ['_secure' => true]);
    }

    /**
     * Workaround for $this being deprecated
     * @return \Magento\Contact\Helper\Data
     */
    public function getHelper()
    {
        return $this->helper;
    }
}
