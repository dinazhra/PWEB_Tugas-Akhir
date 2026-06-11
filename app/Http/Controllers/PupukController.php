<?php

namespace App\Http\Controllers;

use App\Models\Pupuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PupukController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST PRODUK
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pupuks = Pupuk::latest()->paginate(10);

        return view('pupuk.index', compact('pupuks'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        return view('pupuk.create');
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN PRODUK
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        $request->validate([
            'kode'          => 'required|unique:pupuks,kode',
            'nama'          => 'required|min:3',
            'kategori'      => 'required|in:Kimia,Organik,Bio,Cair',
            'stok'          => 'required|integer|min:0',
            'harga'         => 'required|numeric|min:1',
            'tanggal_masuk' => 'required|date',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto');

        /*
        |--------------------------------------------------------------------------
        | Upload Foto
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {
            $data['foto'] = $request
                ->file('foto')
                ->store('foto-pupuk', 'public');
        }

        $data['user_id'] = auth()->id();

        Pupuk::create($data);

        return redirect()
            ->route('pupuk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function show(Pupuk $pupuk)
    {
        return view('pupuk.show', compact('pupuk'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Pupuk $pupuk)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        return view('pupuk.edit', compact('pupuk'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PRODUK
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Pupuk $pupuk)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        $request->validate([
            'kode'          => 'required|unique:pupuks,kode,' . $pupuk->id,
            'nama'          => 'required|min:3',
            'kategori'      => 'required|in:Kimia,Organik,Bio,Cair',
            'stok'          => 'required|integer|min:0',
            'harga'         => 'required|numeric|min:1',
            'tanggal_masuk' => 'required|date',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto');

        /*
        |--------------------------------------------------------------------------
        | Upload Foto Baru
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            // hapus foto lama
            if ($pupuk->foto &&
                Storage::disk('public')->exists($pupuk->foto)) {
                Storage::disk('public')->delete($pupuk->foto);
            }

            // upload baru
            $data['foto'] = $request
                ->file('foto')
                ->store('foto-pupuk', 'public');
        }

        $pupuk->update($data);

        return redirect()
            ->route('pupuk.index')
            ->with('success', 'Produk berhasil diupdate!');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS PRODUK
    |--------------------------------------------------------------------------
    */

    public function destroy(Pupuk $pupuk)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        // hapus foto dari storage
        if ($pupuk->foto &&
            Storage::disk('public')->exists($pupuk->foto)) {
            Storage::disk('public')->delete($pupuk->foto);
        }

        $pupuk->delete();

        return redirect()
            ->route('pupuk.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    /*
    |--------------------------------------------------------------------------
    | LIVE SEARCH
    |--------------------------------------------------------------------------
    */

    public function liveSearch(Request $request)
    {
        $search = $request->search;

        $pupuks = Pupuk::where(function ($q) use ($search) {
            $q->where('nama', 'LIKE', "%{$search}%")
              ->orWhere('kode', 'LIKE', "%{$search}%");
        })->latest()->get();

        $output = '';

        if ($pupuks->count() > 0) {

            foreach ($pupuks as $pupuk) {

                $harga = number_format($pupuk->harga, 0, ',', '.');

                /*
                |--------------------------------------------------------------------------
                | FOTO — ambil dari storage jika ada, fallback ke tumbuhan.png
                |--------------------------------------------------------------------------
                */

                $foto = $pupuk->foto
                    ? asset('storage/' . $pupuk->foto)
                    : asset('images/tumbuhan.png');

                $fallback = asset('images/tumbuhan.png');

                $output .= '
                <div class="pk-card"
                    style="
                        background:white;
                        border:1px solid #f0f0f0;
                        border-radius:16px;
                        overflow:hidden;
                    ">

                    <div style="
                        height:160px;
                        background:#f8faf5;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                    ">
                        <img src="' . $foto . '"
                             alt="' . e($pupuk->nama) . '"
                             onerror="this.src=\'' . $fallback . '\'"
                             style="
                                max-width:100%;
                                max-height:140px;
                                object-fit:contain;
                             ">
                    </div>

                    <div style="padding:14px;">

                        <div style="
                            font-size:10px;
                            font-weight:700;
                            color:#aaa;
                        ">
                            ' . e($pupuk->kode) . '
                        </div>

                        <div style="
                            font-size:15px;
                            font-weight:600;
                            color:#1e3a1e;
                        ">
                            ' . e($pupuk->nama) . '
                        </div>

                        <div style="
                            font-size:18px;
                            font-weight:700;
                            color:#3d7a25;
                            margin-top:10px;
                        ">
                            Rp ' . $harga . '
                        </div>';

                /*
                |--------------------------------------------------------------------------
                | ADMIN BUTTON
                |--------------------------------------------------------------------------
                */

                if (auth()->user()->role === 'admin') {

                    $output .= '
                    <div style="
                        display:flex;
                        gap:6px;
                        margin-top:12px;
                    ">

                        <a href="' . route('pupuk.edit', $pupuk->id) . '"
                           style="
                                flex:1;
                                background:#f8faf5;
                                color:#3d7a25;
                                border:1px solid #eef7e0;
                                padding:8px;
                                border-radius:8px;
                                text-align:center;
                                text-decoration:none;
                           ">
                            Edit
                        </a>

                        <form action="' . route('pupuk.destroy', $pupuk->id) . '"
                              method="POST"
                              style="flex:1;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '

                            <button type="submit"
                                onclick="return confirm(\'Hapus produk?\')"
                                style="
                                    width:100%;
                                    background:#fff5f5;
                                    color:#c53030;
                                    border:1px solid #ffd5d5;
                                    padding:8px;
                                    border-radius:8px;
                                    cursor:pointer;
                                ">
                                Hapus
                            </button>
                        </form>
                    </div>';
                }

                $output .= '
                    </div>
                </div>';
            }

        } else {

            $output = '
            <div style="
                grid-column:1/-1;
                text-align:center;
                padding:50px;
                color:#888;
            ">
                Produk tidak ditemukan.
            </div>';
        }

        return response($output);
    }
}