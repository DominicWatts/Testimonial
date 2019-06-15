<?php


namespace Xigen\Testimonial\Model\ResourceModel\Testimonial;

/**
 * Testimonial Collection class
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Xigen\Testimonial\Model\Testimonial::class,
            \Xigen\Testimonial\Model\ResourceModel\Testimonial::class
        );
    }
}
