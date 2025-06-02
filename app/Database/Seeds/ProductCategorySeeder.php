<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $data=[
            [
                'category_name' => 'Laptop',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_name' => 'Laptop',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_name' => 'Laptop',
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ];
        foreach($data as $item){
            $this->db->table('product_category')->insert($item);
        }
    }
}
