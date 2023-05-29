<?php

namespace App\Models;

use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderProduct> $orderProducts
 * @property-read int|null $order_products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['user_id', 'status'];


    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    public function getItems(int $order_id): array
    {
        $order_products = OrderProduct::all()
            ->where('order_id', '=', $order_id);
        $products = array();

        foreach ($order_products as $order_product) {
            $products[] = Product::all()
                ->where('id', '=', $order_product->product_id);

        }
        return $products;
    }

    public function getProductInOrderQuantity(int $order_id, int $product_id): int
    {
        $order_products = OrderProduct::all()->where('order_id', '=', $order_id);

        $order_product_ids = $order_products->where('product_id', '=', $product_id);
        foreach ($order_product_ids as $order_product_id) {
            $product_quantity = $order_product_id->quantity;
        }
        return $product_quantity;
    }

}
