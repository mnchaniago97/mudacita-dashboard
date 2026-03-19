<?php

namespace App\Http\Controllers\SDM;

use App\Http\Controllers\Controller;
use App\Models\Management;
use App\Models\Recruitment;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class RecruitmentController extends Controller
{
    public function index()
    {
        $recruitments = Recruitment::latest()->paginate(10);

        return view('admin.sdm.recruitment.index', compact('recruitments'));
    }

    public function create()
    {
        return view('admin.sdm.recruitment.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:recruitments,email'],
            'phone' => ['nullable', 'string'],
            'jabatan' => ['required', 'string'],
            'divisi' => ['required', Rule::in(['program', 'riset', 'media'])],
            'alamat_lengkap' => ['nullable', 'string'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', Rule::in(['laki-laki', 'perempuan'])],
            'pendidikan_terakhir' => ['nullable', 'string'],
            'motivasi' => ['nullable', 'string'],
            'pas_foto' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'screenshot_bukti' => ['nullable', 'array', 'max:3'],
            'screenshot_bukti.*' => ['file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
        ], [
            'pas_foto.mimes' => 'Pas foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'pas_foto.max' => 'Ukuran pas foto maksimal 5MB.',
            'screenshot_bukti.array' => 'Screenshot bukti harus berupa daftar file.',
            'screenshot_bukti.max' => 'Screenshot bukti maksimal 3 file.',
            'screenshot_bukti.*.mimes' => 'Screenshot bukti harus berformat JPG, JPEG, PNG, atau WEBP.',
            'screenshot_bukti.*.max' => 'Ukuran setiap screenshot bukti maksimal 5MB.',
            'cv.mimes' => 'CV harus berformat PDF, DOC, atau DOCX.',
            'cv.max' => 'Ukuran CV maksimal 10MB.',
        ]);

        $pasFotoPath = null;
        $screenshotBuktiPath = null;
        $cvPath = null;

        // Handle pas_foto upload
        if ($request->hasFile('pas_foto')) {
            $pasFotoPath = $request->file('pas_foto')->store('recruitments/pas-foto', 'public');
        }

        // Handle screenshot_bukti upload (multiple files - store as JSON)
        if ($request->hasFile('screenshot_bukti')) {
            $screenshotPaths = [];
            foreach ($request->file('screenshot_bukti') as $file) {
                $screenshotPaths[] = $file->store('recruitments/screenshot', 'public');
            }
            $screenshotBuktiPath = json_encode($screenshotPaths, JSON_UNESCAPED_SLASHES);
        }

        // Handle cv upload
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('recruitments/cv', 'public');
        }

        $recruitment = Recruitment::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'jabatan' => $validated['jabatan'],
            'divisi' => $validated['divisi'],
            'alamat_lengkap' => $validated['alamat_lengkap'] ?? null,
            'photo_path' => $pasFotoPath,
            'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
            'pendidikan_terakhir' => $validated['pendidikan_terakhir'] ?? null,
            'motivasi' => $validated['motivasi'] ?? null,
            'screenshot_path' => $screenshotBuktiPath,
            'cv_path' => $cvPath,
            'status_recruitment' => 'pending',
            'applied_at' => now(),
        ]);

        $message = implode("\n", array_filter([
            'Pendaftaran Pengurus Baru',
            'Nama: ' . $recruitment->name,
            'Divisi: ' . $recruitment->divisi,
            'Jabatan: ' . $recruitment->jabatan,
            $recruitment->phone ? ('No. HP: ' . $recruitment->phone) : '',
        ]));
        app(WhatsAppService::class)->sendToManagement($message);

        if (!auth()->check()) {
            return redirect()
                ->route('public.recruitment.success', ['type' => 'management'])
                ->with('success', 'Pendaftaran berhasil. Tim kami akan menghubungi Anda.');
        }

        return redirect()
            ->route('sdm.recruitment.index')
            ->with('success', 'Recruitment berhasil ditambahkan');
    }

    public function edit(Recruitment $recruitment)
    {
        return view('admin.sdm.recruitment.edit', compact('recruitment'));
    }

    public function show(Recruitment $recruitment)
    {
        return view('admin.sdm.recruitment.show', compact('recruitment'));
    }

    public function update(Request $request, Recruitment $recruitment)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('recruitments', 'email')->ignore($recruitment->id)],
            'phone' => ['nullable', 'string'],
            'jabatan' => ['required', 'string'],
            'divisi' => ['required', Rule::in(['program', 'riset', 'media'])],
            'alamat_lengkap' => ['nullable', 'string'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', Rule::in(['laki-laki', 'perempuan'])],
            'pendidikan_terakhir' => ['nullable', 'string'],
            'motivasi' => ['nullable', 'string'],
            'pas_foto' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'screenshot_bukti' => ['nullable', 'array', 'max:3'],
            'screenshot_bukti.*' => ['file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
        ], [
            'pas_foto.mimes' => 'Pas foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'pas_foto.max' => 'Ukuran pas foto maksimal 5MB.',
            'screenshot_bukti.array' => 'Screenshot bukti harus berupa daftar file.',
            'screenshot_bukti.max' => 'Screenshot bukti maksimal 3 file.',
            'screenshot_bukti.*.mimes' => 'Screenshot bukti harus berformat JPG, JPEG, PNG, atau WEBP.',
            'screenshot_bukti.*.max' => 'Ukuran setiap screenshot bukti maksimal 5MB.',
            'cv.mimes' => 'CV harus berformat PDF, DOC, atau DOCX.',
            'cv.max' => 'Ukuran CV maksimal 10MB.',
        ]);

        $photoPath = $recruitment->photo_path;
        $screenshotPath = $recruitment->screenshot_path;
        $cvPath = $recruitment->cv_path;

        if ($request->hasFile('pas_foto')) {
            if (!empty($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            $photoPath = $request->file('pas_foto')->store('recruitments/pas-foto', 'public');
        }

        if ($request->hasFile('screenshot_bukti')) {
            $existingScreenshots = json_decode((string) $recruitment->screenshot_path, true);

            if (is_array($existingScreenshots)) {
                foreach ($existingScreenshots as $path) {
                    if (!empty($path)) {
                        Storage::disk('public')->delete($path);
                    }
                }
            } elseif (is_string($recruitment->screenshot_path) && !empty($recruitment->screenshot_path)) {
                Storage::disk('public')->delete($recruitment->screenshot_path);
            }

            $newScreenshots = [];
            foreach ($request->file('screenshot_bukti') as $file) {
                $newScreenshots[] = $file->store('recruitments/screenshot', 'public');
            }

            $screenshotPath = json_encode($newScreenshots, JSON_UNESCAPED_SLASHES);
        }

        if ($request->hasFile('cv')) {
            if (!empty($cvPath)) {
                Storage::disk('public')->delete($cvPath);
            }
            $cvPath = $request->file('cv')->store('recruitments/cv', 'public');
        }

        $recruitment->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'jabatan' => $validated['jabatan'],
            'divisi' => $validated['divisi'],
            'alamat_lengkap' => $validated['alamat_lengkap'] ?? null,
            'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
            'pendidikan_terakhir' => $validated['pendidikan_terakhir'] ?? null,
            'motivasi' => $validated['motivasi'] ?? null,
            'photo_path' => $photoPath,
            'screenshot_path' => $screenshotPath,
            'cv_path' => $cvPath,
        ]);

        $recruitment->save();

        return redirect()
            ->route('sdm.recruitment.index')
            ->with('success', 'Recruitment berhasil diupdate');
    }

    public function destroy(Recruitment $recruitment)
    {
        $recruitment->delete();

        return back()->with('success', 'Recruitment berhasil dihapus');
    }

    public function approve(Recruitment $recruitment)
    {
        if ($recruitment->status_recruitment === 'accepted') {
            return back()->with('success', 'Recruitment sudah diterima');
        }

        if (Management::where('email', $recruitment->email)->exists()) {
            return back()->withErrors(['email' => 'Email sudah terdaftar sebagai management']);
        }

        Management::create([
            'name' => $recruitment->name,
            'email' => $recruitment->email,
            'phone' => $recruitment->phone,
            'jabatan' => $recruitment->jabatan,
            'divisi' => $recruitment->divisi,
            'status' => 'active',
            'joined_at' => now(),
        ]);

        $recruitment->status_recruitment = 'accepted';
        $recruitment->accepted_at = now();
        $recruitment->save();

        $applicantMessage = implode("\n", array_filter([
            'Selamat! Pendaftaran pengurus Anda diterima.',
            'Nama: ' . $recruitment->name,
            'Divisi: ' . $recruitment->divisi,
            'Jabatan: ' . $recruitment->jabatan,
        ]));
        app(WhatsAppService::class)->sendToPhone($recruitment->phone, $applicantMessage);

        return back()->with('success', 'Recruitment diterima dan masuk ke management');
    }

    public function reject(Request $request, Recruitment $recruitment)
    {
        $request->validate([
            'rejection_reason' => ['nullable', 'string'],
        ]);

        $recruitment->status_recruitment = 'rejected';
        $recruitment->rejected_at = now();
        $recruitment->rejection_reason = $request->rejection_reason;
        $recruitment->save();

        $rejectMessage = implode("\n", array_filter([
            'Pendaftaran pengurus Anda belum dapat kami terima.',
            'Nama: ' . $recruitment->name,
            $recruitment->rejection_reason ? ('Alasan: ' . $recruitment->rejection_reason) : '',
        ]));
        app(WhatsAppService::class)->sendToPhone($recruitment->phone, $rejectMessage);

        return back()->with('success', 'Recruitment ditolak');
    }
}
