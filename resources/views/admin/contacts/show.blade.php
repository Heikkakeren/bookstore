@extends('layouts.admin')
@section('title', 'Detail Pesan')
@section('page-title', 'Detail Pesan')
@section('content')
<div class="mb-3">
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h6 class="mb-0">Pesan dari {{ $contact->name }}</h6>
                <span class="badge {{ $contact->is_read ? 'bg-secondary' : 'bg-success' }}">
                    {{ $contact->is_read ? 'Sudah Dibaca' : 'Baru' }}
                </span>
            </div>
            <div class="card-body">
                <dl class="row mb-3">
                    <dt class="col-sm-3">Nama</dt>
                    <dd class="col-sm-9">{{ $contact->name }}</dd>
                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></dd>
                    @if($contact->user)
                        <dt class="col-sm-3">Akun User</dt>
                        <dd class="col-sm-9">{{ $contact->user->name }}</dd>
                    @endif
                    <dt class="col-sm-3">Dikirim</dt>
                    <dd class="col-sm-9">{{ $contact->created_at->format('d F Y H:i') }}</dd>
                </dl>
                <div class="bg-light rounded p-3">
                    <strong class="small d-block mb-1 text-muted">Isi Pesan:</strong>
                    <p class="mb-0">{{ $contact->message }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
