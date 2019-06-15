<?php


namespace Xigen\Testimonial\Model\ResourceModel\Testimonial;

/**
 * Testimonial Collection class
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'testimonial_id';

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
