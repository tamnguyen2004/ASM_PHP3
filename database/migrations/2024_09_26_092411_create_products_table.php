<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên sản phẩm
            $table->decimal('price', 8, 2); // Giá sản phẩm
            $table->integer('quantity'); // Số lượng sản phẩm
            $table->string('image')->nullable(); // Hình ảnh sản phẩm (có thể null)
            $table->boolean('sale')->default(false); // Cột sản phẩm giảm giá
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Khóa ngoại tham chiếu tới bảng categories
            $table->timestamps(); // Cột created_at và updated_at tự động
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
