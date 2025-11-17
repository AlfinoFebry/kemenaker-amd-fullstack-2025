@extends('layout.app')

@section('content')
<section class="hero-2" style="padding: 120px 0 40px; min-height: 100vh; overflow-y: auto;">
    <div id="blog" class="blog" style="padding: 20px 0 20px 0;" data-aos="fade-up" data-aos-duration="1500">
        <div class="container px-lg-5" id="content" style="max-width:none;">
            <article class="entry px-lg-5" style="padding: 30px;margin-bottom: 60px;box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);">

                <div class="row mb-3" data-aos="fade-down-right" data-aos-duration="1500" data-aos-delay="200">
                    <div class="col-sm-6">
                        <h3>Daftar Hewan Peliharaan</h3>
                    </div>
                </div>

                <div class="row mx-1 mb-3" data-aos="fade-down-right" data-aos-duration="1500">
                    <button style="width: 200px;"
                        type="button"
                        class="btn btn-sm btn-primary d-flex align-items-center me-2"
                        data-bs-toggle="modal"
                        data-bs-target="#petModal">
                        <i class="bi bi-plus-circle px-1"></i> Tambah Hewan
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
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Usia</th>
                                <th>Berat</th>
                                <th>Pemilik</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pets as $index => $pet)
                            <tr>
                                <td>{{ $pets->firstItem() + $index }}</td>
                                <td>{{ $pet->code }}</td>
                                <td>{{ $pet->name }}</td>
                                <td>{{ $pet->type }}</td>
                                <td>{{ $pet->age }} th</td>
                                <td>{{ $pet->weight }} kg</td>
                                <td>{{ $pet->owner->name ?? '-' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            {{-- <button type="button" class="dropdown-item">Edit</button> --}}

                                            <form action="{{ route('pets.destroy', $pet->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data hewan ini?');">
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
                                <td colspan="8" class="text-center">
                                    Belum ada data hewan.
                                    <button type="button"
                                        class="btn btn-link p-0 align-baseline"
                                        data-bs-toggle="modal"
                                        data-bs-target="#petModal">
                                        Tambah sekarang
                                    </button>.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $pets->links() }}
                </div>

            </article>
        </div>
    </div>
</section>

<div class="modal fade" id="petModal" tabindex="-1" role="dialog" aria-labelledby="petModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="petModalLabel">Tambah Hewan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="petForm" action="{{ route('pets.store') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="form-group mb-3">
                        <label for="owner_id">Pemilik (telepon terverifikasi)</label>
                        <select class="form-control form-control-user @error('owner_id') is-invalid @enderror"
                            id="owner_id"
                            name="owner_id"
                            required>
                            <option value="" disabled {{ old('owner_id') ? '' : 'selected' }}>Pilih Pemilik</option>
                            @foreach($owners as $owner)
                            <option value="{{ $owner->id }}" {{ old('owner_id') == $owner->id ? 'selected' : '' }}>
                                {{ $owner->name }} - {{ $owner->phone }}
                            </option>
                            @endforeach
                        </select>
                        @error('owner_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="pet_input">Hewan (Format: NAMA JENIS USIA BERAT)</label>
                        <input type="text"
                            class="form-control form-control-user @error('pet_input') is-invalid @enderror"
                            id="pet_input"
                            name="pet_input"
                            placeholder="Contoh: Milo Kucing 2Th 4.5kg"
                            value="{{ old('pet_input') }}"
                            required>
                        @error('pet_input')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            Contoh: <code>Milo Kucing 2Th 4.5kg</code>
                        </small>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitPetBtn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var petModal = new bootstrap.Modal(document.getElementById('petModal'));
        petModal.show();
    });
</script>
@endif
@endsection