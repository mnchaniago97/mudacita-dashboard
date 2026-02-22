<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    /**
     * Display content management index
     */
    public function index()
    {
        return redirect()->route('content.home.show');
    }

    /**
     * Display Home content details
     */
    public function showHome()
    {
        $settings = Setting::first();
        return view('admin.pages.content.home-show', compact('settings'));
    }

    /**
     * Display Home content form (edit)
     */
    public function editHome()
    {
        $settings = Setting::first();
        return view('admin.pages.content.home-edit', compact('settings'));
    }

    /**
     * Display Home content management
     */
    public function home()
    {
        $settings = Setting::first();
        return view('admin.pages.content.home-show', compact('settings'));
    }

    /**
     * Update Home content
     */
    public function updateHome(Request $request)
    {
        $settings = Setting::firstOrFail();

        $data = $request->validate([
            'news_hero_title' => 'nullable|string',
            'news_hero_subtitle' => 'nullable|string',
            'hero_btn1_text' => 'nullable|string',
            'hero_btn1_url' => 'nullable|string',
            'hero_btn2_text' => 'nullable|string',
            'hero_btn2_url' => 'nullable|string',
            'visi_author_image' => 'nullable|image|max:2048',
            'misi_author_image' => 'nullable|image|max:2048',
            'impact_1_number' => 'nullable|string',
            'impact_1_title' => 'nullable|string',
            'impact_1_date' => 'nullable|string',
            'impact_1_text' => 'nullable|string',
            'impact_1_url' => 'nullable|url',
            'impact_2_number' => 'nullable|string',
            'impact_2_title' => 'nullable|string',
            'impact_2_date' => 'nullable|string',
            'impact_2_text' => 'nullable|string',
            'impact_2_url' => 'nullable|url',
            'impact_3_number' => 'nullable|string',
            'impact_3_title' => 'nullable|string',
            'impact_3_date' => 'nullable|string',
            'impact_3_text' => 'nullable|string',
            'impact_3_url' => 'nullable|url',
        ]);

        // Handle image uploads
        $imageFields = [
            'hero_image_path', 'about_image_path', 'visi_author_image', 'misi_author_image'
        ];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                if ($settings->$field) {
                    Storage::disk('public')->delete($settings->$field);
                }
                $data[$field] = $request->file($field)->store('content/home', 'public');
            }
        }

        $settings->update($data);

        return back()->with('success', 'Konten halaman home berhasil diperbarui.');
    }

    /**
     * Display Tentang (About) content details
     */
    public function showTentang()
    {
        $settings = Setting::first();
        return view('admin.pages.content.tentang-show', compact('settings'));
    }

    /**
     * Display Tentang (About) content form (edit)
     */
    public function editTentang()
    {
        $settings = Setting::first();
        return view('admin.pages.content.tentang-edit', compact('settings'));
    }

    /**
     * Display Tentang (About) content management
     */
    public function tentang()
    {
        $settings = Setting::first();
        return view('admin.pages.content.tentang-show', compact('settings'));
    }

    /**
     * Update Tentang (About) content
     */
    public function updateTentang(Request $request)
    {
        $settings = Setting::firstOrFail();

        $rules = [
            'tentang_hero_title' => 'nullable|string',
            'visi_description' => 'nullable|string',
            'visi_author_name' => 'nullable|string',
            'visi_author_title' => 'nullable|string',
            'misi_list' => 'nullable|array',
            'misi_author_name' => 'nullable|string',
            'misi_author_title' => 'nullable|string',
            'nilai1_title' => 'nullable|string',
            'nilai1_description' => 'nullable|string',
            'nilai2_title' => 'nullable|string',
            'nilai2_description' => 'nullable|string',
            'nilai3_title' => 'nullable|string',
            'nilai3_description' => 'nullable|string',
            'tentang_cta_title' => 'nullable|string',
            'tentang_hero_image' => 'nullable|image|max:2048',
            'about_intro_image' => 'nullable|image|max:2048',
            'about_value_image_1' => 'nullable|image|max:2048',
            'about_value_image_2' => 'nullable|image|max:2048',
            'about_value_image_3' => 'nullable|image|max:2048',
            'about_overlay_image' => 'nullable|image|max:2048',
        ];

        $data = $request->validate($rules);

        $teams = [];
        $existingTeams = $settings->about_teams ?? [];
        for ($i = 1; $i <= 12; $i++) {
            $existing = $existingTeams[$i - 1] ?? [];
            $team = [
                'name' => $request->input("team_{$i}_name"),
                'role' => $request->input("team_{$i}_role"),
                'facebook' => $request->input("team_{$i}_facebook"),
                'twitter' => $request->input("team_{$i}_twitter"),
                'instagram' => $request->input("team_{$i}_instagram"),
                'image' => $existing['image'] ?? null,
            ];

            if ($request->hasFile("team_{$i}_image")) {
                if (!empty($team['image']) && !str_starts_with($team['image'], 'assets/')) {
                    Storage::disk('public')->delete($team['image']);
                }
                $team['image'] = $request->file("team_{$i}_image")->store('content/tentang/teams', 'public');
            }

            $teams[] = $team;
        }
        $data['about_teams'] = $teams;

        // Handle image uploads
        $imageFields = [
            'tentang_hero_image',
            'about_intro_image',
            'about_value_image_1',
            'about_value_image_2',
            'about_value_image_3',
            'about_overlay_image',
            'visi_author_image',
            'misi_author_image',
        ];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                if ($settings->$field) {
                    Storage::disk('public')->delete($settings->$field);
                }
                $data[$field] = $request->file($field)->store('content/tentang', 'public');
            }
        }

        $settings->update($data);

        return back()->with('success', 'Konten halaman tentang berhasil diperbarui.');
    }

    /**
     * Display Program content details
     */
    public function showProgram($type = null)
    {
        $settings = Setting::first();
        $activities = collect();
        if ($type) {
            $activities = \App\Models\Activity::with('program')
                ->whereHas('program', fn($q) => $q->where('pilar', $type))
                ->latest()
                ->get();
        }
        return view('admin.pages.content.program-show', compact('type', 'settings', 'activities'));
    }

    /**
     * Display Program content form (edit)
     */
    public function editProgram($type = null)
    {
        $settings = Setting::first();
        return view('admin.pages.content.program-edit', compact('type', 'settings'));
    }

    /**
     * Display Program content management
     */
    public function program($type = null)
    {
        $settings = Setting::first();
        return view('admin.pages.content.program-show', compact('type', 'settings'));
    }

    /**
     * Update Program content
     */
    public function updateProgram(Request $request, $type)
    {
        $settings = Setting::firstOrFail();
        
        // Validate program type
        $validTypes = ['pendidikan', 'sosial', 'lingkungan', 'digital'];
        if (!in_array($type, $validTypes)) {
            return back()->with('error', 'Tipe program tidak valid.');
        }

        $data = $request->validate([
            'program_hero_title' => 'nullable|string',
            'program_hero_subtitle' => 'nullable|string',
            'program_hero_description' => 'nullable|string',
            'program_cta_title' => 'nullable|string',
            'program_cta_btn_text' => 'nullable|string',
            'program_cta_btn_url' => 'nullable|string',
            'program_gallery_title' => 'nullable|string',
            'program_gallery_subtitle' => 'nullable|string',
            'program_gallery_btn_text' => 'nullable|string',
            'program_gallery_btn_url' => 'nullable|string',
        ]);

        // Add program item fields dynamically
        for ($i = 1; $i <= 6; $i++) {
            $data['program_' . $type . '_item' . $i . '_title'] = $request->input('program' . $i . '_title');
            $data['program_' . $type . '_item' . $i . '_description'] = $request->input('program' . $i . '_description');
        }

        for ($i = 1; $i <= 3; $i++) {
            $data['program_' . $type . '_gallery_item' . $i . '_title'] = $request->input('gallery' . $i . '_title');
            $data['program_' . $type . '_gallery_item' . $i . '_description'] = $request->input('gallery' . $i . '_description');
            $data['program_' . $type . '_gallery_item' . $i . '_url'] = $request->input('gallery' . $i . '_url');
        }

        $data['program_' . $type . '_gallery_title'] = $request->input('program_gallery_title');
        $data['program_' . $type . '_gallery_subtitle'] = $request->input('program_gallery_subtitle');
        $data['program_' . $type . '_gallery_btn_text'] = $request->input('program_gallery_btn_text');
        $data['program_' . $type . '_gallery_btn_url'] = $request->input('program_gallery_btn_url');

        // Handle image uploads
        $imageFields = ['program_hero_image'];
        for ($i = 1; $i <= 6; $i++) {
            $imageFields[] = 'program' . $i . '_image';
        }
        for ($i = 1; $i <= 3; $i++) {
            $imageFields[] = 'gallery' . $i . '_image';
        }

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $fieldName = 'program_' . $type . '_' . str_replace('program', '', $field) . '_image';
                if ($field === 'program_hero_image') {
                    $fieldName = 'program_' . $type . '_hero_image';
                } else {
                    if (str_starts_with($field, 'gallery')) {
                        $itemNum = str_replace('gallery', '', str_replace('_image', '', $field));
                        $fieldName = 'program_' . $type . '_gallery_item' . $itemNum . '_image';
                    } else {
                        $itemNum = str_replace('program', '', str_replace('_image', '', $field));
                        $fieldName = 'program_' . $type . '_item' . $itemNum . '_image';
                    }
                }
                
                if ($settings->$fieldName) {
                    Storage::disk('public')->delete($settings->$fieldName);
                }
                $data[$fieldName] = $request->file($field)->store('content/program/' . $type, 'public');
            }
        }

        $settings->update($data);

        return back()->with('success', 'Konten program ' . ucfirst($type) . ' berhasil diperbarui.');
    }

    /**
     * Display News content details
     */
    public function showNews()
    {
        $settings = Setting::first();
        return view('admin.pages.content.news-show', compact('settings'));
    }

    /**
     * Display News content form (edit)
     */
    public function editNews()
    {
        $settings = Setting::first();
        return view('admin.pages.content.news-edit', compact('settings'));
    }

    /**
     * Display News content management
     */
    public function news()
    {
        $settings = Setting::first();
        return view('admin.pages.content.news-show', compact('settings'));
    }

    /**
     * Update News content
     */
    public function updateNews(Request $request)
    {
        $settings = Setting::firstOrFail();

        $data = $request->validate([
            'news_hero_title' => 'nullable|string',
            'news_hero_subtitle' => 'nullable|string',
            'news_cta_title' => 'nullable|string',
            'news_cta_description' => 'nullable|string',
        ]);

        $settings->update($data);

        return back()->with('success', 'Konten news berhasil diperbarui.');
    }

    /**
     * Display Kontak (Contact) content details
     */
    public function showKontak()
    {
        $settings = Setting::first();
        return view('admin.pages.content.kontak-show', compact('settings'));
    }

    /**
     * Display Kontak (Contact) content form (edit)
     */
    public function editKontak()
    {
        $settings = Setting::first();
        return view('admin.pages.content.kontak-edit', compact('settings'));
    }

    /**
     * Display Kontak (Contact) content management
     */
    public function kontak()
    {
        $settings = Setting::first();
        return view('admin.pages.content.kontak-show', compact('settings'));
    }

    /**
     * Update Kontak content
     */
    public function updateKontak(Request $request)
    {
        $settings = Setting::firstOrFail();

        $data = $request->validate([
            'org_address' => 'nullable|string',
            'org_email' => 'nullable|string',
            'org_phone' => 'nullable|string',
            'org_instagram' => 'nullable|string',
            'org_twitter' => 'nullable|string',
            'org_facebook' => 'nullable|string',
            'kontak_faq_title' => 'nullable|string',
            'kontak_faq_subtitle' => 'nullable|string',
            'org_map_embed' => 'nullable|string',
        ]);

        $settings->update($data);

        return back()->with('success', 'Konten kontak berhasil diperbarui.');
    }
}
