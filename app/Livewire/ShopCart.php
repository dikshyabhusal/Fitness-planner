<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; // make sure alias exists in config/app or import correctly

class ShopCart extends Component
{
    public array $cart = []; // each item: ['product_id' => int, 'qty' => int]
    public $productsList = []; // simple array of product data (id,name,price,stock,image) to avoid passing Eloquent

    public function mount()
    {
        // load products (only essential fields) — avoids passing models to Livewire
        $this->productsList = Product::where('stock', '>', 0)
            ->get(['id','name','price','stock','image'])
            ->map(fn($p)=> $p->toArray())
            ->toArray();
    }

    public function addToCart($productId)
    {
        foreach ($this->cart as &$item) {
            if ($item['product_id'] == $productId) {
                // increment but not exceed stock
                $stock = $this->getProductStock($productId);
                $item['qty'] = min($stock, $item['qty'] + 1);
                return;
            }
        }
        $this->cart[] = ['product_id' => (int)$productId, 'qty' => 1];
    }

    public function increase($index)
    {
        if (!isset($this->cart[$index])) return;
        $stock = $this->getProductStock($this->cart[$index]['product_id']);
        $this->cart[$index]['qty'] = min($stock, $this->cart[$index]['qty'] + 1);
    }

    public function decrease($index)
    {
        if (!isset($this->cart[$index])) return;
        $this->cart[$index]['qty'] = max(1, $this->cart[$index]['qty'] - 1);
    }

    public function remove($index)
    {
        if (!isset($this->cart[$index])) return;
        array_splice($this->cart, $index, 1);
    }

    private function getProductStock($productId)
    {
        // read current stock live from DB to avoid stale values
        $p = Product::find($productId);
        return $p ? (int)$p->stock : 0;
    }

    public function getCartTotalProperty()
    {
        $total = 0;
        foreach ($this->cart as $item) {
            $p = Product::find($item['product_id']);
            if ($p) $total += $p->price * $item['qty'];
        }
        return $total;
    }

    public function checkout()
    {
        if (empty($this->cart)) {
            $this->dispatchBrowserEvent('notify', ['type'=>'error','message'=>'Your cart is empty.']);
            return;
        }

        // calculate final total and create order
        $total = 0;
        foreach ($this->cart as $item) {
            $p = Product::find($item['product_id']);
            if (!$p) {
                $this->dispatchBrowserEvent('notify', ['type'=>'error','message'=>'Product not found.']);
                return;
            }
            if ($p->stock < $item['qty']) {
                $this->dispatchBrowserEvent('notify', ['type'=>'error','message'=>"Not enough stock for {$p->name}"]);
                return;
            }
            $total += $p->price * $item['qty'];
        }

        $order = Order::create([
            'student_id' => Auth::id(),
            'total_amount' => $total,
            'status' => 'Paid' // assume instant payment or set to 'Pending' if implementing gateway
        ]);

        foreach ($this->cart as $item) {
            $p = Product::find($item['product_id']);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $p->id,
                'quantity' => $item['qty'],
                'price' => $p->price
            ]);
            // decrement stock
            $p->decrement('stock', $item['qty']);
        }

        // clear cart
        $this->cart = [];

        // Option 1: Redirect to invoice page
        return redirect()->route('order.invoice', $order->id);
    }

    public function render()
    {
        return view('livewire.shop-cart', [
            'products' => $this->productsList,
            'cart' => $this->cart,
            'cartTotal' => $this->cartTotal,
        ]);
    }
}
