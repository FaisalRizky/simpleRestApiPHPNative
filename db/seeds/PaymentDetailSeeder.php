<?php


use Phinx\Seed\AbstractSeed;

class PaymentDetailSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
		$faker = Faker\Factory::create();
        $data = [];
		$paymentType = ["Virtual Account", "Credit Card"];
		$status = ["Pending", "Paid", "Failed"];
		//Data For Testing
		$data[] = [
            'invoice_id'    => $faker->uuid,
			'references_id' => "81261525251515",
            'item_name'     => $faker->bs,
			'payment_type'  => "Virtual Account",
            'amount'    	=> $faker->randomFloat($nbMaxDecimals = 2, $min = 100000, $max = 500000),
            'customer_name' => $faker->name,
			'merchant_id'   => "64649119122151",
            'status' 	    => "PENDING",
            'number_va'     => $faker->numerify('###-##########'),
			'created_at'    => date('Y-m-d H:i:s'),
			'updated_at'    => date('Y-m-d H:i:s'),
            ];
        for ($i = 0; $i < 20; $i++) {
			$paymentTypeFaker = $paymentType[array_rand($paymentType)];
			$statusFaker = $status[array_rand($status)];
            $data[] = [
                'invoice_id'    => $faker->uuid,
				'references_id' => rand(1,9).$faker->ean13,
                'item_name'     => $faker->bs,
				'payment_type'  => $paymentTypeFaker,
                'amount'    	=> $faker->randomFloat($nbMaxDecimals = 2, $min = 100000, $max = 500000),
                'customer_name' => $faker->name,
				'merchant_id'   => rand(1,9).$faker->ean13,
                'status' 	    => $statusFaker,
                'number_va'     => $paymentTypeFaker == "Virtual Account" ? $faker->numerify('###-##########') : null,
				'created_at'    => date('Y-m-d H:i:s'),
				//'updated_at'    => date('Y-m-d H:i:s'),
            ];
        }

        $this->table('transactions_detail')->insert($data)->saveData();
    }
}
