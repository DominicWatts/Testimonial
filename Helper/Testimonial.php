<?php


namespace Xigen\Testimonial\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Testimonial helper class
 */
class Testimonial extends AbstractHelper
{

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
    }
}
