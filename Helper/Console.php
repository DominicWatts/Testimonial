<?php

namespace Xigen\Testimonial\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Xigen\Testimonial\Helper\Testimonial;

/**
 * Console helper class
 */
class Console extends AbstractHelper
{
    const COUNTRY_CODE = 'GB';
    const LOCALE_CODE = 'en_GB';

    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \Xigen\Testimonial\Api\Data\TestimonialInterfaceFactory
     */
    private $testimonialInterfaceFactory;

    /**
     * @var \Xigen\Testimonial\Api\TestimonialRepositoryInterface
     */
    private $testimonialRepositoryInterface;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Psr\Log\LoggerInterface $logger,
        \Xigen\Testimonial\Api\Data\TestimonialInterfaceFactory $testimonialInterfaceFactory,
        \Xigen\Testimonial\Api\TestimonialRepositoryInterface $testimonialRepositoryInterface
    ) {
        $this->faker = \Faker\Factory::create(self::LOCALE_CODE);
        $this->logger = $logger;
        $this->testimonialInterfaceFactory = $testimonialInterfaceFactory;
        $this->testimonialRepositoryInterface = $testimonialRepositoryInterface;
        parent::__construct($context);
    }

    /**
     * Create random testimonial
     * @return \Xigen\Testimonial\Model\Data\Testimonial
     */
    public function createTestimonial()
    {
        $testimonial = $this->testimonialInterfaceFactory
            ->create()
            ->setName($this->faker->firstName)
            ->setEmail($this->faker->safeEmail)
            ->setSubject($this->faker->sentence)
            ->setComment($this->faker->paragraph)
            ->setStatus(rand(
                Testimonial::DISAPPROVED,
                Testimonial::APPROVED
            ));
        try {
            $testimonial = $this->testimonialRepositoryInterface
                ->save($testimonial);
            return $testimonial;
        } catch (\Exception $e) {
            $this->logger->critical($e);
        }
    }
}
