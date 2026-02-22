<div class="mb-3">
    <label class="form-label fw-bold">Judul Kegiatan</label>
    <input
        type="text"
        name="title"
        class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title', $agenda->title ?? '') }}"
        placeholder="Contoh: Standup Design Presentation"
        required
    >
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Tanggal</label>
        <input
            type="date"
            name="event_date"
            class="form-control @error('event_date') is-invalid @enderror"
            value="{{ old('event_date', $agenda->event_date ?? '') }}"
            required
        >
        @error('event_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Lokasi</label>
        <input
            type="text"
            name="location"
            class="form-control @error('location') is-invalid @enderror"
            value="{{ old('location', $agenda->location ?? '') }}"
            placeholder="Virtual Platform / Kantor"
        >
        @error('location')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Jam Mulai</label>
        <input
            type="time"
            name="start_time"
            class="form-control @error('start_time') is-invalid @enderror"
            value="{{ old('start_time', $agenda->start_time ?? '') }}"
            required
        >
        @error('start_time')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Jam Selesai</label>
        <input
            type="time"
            name="end_time"
            class="form-control @error('end_time') is-invalid @enderror"
            value="{{ old('end_time', $agenda->end_time ?? '') }}"
            required
        >
        @error('end_time')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Kategori Agenda</label>
    <select name="category" class="form-select @error('category') is-invalid @enderror">
        @php
            $categoryValue = old('category', $agenda->category ?? 'Rapat Pengurus');
        @endphp
        <option value="Rapat Pengurus" @selected($categoryValue === 'Rapat Pengurus')>Rapat Pengurus</option>
        <option value="Koordinasi Program" @selected($categoryValue === 'Koordinasi Program')>Koordinasi Program</option>
        <option value="Briefing Volunteer" @selected($categoryValue === 'Briefing Volunteer')>Briefing Volunteer</option>
        <option value="Kegiatan Lapangan" @selected($categoryValue === 'Kegiatan Lapangan')>Kegiatan Lapangan</option>
        <option value="Lainnya" @selected($categoryValue === 'Lainnya')>Lainnya</option>
    </select>
    @error('category')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Deskripsi</label>
    <textarea
        name="description"
        class="form-control @error('description') is-invalid @enderror"
        rows="4"
        placeholder="Tuliskan detail kegiatan..."
    >{{ old('description', $agenda->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    @php
        $notifyValue = old('notify_whatsapp', isset($agenda) ? (int) $agenda->notify_whatsapp : 1);
    @endphp
    <div class="form-check">
        <input
            class="form-check-input"
            type="checkbox"
            id="notify_whatsapp"
            name="notify_whatsapp"
            value="1"
            @checked($notifyValue === 1)
        >
        <label class="form-check-label" for="notify_whatsapp">
            Kirim notifikasi WhatsApp ke pengurus
        </label>
    </div>
</div>

