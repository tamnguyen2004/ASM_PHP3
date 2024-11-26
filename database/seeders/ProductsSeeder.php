<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'iPhone 13 Pro Max',
                'price' => 1099.99,
                'quantity' => 10,
                'image' => 'images/ronaldo.jpg',
                'sale' => false,
                'category_id' => 1, // Đảm bảo giá trị category_id hợp lệ
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S21',
                'price' => 799.99,
                'quantity' => 15,
                'image' => 'images/ronaldo.jpg',
                'sale' => true,
                'category_id' => 1, // Đảm bảo giá trị category_id hợp lệ
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S21',
                'price' => 799.99,
                'quantity' => 15,
                'image' => 'images/ronaldo.jpg',
                'sale' => true,
                'category_id' => 1, // Đảm bảo giá trị category_id hợp lệ
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S21',
                'price' => 799.99,
                'quantity' => 15,
                'image' => 'images/ronaldo.jpg',
                'sale' => true,
                'category_id' => 1, // Đảm bảo giá trị category_id hợp lệ
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S21',
                'price' => 799.99,
                'quantity' => 15,
                'image' => 'images/ronaldo.jpg',
                'sale' => true,
                'category_id' => 1, // Đảm bảo giá trị category_id hợp lệ
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S21',
                'price' => 799.99,
                'quantity' => 15,
                'image' => 'images/ronaldo.jpg',
                'sale' => true,
                'category_id' => 1, // Đảm bảo giá trị category_id hợp lệ
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S21',
                'price' => 799.99,
                'quantity' => 15,
                'image' => 'images/ronaldo.jpg',
                'sale' => true,
                'category_id' => 1, // Đảm bảo giá trị category_id hợp lệ
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S21',
                'price' => 799.99,
                'quantity' => 15,
                'image' => 'images/ronaldo.jpg',
                'sale' => true,
                'category_id' => 1, // Đảm bảo giá trị category_id hợp lệ
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S21',
                'price' => 799.99,
                'quantity' => 15,
                'image' => 'images/ronaldo.jpg',
                'sale' => true,
                'category_id' => 1, // Đảm bảo giá trị category_id hợp lệ
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S21',
                'price' => 799.99,
                'quantity' => 15,
                'image' => 'images/ronaldo.jpg',
                'sale' => true,
                'category_id' => 1, // Đảm bảo giá trị category_id hợp lệ
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Các sản phẩm khác với category_id hợp lệ...
        ]);
        
        
    }
}
