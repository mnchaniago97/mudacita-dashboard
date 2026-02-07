<div class="card stretch stretch-full">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ $action }}" method="POST">
            @csrf
            @if ($method !== 'POST')
                @method($method)
            @endif

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label class="form-label fw-bold">Program Kolaborasi</label>
                    <input type="text" name="title" class="form-control" required
                        value="{{ old('title', $collaboration->title ?? '') }}">
                </div>
                <div class="col-lg-6 mb-3">
                    <label class="form-label fw-bold">Nama Mitra</label>
                    <input type="text" name="partner_name" class="form-control" required
                        value="{{ old('partner_name', $collaboration->partner_name ?? '') }}">
                </div>
                <div class="col-lg-6 mb-3">
                    <label class="form-label fw-bold">Jenis Mitra</label>
                    <input type="text" name="partner_type" class="form-control" required
                        placeholder="Komunitas / Organisasi / Instansi"
                        value="{{ old('partner_type', $collaboration->partner_type ?? '') }}">
                </div>
                <div class="col-lg-6 mb-3">
                    <label class="form-label fw-bold">Program Terkait</label>
                    <select name="program_id" class="form-select">
                        <option value="">Pilih Program</option>
                        @foreach ($programs as $program)
                            <option value="{{ $program->id }}"
                                @selected(old('program_id', $collaboration->program_id ?? '') == $program->id)>
                                {{ $program->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4 mb-3">
                    <label class="form-label fw-bold">Pilar</label>
                    <select name="pilar" class="form-select">
                        <option value="">Pilih Pilar</option>
                        <option value="pendidikan" @selected(old('pilar', $collaboration->pilar ?? '') === 'pendidikan')>Pendidikan</option>
                        <option value="sosial" @selected(old('pilar', $collaboration->pilar ?? '') === 'sosial')>Sosial</option>
                        <option value="lingkungan" @selected(old('pilar', $collaboration->pilar ?? '') === 'lingkungan')>Lingkungan</option>
                    </select>
                </div>
                <div class="col-lg-4 mb-3">
                    <label class="form-label fw-bold">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="form-control"
                        value="{{ old('start_date', $collaboration->start_date ?? '') }}">
                </div>
                <div class="col-lg-4 mb-3">
                    <label class="form-label fw-bold">Tanggal Selesai</label>
                    <input type="date" name="end_date" class="form-control"
                        value="{{ old('end_date', $collaboration->end_date ?? '') }}">
                </div>
                <div class="col-lg-4 mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="planned" @selected(old('status', $collaboration->status ?? 'planned') === 'planned')>Direncanakan</option>
                        <option value="ongoing" @selected(old('status', $collaboration->status ?? '') === 'ongoing')>Berjalan</option>
                        <option value="completed" @selected(old('status', $collaboration->status ?? '') === 'completed')>Selesai</option>
                        <option value="cancelled" @selected(old('status', $collaboration->status ?? '') === 'cancelled')>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-lg-4 mb-3">
                    <label class="form-label fw-bold">PIC</label>
                    <input type="text" name="pic_name" class="form-control"
                        value="{{ old('pic_name', $collaboration->pic_name ?? '') }}">
                </div>
                <div class="col-lg-4 mb-3">
                    <label class="form-label fw-bold">HP PIC</label>
                    <input type="text" name="pic_phone" class="form-control"
                        value="{{ old('pic_phone', $collaboration->pic_phone ?? '') }}">
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $collaboration->description ?? '') }}</textarea>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Dokumentasi (URL)</label>
                    <input type="text" name="documentation_url" class="form-control"
                        value="{{ old('documentation_url', $collaboration->documentation_url ?? '') }}">
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
