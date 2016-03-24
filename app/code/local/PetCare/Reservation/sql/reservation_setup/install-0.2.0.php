<?php
/**
 * Created by PhpStorm.
 * User: Bianca Vadean
 * Date: 20.03.2016
 * Time: 23:37
 */
$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()->newTable($installer->getTable('reservation/reservation'))
    ->addColumn('reservation_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
    ))
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
    ))
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
    ))
    ->addColumn('order_item_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
    ))
    ->addColumn('start_date', Varien_Db_Ddl_Table::TYPE_DATE, null, array(
        'nullable' => false,
    ))
    ->addColumn('end_date', Varien_Db_Ddl_Table::TYPE_DATE, null, array(
        'nullable' =>false,
    ))
    ->addForeignKey($installer->getFkName('reservation/reservation', 'product_id', 'catalog/product', 'entity_id'),
        'product_id',
        $installer->getTable('catalog/product'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
        )
    ->addForeignKey($installer->getFkName('reservation/reservation', 'customer_id', 'customer/entity', 'entity_id'),
        'customer_id',
        $installer->getTable('customer/entity'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->addForeignKey($installer->getFkName('reservation/reservation', 'order_item_id', 'sales/order_item', 'item_id'),
        'order_item_id',
        $installer->getTable('sales/order_item'),
        'item_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    );

$installer->getConnection()->createTable($table);
$installer->endSetup();
