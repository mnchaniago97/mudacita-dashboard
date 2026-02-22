@extends('public.layouts.web')

@section('title', 'Kontak')
@section('header-class', 'header-short')

@section('header-content')
    <!-- Page Header -->
    <div class="text-center page-hero position-relative" style="z-index: 5;">
        <h1 class="hero-title text-white mb-5" style="font-size: 4rem; letter-spacing: -0.02em;">Hubungi Kami</h1>
        <p class="text-white opacity-75" style="font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
            Punya pertanyaan atau ingin bekerja sama? Jangan ragu untuk menghubungi kami.
        </p>
    </div>
@endsection

@section('content')
    <!-- Contact Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-5 mb-5">
                <!-- Contact Info -->
                <div class="col-lg-5">
                    <h2 class="section-title mb-4">Informasi Kontak</h2>
                    <p class="text-muted mb-4">
                        Kami siap membantu Anda. Silakan hubungi kami melalui informasi di bawah ini atau kirim pesan melalui formulir.
                    </p>

                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex align-items-start">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="feather-map-pin text-primary" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Alamat</h6>
                                <p class="text-muted mb-0">
                                    {{ $appSettings->org_address ?? 'Jakarta Selatan, Indonesia' }}
                                </p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="feather-mail text-primary" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Email</h6>
                                <p class="text-muted mb-0">
                                    {{ $appSettings->org_email ?? 'hello@mudacita.id' }}
                                </p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="feather-phone text-primary" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Telepon</h6>
                                <p class="text-muted mb-0">
                                    {{ $appSettings->org_phone ?? '+62 812 3456 7890' }}
                                </p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="feather-instagram text-primary" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Social Media</h6>
                                <div class="contact-social-list">
                                    <a href="#" class="contact-social-item">
                                        <i class="feather-instagram"></i>
                                        <span>{{ $appSettings->org_instagram ?? '@mudacitaid' }}</span>
                                    </a>
                                    <a href="#" class="contact-social-item">
                                        <i class="feather-twitter"></i>
                                        <span>{{ $appSettings->org_twitter ?? '@mudacitaid' }}</span>
                                    </a>
                                    <a href="#" class="contact-social-item">
                                        <i class="feather-facebook"></i>
                                        <span>{{ $appSettings->org_facebook ?? 'MudaCitaIndonesia' }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                        <div class="card-body p-4 p-lg-5">
                            <h4 class="fw-bold mb-4">Kirim Pesan</h4>
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Nama Lengkap</label>
                                        <input type="text" class="form-control py-3" placeholder="Nama Anda *" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Email</label>
                                        <input type="email" class="form-control py-3" placeholder="Email Anda *" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Nomor Telepon</label>
                                        <input type="tel" class="form-control py-3" placeholder="Nomor telepon (opsional)">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Subjek</label>
                                        <select class="form-select py-3">
                                            <option selected>Pilih subjek...</option>
                                            <option value="1">Pertanyaan Umum</option>
                                            <option value="2">Kerja Sama</option>
                                            <option value3">Volunteer</option>
                                            <option value="4">Donasi</option>
                                            <option value="5">Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold">Pesan</label>
                                        <textarea class="form-control" rows="5" placeholder="Tulis pesan Anda..." required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn-mci btn-mci-red w-100 py-3">
                                            <i class="feather-send me-2"></i>Kirim Pesan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="row">
                <div class="col-12">
                    @if(!empty($appSettings->org_map_embed))
                        <div class="ratio ratio-16x9 rounded-4 overflow-hidden">
                            {!! $appSettings->org_map_embed !!}
                        </div>
                    @else
                        <div class="bg-light rounded-4 p-5 text-center">
                            <i class="feather-map text-muted mb-3" style="font-size: 3rem;"></i>
                            <p class="text-muted mb-0">Peta lokasi akan muncul di sini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title mb-3">{{ $appSettings->kontak_faq_title ?? 'Pertanyaan yang Sering Diajukan' }}</h2>
                    <p class="text-muted">{{ $appSettings->kontak_faq_subtitle ?? 'Temukan jawaban untuk pertanyaan umum tentang Muda Cita Indonesia' }}</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-2">Bagaimana cara menjadi volunteer?</h5>
                            <p class="text-muted small mb-0">
                                Anda dapat mendaftar melalui halaman recruitment atau langsung menghubungi kami melalui kontak yang tersedia.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-2">Apa saja program kerja Muda Cita Indonesia?</h5>
                            <p class="text-muted small mb-0">
                                Kami memiliki empat pilar program: Pendidikan & Literasi, Sosial & Kemanusiaan, Lingkungan, dan Transformasi Digital.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-2">Bagaimana cara melakukan donasi?</h5>
                            <p class="text-muted small mb-0">
                                Anda dapat melakukan donasi melalui transfer bank atau menghubungi kami untuk informasi lebih lanjut.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-2">Apakah Muda Cita Indonesia menerima sponsorship?</h5>
                            <p class="text-muted small mb-0">
                                Ya, kami terbuka untuk kerja sama sponsorship. Silakan hubungi kami untuk discuss lebih lanjut.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
