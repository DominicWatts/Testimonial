<?php


namespace Xigen\Testimonial\Model\ResourceModel;

/**
 * Testimonials testimonial model resouce model class
 */
class Testimonial extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('xigen_testimonial_testimonial', 'testimonial_id');
    }
}
