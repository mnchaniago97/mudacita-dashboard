<?php

namespace App\Http\Controllers\SDM;

use App\Http\Controllers\Controller;
use App\Models\Management;
use App\Models\Recruitment;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
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
        // For public form, don't require jabatan
        $isPublicForm = !$request->user();
        
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:recruitments,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'divisi' => ['required', 'string', 'in:program,riset,media'],
            'alamat_lengkap' => ['nullable', 'string', 'max:500'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', 'string', 'in:laki-laki,perempuan'],
            'pendidikan_terakhir' => ['nullable', 'string', 'max:255'],
            'motivasi' => ['nullable', 'string', 'max:1000'],
            'pas_foto' => ['nullable', 'file', 'image', 'max:2048'],
            'screenshot_bukti' => ['nullable'],
            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ];
        
        // Add jabatan requirement only for admin
        if (!$isPublicForm) {
            $rules['jabatan'] = ['required', 'string', 'max:100'];
        } else {
            $rules['jabatan'] = ['nullable', 'string', 'max:100'];
        }
        
        $validated = $request->validate($rules);

        // Handle file uploads
        $photoPath = null;
        $screenshotPaths = null;
        $cvPath = null;

        try {
            if ($request->hasFile('pas_foto')) {
                $photoPath = $request->file('pas_foto')->store('recruitments/photos', 'public');
            }

            if ($request->hasFile('screenshot_bukti')) {
                $screenshots = [];
                foreach ($request->file('screenshot_bukti') as $screenshot) {
                    $screenshots[] = $screenshot->store('recruitments/screenshots', 'public');
                }
                $screenshotPaths = json_encode($screenshots);
            }

            if ($request->hasFile('cv')) {
                $cvPath = $request->file('cv')->store('recruitments/cvs', 'public');
            }

            $recruitment = Recruitment::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'jabatan' => $validated['jabatan'] ?? 'Anggota',
                'divisi' => $validated['divisi'],
                'alamat_lengkap' => $validated['alamat_lengkap'] ?? null,
                'photo_path' => $photoPath,
                'screenshot_path' => $screenshotPaths,
                'cv_path' => $cvPath,
                'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
                'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
                'pendidikan_terakhir' => $validated['pendidikan_terakhir'] ?? null,
                'motivasi' => $validated['motivasi'] ?? null,
                'status_recruitment' => 'pending',
                'applied_at' => now(),
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Recruitment store error: ' . $e->getMessage());
            throw $e;
        }

        $message = implode("\n", array_filter([
            'Pendaftaran Pengurus Baru',
            'Nama: ' . $recruitment->name,
            'Divisi: ' . $recruitment->divisi,
            'Jabatan: ' . $recruitment->jabatan,
            $recruitment->phone ? ('No. HP: ' . $recruitment->phone) : '',
        ]));
        app(WhatsAppService::class)->sendToManagement($message);

        // Check if it's a public form submission by checking the request URI
        $isPublicRoute = $request->is('recruitment/management') || $request->is('recruitment/volunteer');
        
        if ($isPublicRoute) {
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
            'pas_foto' => ['nullable', 'image', 'max:2048'],
            'screenshot_bukti.*' => ['nullable', 'image', 'max:2048'],
            'cv' => ['nullable', 'file', 'max:5120'],
        ]);

        // Handle file uploads
        $updateData = [
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
        ];

        if ($request->hasFile('pas_foto')) {
            $updateData['photo_path'] = $request->file('pas_foto')->store('recruitments/photos', 'public');
        }

        if ($request->hasFile('screenshot_bukti')) {
            $screenshots = [];
            foreach ($request->file('screenshot_bukti') as $screenshot) {
                $screenshots[] = $screenshot->store('recruitments/screenshots', 'public');
            }
            $updateData['screenshot_path'] = json_encode($screenshots);
        }

        if ($request->hasFile('cv')) {
            $updateData['cv_path'] = $request->file('cv')->store('recruitments/cvs', 'public');
        }

        $recruitment->fill($updateData);
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
