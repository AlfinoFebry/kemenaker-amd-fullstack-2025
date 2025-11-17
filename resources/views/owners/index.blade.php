@extends('layout.app')

@section('content')
<section class="hero-2" style="padding: 120px 0 40px; min-height: 100vh; overflow-y: auto;">
    <div id="blog" class="blog" style="padding: 20px 0 20px 0;" data-aos="fade-up" data-aos-duration="1500">
        <div class="container px-lg-5" id="content" style="max-width:none;">
            <article class="entry px-lg-5" style="padding: 30px;margin-bottom: 60px;box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);">

                <div class="row mb-3" data-aos="fade-down-right" data-aos-duration="1500" data-aos-delay="200">
                    <div class="col-sm-6">
                        <h3>Daftar Pemilik</h3>
                    </div>
                </div>

                <div class="row mx-1 mb-3" data-aos="fade-down-right" data-aos-duration="1500">
                    <button style="width: 200px;"
                        type="button"
                        class="btn btn-sm btn-primary d-flex align-items-center me-2"
                        data-bs-toggle="modal"
                        data-bs-target="#ownerModal">
                        <i class="bi bi-person-plus px-1"></i> Tambah Pemilik
                    </button>
                </div>

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger">
                    Terjadi kesalahan. Silakan cek kembali input Anda.
                </div>
                @endif

                <div class="table-responsive text-nowrap">
                    <table class="table table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No. Telepon</th>
                                <th>Alamat</th>
                                <th>Verified</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($owners as $index => $owner)
                            <tr>
                                <td>{{ $owners->firstItem() + $index }}</td>
                                <td>{{ $owner->name }}</td>
                                <td>{{ $owner->phone }}</td>
                                <td>{{ $owner->address ?? '-' }}</td>
                                <td>
                                    @if($owner->verified)
                                    <span class="badge bg-success">Terverifikasi</span>
                                    @else
                                    <span class="badge bg-danger">Belum Diverifikasi</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">

                                            {{-- Toggle verifikasi --}}
                                            <form action="{{ route('owners.update', $owner->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="toggle_verify" value="1">
                                                @if(!$owner->verified)
                                                <button type="submit" class="dropdown-item">
                                                    <i class="bi bi-check2-circle me-1"></i> Verifikasi
                                                </button>
                                                @else
                                                <button type="submit" class="dropdown-item">
                                                    <i class="bi bi-x-circle me-1"></i> Batalkan Verifikasi
                                                </button>
                                                @endif
                                            </form>

                                            {{-- OPTIONAL: hapus pemilik --}}
                                            <form action="{{ route('owners.destroy', $owner->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus pemilik ini? Semua hewan terkait juga akan terhapus.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">
                                                    <i class="ti ti-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    Belum ada pemilik.
                                    <button type="button"
                                        class="btn btn-link p-0 align-baseline"
                                        data-bs-toggle="modal"
                                        data-bs-target="#ownerModal">
                                        Tambah sekarang
                                    </button>.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $owners->links() }}
                </div>

            </article>
        </div>
    </div>
</section>

{{-- MODAL TAMBAH PEMILIK --}}
<div class="modal fade" id="ownerModal" tabindex="-1" role="dialog" aria-labelledby="ownerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ownerModalLabel">Tambah Pemilik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="ownerForm" action="{{ route('owners.store') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="form-group mb-3">
                        <label for="name">Nama</label>
                        <input type="text"
                            class="form-control form-control-user @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone">No. Telepon</label>
                        <input type="text"
                            class="form-control form-control-user @error('phone') is-invalid @enderror"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            required>
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Nomor ini yang nanti diverifikasi.</small>
                    </div>

                    <div class="form-group mb-3">
                        <label for="address">Alamat</label>
                        <textarea class="form-control form-control-user @error('address') is-invalid @enderror"
                            id="address"
                            name="address"
                            rows="2">{{ old('address') }}</textarea>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Auto open modal kalau ada error validasi --}}
@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ownerModal = new bootstrap.Modal(document.getElementById('ownerModal'));
        ownerModal.show();
    });
</script>
@endif

@endsection