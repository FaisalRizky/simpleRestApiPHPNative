<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PaymentDetailMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */

    public function change(): void
    {
		 // create the table
        $table = $this->table('transactions_detail');
        $table->addColumn('invoice_id', 'string')
			  ->addColumn('references_id', 'string')
              ->addColumn('item_name', 'string')
			  ->addColumn('amount', 'float')
			  ->addColumn('payment_type', 'string')
			  ->addColumn('customer_name', 'string')
			  ->addColumn('merchant_id', 'string')
			  ->addColumn('number_va', 'string', ['null' => true])
			  ->addColumn('status', 'string')
			  ->addColumn('created_at', 'timestamp')
              ->addColumn('updated_at', 'timestamp', ['null' => true])
			  ->create();
    }
}
