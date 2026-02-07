@php
    $isEdit = isset($activity);
@endphp

<form action="{{ $isEdit ? route('activity.update', $activity) : route('activity.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="title" class="form-label">Nama Aktivitas</label>
        <input
            type="text"
            name="title"
            id="title"
            class="form-control @error('title') is-invalid @enderror"
            value="{{ old('title', $activity->title ?? '') }}"
            required
        >
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label for="program_id" class="form-label">Program Terkait</label>
        <select name="program_id" id="program_id" class="form-select" required>
            <option value="">-- Pilih Program --</option>
            @foreach($programs as $program)
                <option value="{{ $program->id }}" {{ (old('program_id', $activity->program_id ?? '') == $program->id) ? 'selected' : '' }}>
                    {{ $program->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="location_id" class="form-label">Lokasi</label>
        <select name="location_id" id="location_id" class="form-select" required>
            <option value="">-- Pilih Location --</option>
            @foreach($locations as $location)
                <option value="{{ $location->id }}" {{ (old('location_id', $activity->location_id ?? '') == $location->id) ? 'selected' : '' }}>
                    {{ $location->detail ? $location->detail . ' - ' : '' }}
                    {{ $location->city ?? $location->name }}
                    {{ $location->province ? ' - ' . $location->province : '' }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="activity_datetime" class="form-label">Tanggal & Waktu</label>
        <input
            type="datetime-local"
            name="activity_datetime"
            id="activity_datetime"
            class="form-control @error('activity_datetime') is-invalid @enderror"
            value="{{ old('activity_datetime', isset($activity->activity_datetime) ? $activity->activity_datetime->format('Y-m-d\\TH:i') : '') }}"
            required
        >
        @error('activity_datetime')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label for="person_in_charge" class="form-label">Penanggung Jawab</label>
        <input
            type="text"
            name="person_in_charge"
            id="person_in_charge"
            class="form-control @error('person_in_charge') is-invalid @enderror"
            value="{{ old('person_in_charge', $activity->person_in_charge ?? '') }}"
            required
        >
        @error('person_in_charge')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label for="short_description" class="form-label">Deskripsi Singkat</label>
        <textarea
            name="short_description"
            id="short_description"
            rows="3"
            class="form-control @error('short_description') is-invalid @enderror"
            required
        >{{ old('short_description', $activity->short_description ?? '') }}</textarea>
        @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
            @foreach (['planned' => 'Direncanakan', 'ongoing' => 'Berjalan', 'completed' => 'Selesai'] as $key => $label)
                <option value="{{ $key }}" {{ old('status', $activity->status ?? '') === $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="documentation_url" class="form-label">Dokumentasi (Link)</label>
        <input
            type="url"
            name="documentation_url"
            id="documentation_url"
            class="form-control @error('documentation_url') is-invalid @enderror"
            value="{{ old('documentation_url', $activity->documentation_url ?? '') }}"
        >
        @error('documentation_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label for="documentation_photo" class="form-label">Dokumentasi (Foto)</label>
        <input
            type="file"
            name="documentation_photo"
            id="documentation_photo"
            class="form-control @error('documentation_photo') is-invalid @enderror"
            accept="image/*"
        >
        @error('documentation_photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
        @if ($isEdit && !empty($activity->documentation_photo_path))
            <div class="mt-2">
                <img
                    src="{{ asset('storage/' . $activity->documentation_photo_path) }}"
                    alt="Dokumentasi"
                    class="img-thumbnail"
                    style="max-width: 160px;"
                >
            </div>
        @endif
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi Lengkap</label>
        <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $activity->description ?? '') }}</textarea>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="feather-save me-1"></i> {{ $isEdit ? 'Update' : 'Create' }}
        </button>
        <a href="{{ route('activity.index') }}" class="btn btn-secondary">
            <i class="feather-x me-1"></i> Cancel
        </a>
    </div>
</form>
