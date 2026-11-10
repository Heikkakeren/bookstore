@extends('layouts.admin')

@section('title', 'Pesan Kontak Pengunjung')
@section('page-title', 'Pesan Masuk (Kontak Pengunjung)')

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 font-serif" style="color: var(--forest-primary); font-size: 1.4rem;">
            <i class="bi bi-chat-left-text me-2" style="color: var(--forest-accent);"></i>Pesan Masuk dari Pengunjung
        </h4>
        <p class="text-muted small mb-0">Daftar pertanyaan, kritik, dan saran yang dikirim melalui formulir kontak publik.</p>
    </div>
    <div class="small fw-semibold px-3 py-2 rounded-pill" style="background-color: var(--forest-sand); color: var(--forest-primary);">
        Total Pesan: <strong>{{ $contacts->total() }}</strong> pesan
    </div>
</div>

<!-- Messages Table Card -->
<div class="card border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="ps-3" style="width: 60px;">#</th>
                        <th scope="col">Nama Pengirim</th>
                        <th scope="col">Alamat Email</th>
                        <th scope="col">Isi Pesan Singkat</th>
                        <th scope="col" class="text-center" style="width: 120px;">Status</th>
                        <th scope="col">Waktu Masuk</th>
                        <th scope="col" class="text-end pe-3" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                        <tr class="{{ !$contact->is_read ? 'bg-light bg-opacity-75' : '' }}">
                            <td class="ps-3 text-secondary fw-semibold">
                                {{ $loop->iteration + ($contacts->currentPage() - 1) * $contacts->perPage() }}
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $contact->name }}</div>
                                @if($contact->user_id)
                                    <span class="badge px-2 py-1 rounded-pill" style="background-color: rgba(22, 51, 38, 0.1); color: var(--forest-primary); font-size: 0.65rem;">User Terdaftar</span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary" style="font-size: 0.65rem;">Tamu Publik</span>
                                @endif
                            </td>
                            <td>
                                <a href="mailto:{{ $contact->email }}" class="text-decoration-none text-muted">
                                    {{ $contact->email }}
                                </a>
                            </td>
                            <td>
                                <span class="text-secondary small">{{ Str::limit($contact->message, 55) }}</span>
                            </td>
                            <td class="text-center">
                                @if($contact->is_read)
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill fw-semibold">
                                        Sudah Dibaca
                                    </span>
                                @else
                                    <span class="badge px-3 py-2 rounded-pill fw-semibold shadow-sm text-white" style="background-color: var(--forest-accent);">
                                        <i class="bi bi-envelope-fill me-1"></i>Baru
                                    </span>
                                @endif
                            </td>
                            <td class="text-muted small">
                                {{ $contact->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <!-- Read Detail Trigger (Modal) -->
                                    <button type="button" 
                                            class="btn btn-outline-forest" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalMessage{{ $contact->id }}"
                                            title="Baca Pesan Lengkap">
                                        <i class="bi bi-eye me-1"></i>Baca
                                    </button>

                                    <!-- Delete Message -->
                                    <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan dari {{ $contact->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Hapus Pesan">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Detail Pesan -->
                        <div class="modal fade" id="modalMessage{{ $contact->id }}" tabindex="-1" aria-labelledby="modalMsgLabel{{ $contact->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header" style="background-color: var(--forest-sand);">
                                        <h6 class="modal-title fw-bold font-serif" style="color: var(--forest-primary);" id="modalMsgLabel{{ $contact->id }}">
                                            <i class="bi bi-envelope-open me-2" style="color: var(--forest-accent);"></i>Pesan Masuk
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="d-flex justify-content-between align-items-baseline mb-3 pb-2 border-bottom">
                                            <div>
                                                <h6 class="fw-bold mb-0 font-serif" style="color: var(--forest-primary);">{{ $contact->name }}</h6>
                                                <a href="mailto:{{ $contact->email }}" class="small text-muted text-decoration-none">
                                                    {{ $contact->email }}
                                                </a>
                                            </div>
                                            <span class="text-muted small">
                                                {{ $contact->created_at->format('d M Y, H:i') }} WIB
                                            </span>
                                        </div>

                                        <div class="p-3 rounded-3 small leading-relaxed mb-3" style="background-color: var(--forest-cream); border: 1px solid var(--forest-border); color: #374151;">
                                            {{ $contact->message }}
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="mailto:{{ $contact->email }}?subject=Balasan Pesan BookStore" class="btn btn-sm btn-forest">
                                                <i class="bi bi-reply-fill me-1"></i>Balas Lewat Email
                                            </a>
                                            <span class="badge text-secondary border" style="background: #ffffff;">ID: #{{ $contact->id }}</span>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light py-2">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-chat-square-text fs-1 d-block mb-2 opacity-50"></i>
                                Belum ada pesan masuk dari pengunjung.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($contacts->hasPages())
        <div class="card-footer bg-white py-3 border-top">
            <div class="d-flex justify-content-center mb-0">
                {{ $contacts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection
