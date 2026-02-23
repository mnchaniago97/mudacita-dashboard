@extends('public.layouts.web')

@section('title', 'Home')

@section('header-content')
    <!-- Hero -->
    <div class="hero-box shadow-sm">
        <div class="row align-items-center">
            <div class="col-lg-6 pe-lg-5">
                <h1 class="hero-title">{{ $appSettings->hero_title ?? 'Inspirasi Muda, Cita Untuk Indonesia' }}</h1>
                <span class="hero-subtitle">{{ $appSettings->hero_subtitle ?? 'Ayo Bersama Untuk Indonesia' }}</span>
                <p class="text-muted mb-5 pe-lg-5" style="font-size: 1.1rem; line-height: 1.8;">
                    {{ $appSettings->hero_description ?? 'Muda Cita Indonesia hadir untuk menciptakan perubahan nyata melalui kolaborasi dan aksi bersama. Mari wujudkan masa depan yang lebih baik untuk generasi muda Indonesia.' }}
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ $appSettings->hero_btn1_url ?? '#' }}" class="btn-mci btn-mci-red">
                        {{ $appSettings->hero_btn1_text ?? 'Ayo Gabung' }} <i class="feather-arrow-up-right"></i>
                    </a>
                    <a href="{{ $appSettings->hero_btn2_url ?? '#' }}" class="btn-mci btn-mci-blue">
                        {{ $appSettings->hero_btn2_text ?? 'Donasi Sekarang' }} <i class="feather-arrow-up-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0">
                <div class="hero-image-wrapper">
                    <img src="{{ $appSettings->hero_image_path ? asset('storage/' . $appSettings->hero_image_path) : asset('assets/images/banner/mudacita1.jpg') }}" class="img-fluid rounded-4 shadow-sm w-100" alt="Hero Image">
                    <div class="hero-social-card shadow-sm">
                        <a href="#" class="hero-social-btn" aria-label="Instagram">
                            <i class="feather-instagram"></i>
                        </a>
                        <a href="#" class="hero-social-btn" aria-label="YouTube">
                            <i class="feather-youtube"></i>
                        </a>
                        <a href="#" class="hero-social-btn" aria-label="Facebook">
                            <i class="feather-facebook"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- About -->
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-1 order-lg-1 pe-lg-5 mb-4 mb-lg-0">
                    <span class="tag-label">Tentang Kami</span>
                    <h2 class="section-title mb-4">Gerakan Anak Muda yang Berdaya</h2>
                    <p class="text-muted mb-5" style="font-size: 1rem; line-height: 1.9;">
                        Muda Cita Indonesia Foundation adalah organisasi sosial yang digerakkan oleh semangat kolaborasi, integritas, dan pengabdian. Kami bekerja bersama relawan, komunitas lokal, dan mitra strategis untuk menjawab persoalan pendidikan, sosial, dan lingkungan secara berkelanjutan.
                    </p>
                    <div class="d-flex align-items-center gap-4 flex-column flex-md-row">
                        <a href="{{ route('about') }}" class="btn-mci btn-mci-red">Selengkapnya <i class="feather-arrow-up-right"></i></a>
                        <a href="{{ route('program') }}" class="btn btn-link text-dark text-decoration-none fw-bold">Lihat Program Kami <i class="feather-arrow-up-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 order-2 order-lg-2 mb-5 mb-lg-0">
                    <img src="{{ $appSettings->about_image_path ? asset('storage/' . $appSettings->about_image_path) : asset('assets/images/banner/mudacita1.jpg') }}" class="img-fluid rounded-4 w-100" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- Visi -->
    <section class="py-0">
        <div class="container">
            @php
                $visiAuthorImage = $appSettings->visi_author_image
                    ? (str_starts_with($appSettings->visi_author_image, 'assets/')
                        ? asset($appSettings->visi_author_image)
                        : asset('storage/' . $appSettings->visi_author_image))
                    : asset('assets/images/banner/mudacita1.jpg');
                $misiAuthorImage = $appSettings->misi_author_image
                    ? (str_starts_with($appSettings->misi_author_image, 'assets/')
                        ? asset($appSettings->misi_author_image)
                        : asset('storage/' . $appSettings->misi_author_image))
                    : asset('assets/images/banner/mudacita2.jpg');
            @endphp
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="author-card">
                        <div class="author-header">
                            <img src="{{ $visiAuthorImage }}" class="author-avatar" alt="">
                            <div>
                                <h6 class="author-name">Muhammad N. Chaniago</h6>
                                <p class="author-role">Founder Muda Cita Indonesia</p>
                            </div>
                        </div>
                        <p class="author-text">Muda Cita Indonesia Foundation lahir dari keyaikinan sederhana: bahwa anak muda tidak pernah kekurangan kepedulian, yang sering kurang hanyalah ruang untuk bergerak.</p>
                    </div>
                </div>
                <div class="col-lg-7 ps-lg-5 mt-4 mt-lg-0">
                    <h2 class="section-title mb-4">Visi</h2>
                    <p class="text-muted" style="font-size: 1.1rem; line-height: 1.8;">Mewujudkan organisasi yang profesional, berintegritas, dan berkelanjutan dalam mendorong perubahan sosial melalui pendidikan, kemanusiaan, pelestarian lingkungan, dan transformasi digital.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Misi -->
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 pe-lg-5 order-2 order-lg-1 mt-4 mt-lg-0">
                    <h2 class="section-title mb-4">Misi</h2>
                    <ul class="list-unstyled text-muted" style="font-size: 1.05rem; line-height: 2.2;">
                        <li>&bull; Menguatkan tata kelola organisasi yang profesional dan berintegritas.</li>
                        <li>&bull; Mengembangkan peran generasi muda sebagai agen perubahan sosial.</li>
                        <li>&bull; Menyelenggarakan program pendidikan, sosial, dan lingkungan yang berdampak.</li>
                        <li>&bull; Mendorong kolaborasi dan inovasi berbasis teknologi digital.</li>
                    </ul>
                </div>
                <div class="col-lg-5 order-1 order-lg-2 mb-4 mb-lg-0 mt-4 mt-lg-0">
                    <div class="author-card">
                        <div class="author-header">
                            <div class="text-end flex-grow-1">
                                <h6 class="author-name">Ummul Hanifah Putri</h6>
                                <p class="author-role">Founder & Direktur Eksekutif</p>
                            </div>
                            <img src="{{ $misiAuthorImage }}" class="author-avatar" alt="">
                        </div>
                        <p class="author-text">Muda Cita Indonesia Foundation hadir untuk menumbuhkan generasi yang berani turun tangan, berpikir jernih, dan mengabdi dengan hati. Inilah gerakan kecil kami untuk cita-cita besar Indonesia.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Nilai-Nilai -->
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Nilai-Nilai Utama</h2>
                <p class="text-muted">Prinsip yang kami junjung dalam setiap langkah</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="value-card h-100 bg-white rounded-4 p-4" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                        <div class="text-center">
                            <i class="feather-briefcase mb-3 d-block" style="font-size: 56px; color: #ef4444;"></i>
                        </div>
                        <h4 class="value-title text-center mt-3">Profesionalisme</h4>
                        <p class="value-text text-center mt-2">Kami bekerja secara terukur, bertanggung jawab, dan berorientasi pada kualitas serta dampak.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-card h-100 bg-white rounded-4 p-4" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                        <div class="text-center">
                            <i class="feather-shield mb-3 d-block" style="font-size: 56px; color: #0ea5e9;"></i>
                        </div>
                        <h4 class="value-title text-center mt-3">Integritas</h4>
                        <p class="value-text text-center mt-2">Kami menjunjung tinggi kejujuran, transparansi, dan etika dalam setiap tindakan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-card h-100 bg-white rounded-4 p-4" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                        <div class="text-center">
                            <i class="feather-users mb-3 d-block" style="font-size: 56px; color: #8b5cf6;"></i>
                        </div>
                        <h4 class="value-title text-center mt-3">Kolaborasi</h4>
                        <p class="value-text text-center mt-2">Kami percaya perubahan bermakna lahir dari kerja bersama dan kemitraan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pillars -->
    <section class="pillars-section">
        <div class="decor-blob blob-4"></div>
        <div class="container text-center mb-5 pb-4">
            <h2 class="section-title text-white">Empat Pilar Muda Cita Indonesia</h2>
        </div>
        <div class="container">
            <div class="row g-4">
                @php
                    $pilarTags = ['01', '02', '03', '04'];
                    $pilarRoutes = [
                        route('program.detail', 'pendidikan'),
                        route('program.detail', 'sosial'),
                        route('program.detail', 'lingkungan'),
                        route('program.detail', 'digital')
                    ];
                    $pilarTitles = ['Pendidikan & Literasi', 'Sosial', 'Lingkungan', 'Transformasi Digital'];
                    $pilarSubtitles = ['Rumah Baca Eduva', 'MCI Socio Project', 'MCI Green', 'MCI Digital Impact'];
                    $pilarDescriptions = [
                        'Pilar Pendidikan dan Literasi berfokus pada peningkatan kualitas sumber daya manusia melalui akses belajar yang inklusif.',
                        'MCI Socio Project bergerak dalam aksi kemanusiaan, kepedulian sosial, dan respons terhadap kebutuhan masyarakat.',
                        'MCI Green berfokus pada pelestarian lingkungan melalui edukasi, aksi nyata, dan kampanye kesadaran ekologis.',
                        'MCI Digital Impact memperkuat kapasitas digital dan inovasi berbasis teknologi untuk pendidikan dan pemberdayaan.'
                    ];
                @endphp
                @foreach(range(1, 4) as $i)
                <div class="col-md-6 col-lg-3">
                    <div class="pilar-card {{ $i == 4 ? 'dark' : '' }}">
                        <div class="pilar-meta-line">{{ $pilarTags[$i-1] }} – {{ $pilarTitles[$i-1] }}</div>
                        <h4 class="pilar-subtitle">{{ $pilarSubtitles[$i-1] }}</h4>
                        <p class="pilar-desc">{{ $pilarDescriptions[$i-1] }}</p>
                        <a href="{{ $pilarRoutes[$i-1] }}" class="btn-mci {{ $i == 4 ? 'btn-mci-light' : 'btn-mci-red' }} btn-sm mt-auto w-fit" style="width: fit-content; padding: 10px 20px; font-size: 0.75rem;">
                            Learn More <i class="feather-arrow-up-right ms-1"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Impact (Dynamic) -->
    <section>
        <div class="container">
            <div class="row align-items-center mb-5 pb-4">
                <div class="col-md-8">
                    <h2 class="section-title">Cerita Dampak<br>Aksi Kecil, Perubahan Besar</h2>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="#" class="btn-mci btn-mci-red rounded-pill px-4">View All <i class="feather-arrow-up-right ms-1"></i></a>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8">
                    @php
                        $impactData = [
                            [
                                'num' => $appSettings->impact_1_number ?? '11+',
                                'label' => $appSettings->impact_1_title ?? 'Penerima Manfaat',
                                'date' => $appSettings->impact_1_date ?? '11 Januari 2024',
                                'text' => $appSettings->impact_1_text ?? 'Muda Cita Indonesia Foundation berkolaborasi dengan Purejoy, Inisiatif Zakat Indonesia (IZI) Sumatera Barat...',
                                'url' => $appSettings->impact_1_url ?? '#',
                            ],
                            [
                                'num' => $appSettings->impact_2_number ?? '1+',
                                'label' => $appSettings->impact_2_title ?? 'Volunteer',
                                'date' => $appSettings->impact_2_date ?? '14 Desember 2025',
                                'text' => $appSettings->impact_2_text ?? 'Kolaborasi Komunitas Hadirkan Ruang Aman Psikososial untuk Anak Penyintas Bencana di Padang.',
                                'url' => $appSettings->impact_2_url ?? '#',
                            ],
                            [
                                'num' => $appSettings->impact_3_number ?? '0Jt',
                                'label' => $appSettings->impact_3_title ?? 'Bantuan Tersalurkan',
                                'date' => $appSettings->impact_3_date ?? 'Aug 15, 2024',
                                'text' => $appSettings->impact_3_text ?? 'Berkat kerjasama berbagai pihak, Muda Cita Indonesia Foundation telah menyalurkan lebih dari puluhan paket bantuan...',
                                'url' => $appSettings->impact_3_url ?? '#',
                            ],
                        ];
                    @endphp
                    @foreach($impactData as $item)
                    <div class="impact-item">
                        <div class="impact-val">{{ $item['num'] }}</div>
                        <div class="impact-info">
                            <div class="impact-label">{{ $item['label'] }}</div>
                            <div class="impact-body">{{ $item['text'] }}</div>
                        </div>
                        <div class="impact-meta">
                            <span class="impact-date">{{ $item['date'] }}</span>
                            <a href="{{ $item['url'] }}" class="impact-btn" target="_blank" rel="noopener">Learn More <i class="feather-arrow-up-right small ms-1"></i></a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-4 ps-lg-5 mt-4 mt-lg-0">
                    <div class="aksi-box">
                        <div class="mb-4">
                            <span class="tag-pill">Upgrading</span>
                            <span class="tag-pill">Rumah Baca</span>
                        </div>
                        <div class="icon-sq"><i class="feather-bookmark"></i></div>
                        <h4 class="fw-bold mb-3">Aksi Nyata, Dampak Bermakna</h4>
                        <p class="text-muted small mb-5" style="line-height: 1.8;">Dari kegiatan pendidikan, aksi sosial kemanusiaan, hingga gerakan lingkungan, setiap program dirancang sebagai upaya kolektif.</p>
                        <a href="#" class="btn-mci btn-mci-red w-100 justify-content-center">Ayo Gabung <i class="feather-arrow-up-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News & Articles (Dynamic) -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center mb-5 pb-4">
                <div class="col-md-8">
                    <h2 class="section-title">{{ $appSettings->news_hero_title ?? 'Berita & Artikel' }}<br><span class="text-muted" style="font-size: 1rem;">{{ $appSettings->news_hero_subtitle ?? 'Informasi terkini tentang kegiatan, program, dan informasi menarik dari Muda Cita Indonesia.' }}</span></h2>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('public.news') }}" class="btn-mci btn-mci-red rounded-pill px-4">Lihat Semua <i class="feather-arrow-up-right ms-1"></i></a>
                </div>
            </div>
            
            <div class="row g-4">
                @php
                    $newsArticles = \App\Models\NewsArticle::where('status', 'published')->latest()->take(3)->get();
                @endphp
                
                @if($newsArticles->count() > 0)
                    @foreach($newsArticles as $article)
                    <div class="col-md-4">
                        <div class="news-card h-100 bg-white rounded-4 overflow-hidden" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                            @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid w-100" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                            @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="feather-image text-muted" style="font-size: 48px;"></i>
                            </div>
                            @endif
                            <div class="p-4">
                                @if($article->category)
                                <span class="badge bg-danger mb-2">{{ $article->category->name }}</span>
                                @endif
                                <h5 class="news-title mb-2" style="font-size: 1.1rem; line-height: 1.4;">{{ $article->title }}</h5>
                                <p class="text-muted small mb-3" style="line-height: 1.6;">{{ \Illuminate\Support\Str::limit($article->excerpt ?? strip_tags($article->content), 100) }}</p>
                                <a href="{{ route('public.news.detail', $article->slug) }}" class="text-danger fw-bold text-decoration-none small">Baca Selengkapnya <i class="feather-arrow-up-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12 text-center py-5">
                        <i class="feather-file-text text-muted mb-3" style="font-size: 48px;"></i>
                        <p class="text-muted">Belum ada berita terbaru</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section>
        <div class="container">
            <div class="cta-container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h2 class="section-title mb-4" style="font-size: 2.2rem;">Saatnya Terlibat dan Dukung Program Kami</h2>
                        <div class="d-flex gap-4 flex-wrap">
                            <span class="fw-bold small"><i class="feather-check-circle text-primary me-2"></i> Volunteer</span>
                            <span class="fw-bold small"><i class="feather-check-circle text-primary me-2"></i> Donatur</span>
                        </div>
                    </div>
                    <div class="col-lg-5 mt-4 mt-lg-0">
                        <div class="bg-white p-4 rounded-4 shadow-sm">
                            <p class="text-dark small fw-bold mb-3">Kontribusi Anda adalah energi bagi gerakan pengabdian.</p>
                            <form class="d-flex gap-2 flex-column flex-md-row">
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
