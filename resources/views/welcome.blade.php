@extends('layout.app')

@section('content')
<section class="hero-2" id="" style="padding: 120px 0 40px; min-height: 100vh; overflow-y: auto;">
    <div id="blog" class="blog" style="padding: 20px 0 20px 0;" data-aos="fade-up" data-aos-duration="1500">
        <div class="container px-lg-5" id="content" style="max-width:none;">
            <article class="entry px-lg-5" style="padding: 30px;margin-bottom: 60px;box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);">
                <div class="row mb-3" data-aos="fade-down-right" data-aos-duration="1500" data-aos-delay="200">
                    <div class="col-sm-6">
                        <h3>Selamat Datang ke dalam aplikasi Petshop+</h3>
                    </div>
                </div>
                <div class="row mx-1 mb-3" data-aos="fade-down-right" data-aos-duration="1500">
                    <button style="width: 170px;" type="button" class="btn btn-sm btn-primary d-flex align-items-center me-2" id="tambahDataBtn">
                        <i class="bi bi-person-add px-1"> </i> Masuk
                    </button>
                </div>


            </article>
        </div>
    </div>
</section>
@endsection