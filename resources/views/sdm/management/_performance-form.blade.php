@php
    $formAction = $formAction ?? route('sdm.management-performance.store');
    $formMethod = $formMethod ?? 'POST';
    $submitLabel = $submitLabel ?? 'Simpan Skor';
    $formTitle = $formTitle ?? 'Input Skor Kinerja';
    $performance = $performance ?? null;
@endphp

<div id="performance-form-card" class="card border-0 shadow-sm h-100">
    <div class="card-header">
        <h6 class="card-title mb-0">{{ $formTitle }}</h6>
        <div class="text-muted small">Hanya untuk founder / super admin</div>
    </div>
    <div class="card-body pb-1">
        <form method="POST" action="{{ $formAction }}">
            @csrf
            @if ($formMethod !== 'POST')
                @method($formMethod)
            @endif
            <div class="mb-3">
                <label class="form-label">Pilih Pengurus</label>
                <select name="staff_id" class="form-select" required>
                    <option value="" selected disabled>Pilih pengurus</option>
                    @if ($managementList->isNotEmpty())
                        @foreach ($managementList as $staff)
                            <option value="{{ $staff->id }}" @selected(old('staff_id', $performance?->management_id) == $staff->id)>
                                {{ $staff->name }} - {{ $staff->jabatan }}
                            </option>
                        @endforeach
                    @else
                        @foreach ($staffPerformance as $staff)
                            <option value="{{ $staff['name'] }}" @selected(old('staff_id') == $staff['name'])>
                                {{ $staff['name'] }} - {{ $staff['position'] }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">10 Poin Ukuran Kinerja (Skala 1-4)</label>
                <div class="row g-2">
                    <div class="col-6">
                        <label class="form-label small">Perencanaan</label>
                        <select name="perencanaan" class="form-select" required>
                            <option value="" selected disabled>Pilih skala</option>
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" @selected(old('perencanaan', $performance?->perencanaan) == $i)>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label small">Pelaksanaan</label>
                        <select name="pelaksanaan" class="form-select" required>
                            <option value="" selected disabled>Pilih skala</option>
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" @selected(old('pelaksanaan', $performance?->pelaksanaan) == $i)>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label small">Kualitas</label>
                        <select name="kualitas" class="form-select" required>
                            <option value="" selected disabled>Pilih skala</option>
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" @selected(old('kualitas', $performance?->kualitas) == $i)>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label small">Inovasi</label>
                        <select name="inovasi" class="form-select" required>
                            <option value="" selected disabled>Pilih skala</option>
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" @selected(old('inovasi', $performance?->inovasi) == $i)>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label small">Evaluasi</label>
                        <select name="evaluasi" class="form-select" required>
                            <option value="" selected disabled>Pilih skala</option>
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" @selected(old('evaluasi', $performance?->evaluasi) == $i)>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label small">Analisis</label>
                        <select name="analisis" class="form-select" required>
                            <option value="" selected disabled>Pilih skala</option>
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" @selected(old('analisis', $performance?->analisis) == $i)>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label small">Kolaborasi</label>
                        <select name="kolaborasi" class="form-select" required>
                            <option value="" selected disabled>Pilih skala</option>
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" @selected(old('kolaborasi', $performance?->kolaborasi) == $i)>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label small">Kepemimpinan</label>
                        <select name="kepemimpinan" class="form-select" required>
                            <option value="" selected disabled>Pilih skala</option>
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" @selected(old('kepemimpinan', $performance?->kepemimpinan) == $i)>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label small">Etika</label>
                        <select name="etika" class="form-select" required>
                            <option value="" selected disabled>Pilih skala</option>
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" @selected(old('etika', $performance?->etika) == $i)>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label small">Dampak</label>
                        <select name="dampak" class="form-select" required>
                            <option value="" selected disabled>Pilih skala</option>
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" @selected(old('dampak', $performance?->dampak) == $i)>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">{{ $submitLabel }}</button>
        </form>
        <div class="text-muted small mt-2">
            Halaman ini akan memuat ulang untuk memperbarui tabel dan grafik.
        </div>
    </div>
</div>
