<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Conversation;
use App\Models\Establishment;
use App\Models\FrequentlyAskedQuestion;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Schedule;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $owner = User::where('email', 'establishment.admin@nyva.test')->firstOrFail();

        $establishment = Establishment::factory()->create([
            'user_id' => $owner->id,
            'name' => 'NYVA Demo Restaurant',
            'type' => 'restaurant',
            'status' => 'active',
        ]);

        $plan = Plan::where('status', 'active')->firstOrFail();

        Subscription::create([
            'establishment_id' => $establishment->id,
            'plan_id' => $plan->id,
            'billing_period' => 'monthly',
            'start_date' => now()->toDateString(),
            'end_date' => now()->addMonth()->toDateString(),
            'status' => 'active',
        ]);

        $categories = Category::factory()->count(2)->create([
            'establishment_id' => $establishment->id,
        ]);

        $products = collect();

        foreach ($categories as $category) {
            $createdProducts = Product::factory()->count(3)->create([
                'category_id' => $category->id,
            ]);
            $products = $products->merge($createdProducts);
        }

        foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day) {
            Schedule::factory()->create([
                'establishment_id' => $establishment->id,
                'day_of_week' => $day,
            ]);
        }

        FrequentlyAskedQuestion::factory()->count(3)->create([
            'establishment_id' => $establishment->id,
        ]);

        Conversation::factory()->count(2)->create([
            'establishment_id' => $establishment->id,
        ]);

        $order = Order::factory()->create([
            'establishment_id' => $establishment->id,
            'total' => 0,
        ]);

        $total = 0;

        foreach ($products->take(2) as $index => $product) {
            $quantity = $index + 1;
            $unitPrice = (float) $product->price;
            $subtotal = round($unitPrice * $quantity, 2);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $order->update([
            'total' => round($total, 2),
        ]);
    }
}
