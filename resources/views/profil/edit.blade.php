@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')

<style>

.edit-page{
    max-width:1000px;
    margin:30px auto;
}

.edit-card{
    background:white;
    border-radius:28px;
    padding:35px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.page-title{
    font-size:28px;
    font-weight:800;
    color:#1f4d2b;
    margin-bottom:25px;
}

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.form-group{
    display:flex;
    flex-direction:column;
}

.form-group.full{
    grid-column:1/-1;
}

.form-label{
    font-weight:700;
    margin-bottom:8px;
    color:#374151;
}

.form-input{
    padding:14px 16px;
    border:1px solid #d1d5db;
    border-radius:14px;
    font-size:15px;
    outline:none;
}

.form-input:focus{
    border-color:#2f6b45;
}

.action{
    margin-top:30px;
    display:flex;
    gap:12px;
}

.btn-save{
    border:none;
    background:linear-gradient(135deg,#2f6b45,#1f4d2b);
    color:white;
    padding:14px 26px;
    border-radius:14px;
    font-weight:700;
    cursor:pointer;
}

.btn-save:hover{
    opacity:.9;
}

.btn-back{
    background:#f3f4f6;
    color:#111827;
    padding:14px 26px;
    border-radius:14px;
    text-decoration:none;
    font-weight:700;
}

.alert-success{
    background:#dcfce7;
    color:#166534;
    padding:14px;
    border-radius:12px;
    margin-bottom:20px;
}

.alert-error{
    background:#fee2e2;
    color:#991b1b;
    padding:14px;
    border-radius:12px;
    margin-bottom:20px;
}

@media(max-width:768px){

    .form-grid{
        grid-template-columns:1fr;
    }

}

</style>

<div class="edit-page">

    <div class="edit-card">

        <div class="page-title">
            Edit Profil
        </div>

        @if(session('status'))
            <div class="alert-success">
                Profil berhasil diperbarui.
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <ul style="margin:0;padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('profile.update') }}"
        >

            @csrf
            @method('PATCH')

            <div class="form-grid">

                <div class="form-group">
                    <label class="form-label">
                        Nama
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-input"
                        value="{{ old('name', $user->name) }}"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Username
                    </label>

                    <input
                        type="text"
                        name="username"
                        class="form-input"
                        value="{{ old('username', $user->username) }}"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-input"
                        value="{{ old('email', $user->email) }}"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Nomor HP
                    </label>

                    <input
                        type="text"
                        name="no_hp"
                        class="form-input"
                        value="{{ old('no_hp', $user->no_hp) }}"
                    >
                </div>

                @if($user->role !== 'admin')

                <div class="form-group full">

                    <label class="form-label">
                        Alamat
                    </label>

                    <textarea
                        name="alamat"
                        rows="4"
                        class="form-input"
                    >{{ old('alamat', $user->alamat) }}</textarea>

                </div>

                @endif

                <div class="form-group">
                    <label class="form-label">
                        Password Baru
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-input"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Konfirmasi Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-input"
                    >
                </div>

            </div>

            <div class="action">

                <button
                    type="submit"
                    class="btn-save"
                >
                    Simpan Perubahan
                </button>

                <a
                    href="{{ route('profil.index') }}"
                    class="btn-back"
                >
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection