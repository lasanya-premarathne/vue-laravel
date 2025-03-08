<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getAllOrders()
    {
        return response()->json(Order::all());
    }

    public function postOrder(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'order_items' => 'required|array',
            'order_items.*.product_id' => 'required|integer|exists:products,id',
            'order_items.*.quantity' => 'required|integer|min:1',
        ]);

        $total = $this->calculateTotal($validated['order_items']);

        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'contact_number' => $validated['contact_number'],
            'order_items' => json_encode($validated['order_items']),
            'total' => $total,
        ]);

        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }

    public function getOrder(Order $order)
    {
        $order->order_items = json_decode($order->order_items, true);

        return response()->json($order);
    }

    public function updateOrder(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'contact_number' => 'sometimes|string|max:20',
            'order_items' => 'required|array',
            'order_items.*.product_id' => 'required|integer|exists:products,id',
            'order_items.*.quantity' => 'required|integer|min:1',
        ]);

        if (isset($validated['order_items'])) {
            $validated['total'] = $this->calculateTotal($validated['order_items']);
            $validated['order_items'] = json_encode($validated['order_items']);
        }

        $order->update($validated);
        return response()->json($order);
    }

    public function deleteOrder(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }


    // function to calculate total
    private function calculateTotal(array $orderItems): float
    {
        $total = 0;
        foreach ($orderItems as $item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                $total += $product->unit_price * $item['quantity'];
            }
        }
        return $total;
    }
}