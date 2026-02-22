@extends('public.layouts.web')

@section('title', 'Tentang Kami')

@section('header-content')
    <!-- Page Header -->
    <div class="text-center py-5 mt-5 position-relative" style="z-index: 5;">
        <h1 class="hero-title text-white mb-5" style="font-size: 3.2rem; letter-spacing: -0.02em;">{{ $appSettings->tentang_hero_title ?? 'Inspirasi Muda, Cita untuk Indonesia' }}</h1>

        <div class="position-relative mt-5 hero-image-card">
            @php
                $aboutHeroImage = $appSettings->tentang_hero_image
                    ? (str_starts_with($appSettings->tentang_hero_image, 'assets/')
                        ? asset($appSettings->tentang_hero_image)
                        : asset('storage/' . $appSettings->tentang_hero_image))
                    : asset('assets/images/banner/mudacita1.jpg');
            @endphp
            <img src="{{ $aboutHeroImage }}" class="img-fluid rounded-4 shadow-lg w-100 hero-image" style="max-height: 420px; object-fit: cover;" alt="">
            <div class="hero-image-caption">
                <p class="mb-0">Dari kegiatan pendidikan, aksi sosial kemanusiaan, hingga gerakan lingkungan, setiap program dirancang sebagai upaya kolektif untuk menjawab kebutuhan nyata masyarakat.</p>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- About Intro -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="tag-label">Tentang Kami</span>
                    <h2 class="section-title mb-4">Gerakan Anak Muda yang Berdaya</h2>
                    <p class="text-muted mb-3" style="font-size: 1.05rem; line-height: 1.8;">
                        Muda Cita Indonesia Foundation adalah organisasi sosial yang digerakkan oleh semangat kolaborasi,
                        integritas, dan pengabdian.
                    </p>
                    <p class="text-muted mb-3" style="font-size: 1.05rem; line-height: 1.8;">
                        Kami bekerja bersama relawan, komunitas lokal, dan mitra strategis untuk menjawab persoalan pendidikan,
                        sosial, dan lingkungan secara berkelanjutan. Kami tidak datang membawa solusi instan.
                    </p>
                    <p class="text-muted mb-4" style="font-size: 1.05rem; line-height: 1.8;">
                        Kami datang untuk mendengar, belajar, dan bertumbuh bersama masyarakat.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('about') }}" class="btn-mci btn-mci-red">
                            Selengkapnya <i class="feather-arrow-up-right"></i>
                        </a>
                        <a href="{{ route('program') }}" class="btn-mci btn-mci-blue">
                            Lihat Program Kami <i class="feather-arrow-up-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    @php
                        $aboutIntroImage = $appSettings->about_intro_image
                            ? (str_starts_with($appSettings->about_intro_image, 'assets/')
                                ? asset($appSettings->about_intro_image)
                                : asset('storage/' . $appSettings->about_intro_image))
                            : asset('assets/images/banner/mudacita3.jpg');
                    @endphp
                    <img src="{{ $aboutIntroImage }}" class="img-fluid rounded-4 shadow-lg w-100" style="max-height: 520px; object-fit: cover;" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi -->
    <section>
        <div class="container">
            @php
                $visiAuthorImage = $appSettings->visi_author_image
                    ? (str_starts_with($appSettings->visi_author_image, 'assets/')
                        ? asset($appSettings->visi_author_image)
                        : asset('storage/' . $appSettings->visi_author_image))
                    : asset('assets/images/banner/mudacita4.JPG');
                $misiAuthorImage = $appSettings->misi_author_image
                    ? (str_starts_with($appSettings->misi_author_image, 'assets/')
                        ? asset($appSettings->misi_author_image)
                        : asset('storage/' . $appSettings->misi_author_image))
                    : asset('assets/images/banner/mudacita5.JPG');
            @endphp

            <div class="row align-items-center mb-5 pb-5">
                <div class="col-lg-5">
                    <div class="author-card">
                        <div class="author-header">
                            <img src="{{ $visiAuthorImage }}" class="author-avatar" alt="">
                            <div>
                                <h6 class="author-name">{{ $appSettings->visi_author_name ?? 'Muhammad N. Chaniago' }}</h6>
                                <p class="author-role">{{ $appSettings->visi_author_title ?? 'Founder Muda Cita Indonesia' }}</p>
                            </div>
                        </div>
                        <p class="author-text">Muda Cita Indonesia Foundation lahir dari keyakinan sederhana: bahwa anak muda tidak pernah kekurangan kepedulian, yang sering kurang hanyalah ruang untuk bergerak.</p>
                    </div>
                </div>
                <div class="col-lg-7 ps-lg-5 mt-5 mt-lg-0">
                    <h2 class="section-title mb-4">Visi</h2>
                    <p class="text-muted" style="font-size: 1.1rem; line-height: 1.8;">{{ $appSettings->visi_description ?? 'Mewujudkan organisasi yang profesional, berintegritas, dan berkelanjutan dalam mendorong perubahan sosial melalui pendidikan, kemanusiaan, pelestarian lingkungan, dan transformasi digital.' }}</p>
                </div>
            </div>

            <div class="row align-items-center mt-5">
                <div class="col-lg-7 pe-lg-5 order-2 order-lg-1">
                    <h2 class="section-title mb-4">Misi</h2>
                    <ul class="list-unstyled text-muted" style="font-size: 1.05rem; line-height: 2.5;">
                        @if($appSettings->misi_list)
                            @foreach($appSettings->misi_list as $misi)
                                <li class="d-flex align-items-start gap-3">
                                    <span class="text-primary mt-1">&bull;</span>
                                    <span>{{ $misi }}</span>
                                </li>
                            @endforeach
                        @else
                            <li class="d-flex align-items-start gap-3">
                                <span class="text-primary mt-1">&bull;</span>
                                <span>Menguatkan tata kelola organisasi yang profesional dan berintegritas.</span>
                            </li>
                            <li class="d-flex align-items-start gap-3">
                                <span class="text-primary mt-1">&bull;</span>
                                <span>Mengembangkan peran generasi muda sebagai agen perubahan sosial.</span>
                            </li>
                            <li class="d-flex align-items-start gap-3">
                                <span class="text-primary mt-1">&bull;</span>
                                <span>Menyelenggarakan program pendidikan, kemanusiaan, dan lingkungan yang berdampak.</span>
                            </li>
                            <li class="d-flex align-items-start gap-3">
                                <span class="text-primary mt-1">&bull;</span>
                                <span>Mendorong kolaborasi dan inovasi berbasis teknologi digital.</span>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="col-lg-5 order-1 order-lg-2 mb-5 mb-lg-0">
                    <div class="author-card">
                        <div class="author-header">
                            <div class="text-end flex-grow-1">
                                <h6 class="author-name">{{ $appSettings->misi_author_name ?? 'Ummul Hanifah Putri' }}</h6>
                                <p class="author-role">{{ $appSettings->misi_author_title ?? 'Founder & Direktur Eksekutif' }}</p>
                            </div>
                            <img src="{{ $misiAuthorImage }}" class="author-avatar" alt="">
                        </div>
                        <p class="author-text">Muda Cita Indonesia Foundation hadir untuk menumbuhkan generasi yang berani turun tangan, berpikir jernih, dan mengabdi dengan hati. Inilah gerakan kecil kami untuk cita-cita besar Indonesia.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Grid Section -->
    <section class="pillars-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="pilar-card bg-white shadow-sm h-100">
                        @php
                            $aboutValueImage1 = $appSettings->about_value_image_1
                                ? (str_starts_with($appSettings->about_value_image_1, 'assets/')
                                    ? asset($appSettings->about_value_image_1)
                                    : asset('storage/' . $appSettings->about_value_image_1))
                                : asset('assets/images/banner/mudacita2.jpg');
                        @endphp
                        <img src="{{ $aboutValueImage1 }}" class="img-fluid rounded-4 mb-4" style="height: 200px; width: 100%; object-fit: cover;" alt="">
                        <p class="text-danger fw-bold mb-0" style="font-size: 0.8rem;">Dari pertemuan kecil sampai mimpi besar, Muda Cita selalu punya cara untuk mengubah langkah sederhana jadi gerakan bermakna.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="pilar-card bg-white shadow-sm h-100">
                        @php
                            $aboutValueImage2 = $appSettings->about_value_image_2
                                ? (str_starts_with($appSettings->about_value_image_2, 'assets/')
                                    ? asset($appSettings->about_value_image_2)
                                    : asset('storage/' . $appSettings->about_value_image_2))
                                : asset('assets/images/banner/mudacita3.jpg');
                        @endphp
                        <img src="{{ $aboutValueImage2 }}" class="img-fluid rounded-4 mb-4" style="height: 200px; width: 100%; object-fit: cover;" alt="">
                        <p class="text-danger fw-bold mb-0" style="font-size: 0.8rem;">Dari kelas inspirasi hingga ruang kolaborasi, kami menjaga semangat belajar agar terus menyala di setiap daerah.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="pilar-card bg-white shadow-sm h-100">
                        @php
                            $aboutValueImage3 = $appSettings->about_value_image_3
                                ? (str_starts_with($appSettings->about_value_image_3, 'assets/')
                                    ? asset($appSettings->about_value_image_3)
                                    : asset('storage/' . $appSettings->about_value_image_3))
                                : asset('assets/images/banner/11.jpeg');
                        @endphp
                        <img src="{{ $aboutValueImage3 }}" class="img-fluid rounded-4 mb-4" style="height: 200px; width: 100%; object-fit: cover;" alt="">
                        <p class="text-danger fw-bold mb-0" style="font-size: 0.8rem;">Bersama warga dan relawan, aksi kemanusiaan kami fokus pada kebutuhan nyata dan dampak yang berkelanjutan.</p>
                    </div>
                </div>
            </div>

            <div class="row mt-5 g-5 text-white">
                <div class="col-md-4">
                    <h2 class="fw-bold mb-4" style="font-size: 3rem;">01</h2>
                    <h4 class="fw-bold mb-3">{{ $appSettings->nilai1_title ?? 'Profesional' }}</h4>
                    <p class="opacity-75 small">{{ $appSettings->nilai1_description ?? 'Kami bekerja secara terukur, bertanggung jawab, dan berorientasi pada kualitas serta dampak.' }}</p>
                </div>
                <div class="col-md-4">
                    <h2 class="fw-bold mb-4" style="font-size: 3rem;">02</h2>
                    <h4 class="fw-bold mb-3">{{ $appSettings->nilai2_title ?? 'Integritas' }}</h4>
                    <p class="opacity-75 small">{{ $appSettings->nilai2_description ?? 'Kami menjunjung tinggi kejujuran, transparansi, dan etika dalam setiap tindakan.' }}</p>
                </div>
                <div class="col-md-4">
                    <h2 class="fw-bold mb-4" style="font-size: 3rem;">03</h2>
                    <h4 class="fw-bold mb-3">{{ $appSettings->nilai3_title ?? 'Kolaborasi' }}</h4>
                    <p class="opacity-75 small">{{ $appSettings->nilai3_description ?? 'Kami percaya perubahan bermakna lahir dari kerja bersama dan kemitraan yang saling menguatkan.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section>
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <h2 class="section-title">Tim Muda Cita Indonesia Foundation</h2>
                </div>
                <div class="col-lg-6">
                    <p class="text-muted mb-0">Muda Cita Indonesia percaya, perubahan sosial hanya dapat diwujudkan oleh tim yang solid, peduli, dan konsisten dalam pengabdian.</p>
                </div>
            </div>

            <div class="row">
                @php
    $teams = $appSettings->about_teams ?? [];
    $teams = array_values(array_filter($teams, function ($member) {
        return !empty($member['name']) || !empty($member['role']) || !empty($member['image']);
    }));
@endphp

                @foreach($teams as $member)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="team-card">
                        <div class="team-img-wrapper">
                            @php
                                $teamImage = $member['image']
                                    ? (str_starts_with($member['image'], 'assets/')
                                        ? asset($member['image'])
                                        : asset('storage/' . $member['image']))
                                    : asset('assets/images/banner/mudacita1.jpg');
                            @endphp
                            <img src="{{ $teamImage }}" class="team-img" alt="">
                            <div class="team-social">
                                @if(!empty($member['facebook']))
                                    <a href="{{ $member['facebook'] }}" class="social-icon" target="_blank" rel="noopener"><i class="feather-facebook"></i></a>
                                @endif
                                @if(!empty($member['twitter']))
                                    <a href="{{ $member['twitter'] }}" class="social-icon" target="_blank" rel="noopener"><i class="feather-twitter"></i></a>
                                @endif
                                @if(!empty($member['instagram']))
                                    <a href="{{ $member['instagram'] }}" class="social-icon" target="_blank" rel="noopener"><i class="feather-instagram"></i></a>
                                @endif
                            </div>
                        </div>
                        <h6 class="team-name">{{ $member['name'] ?? '-' }}</h6>
                        <p class="team-role">{{ $member['role'] ?? '-' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Image Overlay Section -->
    <section class="overlay-image-section">
        @php
            $aboutOverlayImage = $appSettings->about_overlay_image
                ? (str_starts_with($appSettings->about_overlay_image, 'assets/')
                    ? asset($appSettings->about_overlay_image)
                    : asset('storage/' . $appSettings->about_overlay_image))
                : asset('assets/images/banner/mudacita2.jpg');
        @endphp
        <div class="overlay-image" style="background-image: url('{{ $aboutOverlayImage }}');"></div>
        <div class="overlay-fade"></div>
    </section>

    <!-- Footer Area -->
    <section class="py-5">
        <div class="container">
            <div class="cta-container shadow-sm">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h2 class="section-title mb-4" style="font-size: 2.2rem;">{{ $appSettings->tentang_cta_title ?? 'Saatnya Terlibat dan Dukung Program Kami' }}</h2>
                        <div class="d-flex gap-4">
                            <span class="fw-bold small"><i class="feather-check-circle text-primary me-2"></i> Volunteer</span>
                            <span class="fw-bold small"><i class="feather-check-circle text-primary me-2"></i> Donatur</span>
                        </div>
                    </div>
                    <div class="col-lg-5 mt-5 mt-lg-0">
                        <div class="bg-white p-4 rounded-4 shadow-sm">
                            <p class="text-dark small fw-bold mb-3">Kontribusi Anda adalah energi bagi gerakan pengabdian.</p>
                            <form class="d-flex gap-2">
                                <input type="email" class="form-control" placeholder="Your email *" required>
                                <button type="submit" class="btn btn-dark px-4 fw-bold">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



