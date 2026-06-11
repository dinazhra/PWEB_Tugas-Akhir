@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<main class="container">
    <section class="content">

        <section id="opening">
            <h2>Detail Produk</h2>
        </section>

        <section class="table-section">
            <a href="{{ route('pupuk.index') }}" class="btn-edit">← Kembali</a>

            <table>
                <tr>
                    <th>Kode</th>
                    <td>{{ $pupuk->kode }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $pupuk->nama }}</td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>{{ $pupuk->kategori }}</td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td class="{{ $pupuk->stok < 10 ? 'stok-menipis' : '' }}">
                        {{ $pupuk->stok }}
                    </td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>Rp {{ number_format($pupuk->harga, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Tanggal Masuk</th>
                    <td>{{ $pupuk->tanggal_masuk->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Foto</th>
                    <td>
                        @if($pupuk->foto)
                            <img src="{{ asset('storage/'.$pupuk->foto) }}" width="150">
                        @else
                            Tidak ada foto
                        @endif
                    </td>
                </tr>
            </table>

            <div style="margin-top:20px">
                <a href="{{ route('pupuk.edit', $pupuk) }}" class="btn-edit">Edit</a>
                <form action="{{ route('pupuk.destroy', $pupuk) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn-hapus" onclick="return confirm('Yakin hapus produk ini?')">Hapus</button>
                </form>
            </div>
        </section>

    </section>

    <aside class="sidebar">
        <h4><a href="{{ route('pupuk.index') }}">Daftar Pupuk</a></h4>
        <h4><a href="{{ url('/') }}">Beranda</a></h4>
    </aside>
</main>
@endsection