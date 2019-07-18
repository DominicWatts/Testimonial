<?php

namespace Xigen\Testimonial\Block\Adminhtml\Testimonial\Edit;

use Magento\Backend\Block\Widget\Context;

/**
 * GenericButton class
 */
abstract class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * Return model ID
     * @return int|null
     */
    public function getModelId()
    {
        return $this->context->getRequest()->getParam('testimonial_id');
    }

    /**
     * Generate url by route and parameters
     * @param string $route
     * @param array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
