<?php


namespace Xigen\Testimonial\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * InstallSchema class
 */
class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $table_xigen_testimonial_testimonial = $setup->getConnection()
            ->newTable($setup->getTable('xigen_testimonial_testimonial'));

        $table_xigen_testimonial_testimonial->addColumn(
            'testimonial_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_xigen_testimonial_testimonial->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Name'
        );

        $table_xigen_testimonial_testimonial->addColumn(
            'email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Email'
        );

        $table_xigen_testimonial_testimonial->addColumn(
            'subject',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Subject'
        );

        $table_xigen_testimonial_testimonial->addColumn(
            'comment',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            1024,
            [],
            'comment'
        );

        $table_xigen_testimonial_testimonial->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['default' => '0'],
            'Status'
        );

        $table_xigen_testimonial_testimonial->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Created At'
        );

        $table_xigen_testimonial_testimonial->addColumn(
            'updated_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Updated At'
        );

        $setup->getConnection()->createTable($table_xigen_testimonial_testimonial);
    }
}
