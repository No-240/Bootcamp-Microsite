<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PublicController extends Controller
{
    /**
     * Menampilkan antarmuka Bio-Link publik.
     */
    public function index(): View
    {
        // Ambil data profil pertama.
        // Jika belum ada, buat profil kosong.
        $profile = Profile::firstOrCreate([]);

        // Ambil link yang aktif.
        $links = Link::where('is_active', true)
            ->latest()
            ->paginate(10);

        return view('public.index', compact('profile', 'links'));
    }

    /**
     * Menghitung klik dan mengalihkan pengguna ke URL tujuan.
     */
    public function redirect(Link $link): RedirectResponse
    {
        // Tambahkan jumlah klik secara atomic.
        $link->increment('clicks');

        // Redirect ke URL eksternal.
        return redirect()->away($link->url);
    }

    /**
     * Download data profil dalam format VCard (.vcf).
     */
    public function downloadVcf(): Response|RedirectResponse
    {
        $profile = Profile::first();

        if (!$profile) {
            return back()->with('error', 'Profil tidak ditemukan');
        }

        $vcard = "BEGIN:VCARD\r\n";
        $vcard .= "VERSION:3.0\r\n";
        $vcard .= "FN:" . ($profile->name ?? '') . "\r\n";
        $vcard .= "TEL:" . ($profile->phone ?? '') . "\r\n";
        $vcard .= "EMAIL:" . ($profile->email ?? '') . "\r\n";
        $vcard .= "END:VCARD\r\n";

        return response($vcard)
            ->header('Content-Type', 'text/vcard; charset=UTF-8')
            ->header(
                'Content-Disposition',
                'attachment; filename="contact.vcf"'
            );
    }
}
