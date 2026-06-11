<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Pupuk;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('pupuk')
            ->where('user_id', auth()->id())
            ->get();

        $total = 0;

        foreach ($carts as $item) {

            $total +=
                $item->qty *
                $item->pupuk->harga;
        }

        return view(
            'cart.index',
            compact('carts', 'total')
        );
    }

    public function add($id)
    {
    $pupuk = Pupuk::findOrFail($id);

    $cart = Cart::where('user_id', auth()->id())
        ->where('pupuk_id', $id)
        ->first();

    $currentQty = $cart ? $cart->qty : 0;

    // cek stok sebelum tambah
    if ($currentQty + 1 > $pupuk->stok) {
        return redirect()->back()->with(
            'error',
            'Stok tidak mencukupi. Stok tersedia: ' . $pupuk->stok
        );
    }

    if ($cart) {
        $cart->qty += 1;
        $cart->save();
    } else {
        Cart::create([
            'user_id'  => auth()->id(),
            'pupuk_id' => $id,
            'qty'      => 1,
        ]);
    }

    return redirect()->route('cart.index')
        ->with('success', 'Produk berhasil masuk keranjang');
    }

    public function update(Request $request, $id)
    {
    $cart = Cart::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    // cek stok sebelum update qty
    if ($request->qty > $cart->pupuk->stok) {
        return redirect()->back()->with(
            'error',
            'Stok tidak mencukupi. Stok tersedia: ' . $cart->pupuk->stok
        );
    }

    if ($request->qty < 1) {
        return redirect()->back()->with(
            'error',
            'Jumlah minimal 1'
        );
    }

    $cart->update(['qty' => $request->qty]);

    return back()->with('success', 'Jumlah produk diperbarui');
    }   

    public function remove($id)
    {
        $cart = Cart::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $cart->delete();

        return back()->with(
            'success',
            'Produk dihapus dari keranjang'
        );
    }
}