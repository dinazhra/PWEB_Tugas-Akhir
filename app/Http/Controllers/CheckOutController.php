<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Pupuk;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckOutController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HELPER — buat notifikasi
    |--------------------------------------------------------------------------
    */

    private function notifyAdmin(string $type, string $message, array $data = [])
    {
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'type'    => $type,
                'message' => $message,
                'data'    => $data,
                'is_read' => false,
            ]);
        }
    }

    private function notifyUser(int $userId, string $type, string $message, array $data = [])
    {
        Notification::create([
            'user_id' => $userId,
            'type'    => $type,
            'message' => $message,
            'data'    => $data,
            'is_read' => false,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function showCheckout()
    {
        // BUY NOW
        if (session()->has('buy_now_product')) {

            $pupuk = Pupuk::find(session('buy_now_product'));

            if (!$pupuk) {
                session()->forget('buy_now_product');
                return redirect()->route('pupuk.index')->with('error', 'Produk tidak ditemukan!');
            }

            $total = $pupuk->harga;
            return view('checkout', compact('pupuk', 'total'));
        }

        // CART
        $carts = Cart::with('pupuk')->where('user_id', auth()->id())->get();

        if ($carts->count() < 1) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong!');
        }

        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->qty * $cart->pupuk->harga;
        }

        return view('checkout', compact('carts', 'total'));
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function checkout(Request $request)
    {
        $request->validate([
            'nama_penerima'     => 'required',
            'no_hp'             => 'required',
            'alamat'            => 'required',
            'metode_pembayaran' => 'required|in:COD,Transfer Bank',
        ]);

        DB::beginTransaction();

        try {

            $status = $request->metode_pembayaran == 'COD'
                ? 'diproses'
                : 'menunggu_pembayaran';

            /*
            |--------------------------------------------------------------
            | BUY NOW
            |--------------------------------------------------------------
            */

            if (session()->has('buy_now_product')) {

                $pupuk = Pupuk::findOrFail(session('buy_now_product'));

                if ($pupuk->stok < 1) {
                    return back()->with('error', 'Stok habis!');
                }

                $transaction = Transaction::create([
                    'user_id'           => auth()->id(),
                    'nama_penerima'     => $request->nama_penerima,
                    'no_hp'             => $request->no_hp,
                    'alamat'            => $request->alamat,
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'catatan'           => $request->catatan,
                    'total'             => $pupuk->harga,
                    'status'            => $status,
                ]);

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'pupuk_id'       => $pupuk->id,
                    'qty'            => 1,
                    'harga'          => $pupuk->harga,
                    'subtotal'       => $pupuk->harga,
                ]);

                $pupuk->decrement('stok', 1);

                // Notifikasi ke admin
                $this->notifyAdmin(
                    'new_order',
                    'Pesanan baru #' . $transaction->id . ' dari ' . auth()->user()->name,
                    ['transaction_id' => $transaction->id]
                );

                // Cek stok pupuk
                if ($pupuk->stok <= 5) {
                    $this->notifyAdmin(
                        'low_stock',
                        'Stok ' . $pupuk->nama . ' hampir habis (' . $pupuk->stok . ' tersisa)',
                        ['pupuk_id' => $pupuk->id]
                    );
                }

                session()->forget('buy_now_product');
                DB::commit();

                if ($request->metode_pembayaran == 'Transfer Bank') {
                    return redirect()->route('payment.form', $transaction->id);
                }

                return redirect()->route('pesanan')->with('success', 'Pembelian berhasil!');
            }

            /*
            |--------------------------------------------------------------
            | CHECKOUT CART
            |--------------------------------------------------------------
            */

            $carts = Cart::with('pupuk')->where('user_id', auth()->id())->get();

            if ($carts->count() < 1) {
                return back()->with('error', 'Keranjang kosong!');
            }

            $total = 0;
            foreach ($carts as $cart) {
                if ($cart->qty > $cart->pupuk->stok) {
                    return back()->with('error', 'Stok ' . $cart->pupuk->nama . ' tidak cukup!');
                }
                $total += $cart->qty * $cart->pupuk->harga;
            }

            $transaction = Transaction::create([
                'user_id'           => auth()->id(),
                'nama_penerima'     => $request->nama_penerima,
                'no_hp'             => $request->no_hp,
                'alamat'            => $request->alamat,
                'metode_pembayaran' => $request->metode_pembayaran,
                'catatan'           => $request->catatan,
                'total'             => $total,
                'status'            => $status,
            ]);

            foreach ($carts as $cart) {
                $subtotal = $cart->qty * $cart->pupuk->harga;

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'pupuk_id'       => $cart->pupuk_id,
                    'qty'            => $cart->qty,
                    'harga'          => $cart->pupuk->harga,
                    'subtotal'       => $subtotal,
                ]);

                $cart->pupuk->decrement('stok', $cart->qty);

                // Cek stok masing-masing produk
                $cart->pupuk->refresh();
                if ($cart->pupuk->stok <= 5) {
                    $this->notifyAdmin(
                        'low_stock',
                        'Stok ' . $cart->pupuk->nama . ' hampir habis (' . $cart->pupuk->stok . ' tersisa)',
                        ['pupuk_id' => $cart->pupuk_id]
                    );
                }
            }

            Cart::where('user_id', auth()->id())->delete();

            // Notifikasi ke admin
            $this->notifyAdmin(
                'new_order',
                'Pesanan baru #' . $transaction->id . ' dari ' . auth()->user()->name,
                ['transaction_id' => $transaction->id]
            );

            DB::commit();

            if ($request->metode_pembayaran == 'Transfer Bank') {
                return redirect()->route('payment.form', $transaction->id);
            }

            return redirect()->route('pesanan')->with('success', 'Checkout berhasil!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Checkout gagal! ' . $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | BELI LANGSUNG
    |--------------------------------------------------------------------------
    */

    public function buyNow($id)
    {
        $pupuk = Pupuk::findOrFail($id);

        if ($pupuk->stok < 1) {
            return back()->with('error', 'Stok habis!');
        }

        session(['buy_now_product' => $pupuk->id]);
        return redirect()->route('checkout.form');
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN PAYMENT
    |--------------------------------------------------------------------------
    */

    public function paymentForm($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transaction.payment', compact('transaction'));
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES PAYMENT
    |--------------------------------------------------------------------------
    */

    public function paymentProcess(Request $request, $id)
    {
        $request->validate([
            'nama_pengirim'    => 'required',
            'bank_pengirim'    => 'required',
            'nominal_transfer' => 'required|numeric',
            'bukti_transfer'   => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $transaction = Transaction::findOrFail($id);

        $fileName = null;

        if ($request->hasFile('bukti_transfer')) {
            $fileName = time() . '.' . $request->bukti_transfer->extension();
            $request->bukti_transfer->move(public_path('uploads/bukti-transfer'), $fileName);
        }

        $transaction->update([
            'nama_pengirim'    => $request->nama_pengirim,
            'bank_pengirim'    => $request->bank_pengirim,
            'nominal_transfer' => $request->nominal_transfer,
            'bukti_transfer'   => $fileName,
            'status'           => 'menunggu_verifikasi',
        ]);

        // Notifikasi ke admin — bukti transfer masuk
        $this->notifyAdmin(
            'payment_proof',
            'Bukti transfer pesanan #' . $transaction->id . ' dari ' . auth()->user()->name . ' telah dikirim',
            ['transaction_id' => $transaction->id]
        );

        return redirect()->route('pesanan')->with('success', 'Bukti transfer berhasil dikirim!');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS PESANAN
    |--------------------------------------------------------------------------
    */

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required']);

        $transaction = Transaction::findOrFail($id);
        $oldStatus   = $transaction->status;

        $transaction->update(['status' => $request->status]);

        // Notifikasi ke customer kalau status berubah
        if ($oldStatus !== $request->status) {

            $statusLabel = [
                'diproses'           => 'sedang diproses',
                'dikirim'            => 'sedang dikirim',
                'selesai'            => 'telah selesai',
                'menunggu_pembayaran'=> 'menunggu pembayaran',
                'menunggu_verifikasi'=> 'menunggu verifikasi',
            ];

            $label = $statusLabel[$request->status] ?? $request->status;

            $this->notifyUser(
                $transaction->user_id,
                'order_status',
                'Pesanan #' . $transaction->id . ' ' . $label,
                ['transaction_id' => $transaction->id]
            );
        }

        return back()->with('success', 'Status berhasil diperbarui!');
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN PESANAN CUSTOMER
    |--------------------------------------------------------------------------
    */

    public function pesanan()
    {
        $transactions = Transaction::with('items.pupuk')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pesanan', compact('transactions'));
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN PESANAN ADMIN
    |--------------------------------------------------------------------------
    */

    public function adminPesanan()
    {
        $transactions = Transaction::with('items.pupuk', 'user')
            ->latest()
            ->get();

        return view('admin.pesanan', compact('transactions'));
    }

/*
    |--------------------------------------------------------------------------
    | LAPORAN ADMIN
    |--------------------------------------------------------------------------
    */

    public function laporan()
    {
        $validStatus = ['diproses', 'dikirim', 'selesai'];

        $transactions = Transaction::with(['user', 'items.pupuk'])
            ->whereIn('status', $validStatus)
            ->latest()
            ->get();

        $totalPendapatan = $transactions->sum('total');
        $totalPesanan    = $transactions->count();
        $totalProduk     = $transactions->sum(function ($trx) {
            return $trx->items->sum('qty');
        });

        // MYSQL COMPATIBLE
        $chartData = Transaction::selectRaw(
                'MONTH(created_at) as bulan,
                SUM(total) as total'
            )
            ->whereIn('status', $validStatus)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $namaBulan = [
            1  => 'Jan',
            2  => 'Feb',
            3  => 'Mar',
            4  => 'Apr',
            5  => 'Mei',
            6  => 'Jun',
            7  => 'Jul',
            8  => 'Agu',
            9  => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        ];

        $labels = [];
        $data   = [];

        foreach ($chartData as $item) {
            $bulan = (int) $item->bulan;

            $labels[] = $namaBulan[$bulan] ?? $bulan;
            $data[]   = (float) $item->total;
        }

        return view('admin.laporan', compact(
            'transactions',
            'totalPendapatan',
            'totalPesanan',
            'totalProduk',
            'labels',
            'data'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | INVOICE
    |--------------------------------------------------------------------------
    */

    public function invoice($id)
    {
        $transaction = Transaction::with('items.pupuk')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('invoice', compact('transaction'));
    }

    /*
    |--------------------------------------------------------------------------
    | BATAL CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function cancelCheckout()
    {
        session()->forget('buy_now_product');
        return redirect()->route('pupuk.index')->with('success', 'Checkout dibatalkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | KONFIRMASI PESANAN DITERIMA — oleh customer
    |--------------------------------------------------------------------------
    */
 
    public function confirmReceived($id)
    {
        $transaction = Transaction::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();
 
        // Hanya bisa konfirmasi kalau status = dikirim
        if ($transaction->status !== 'dikirim') {
            return back()->with('error', 'Pesanan tidak dapat dikonfirmasi.');
        }
 
        $transaction->update(['status' => 'selesai']);
 
        // Notifikasi ke admin
        $this->notifyAdmin(
            'order_status',
            'Pesanan #' . $transaction->id . ' telah dikonfirmasi diterima oleh ' . auth()->user()->name,
            ['transaction_id' => $transaction->id]
        );
 
        return back()->with('success', 'Pesanan #' . $transaction->id . ' berhasil dikonfirmasi diterima!');
    }
}