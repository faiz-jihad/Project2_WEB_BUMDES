<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Support\Str;


class BeritaController extends Controller
{
    public function index()
    {
        // Check if user has role 'penulis'
        if (!auth()->check() || auth()->user()->role !== 'penulis') {
            return redirect()->back()->with('error', 'Akses ditolak. Halaman ini hanya untuk penulis.');
        }

        // Get penulis id from penulis table based on authenticated user
        $penulis = \App\Models\Penulis::where('nama_penulis', auth()->user()->name)->first();

        if (!$penulis) {
            return redirect()->back()->with('error', 'Penulis tidak ditemukan. Pastikan akun Anda terdaftar sebagai penulis.');
        }

        $berita = Berita::with('kategoriBerita', 'penulis')
            ->where('id_penulis', $penulis->id_penulis)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $kategori = KategoriBerita::orderBy('Judul')->get();
        return view('pages.penulis.berita.berita', compact('berita', 'kategori'));
    }

    public function store(Request $request)
    {
        // Check if user has role 'penulis'
        if (auth()->user()->role !== 'penulis') {
            return redirect()->back()->with('error', 'Akses ditolak. Halaman ini hanya untuk penulis.');
        }

        // Debug: Log the request data
        \Log::info('Berita Store Request:', $request->all());
        \Log::info('User authenticated:', ['user_id' => auth()->check() ? auth()->id() : 'No', 'user_name' => auth()->check() ? auth()->user()->name : 'No']);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori__berita,id_kategori',
            'isi_berita' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        try {
            // Get the penulis id from the penulis table based on the authenticated user
            $penulis = \App\Models\Penulis::where('nama_penulis', auth()->user()->name)->first();

            if (!$penulis) {
                \Log::error('Penulis not found for user:', ['user_name' => auth()->user()->name]);
                notify()->error('Penulis tidak ditemukan. Pastikan akun Anda terdaftar sebagai penulis.', 'Error');
                return redirect()->back();
            }

            $berita = Berita::create([
                'id_penulis' => $penulis->id_penulis,
                'id_kategori' => $request->kategori_id,
                'Judul' => $request->judul,
                'slug' => $request->slug ?: Str::slug($request->judul),
                'Isi_Berita' => $request->isi_berita,
                'Thumbnail' => $thumbnailPath,
                'status' => 'pending', // Default status for new berita
            ]);

            \Log::info('Berita created successfully:', $berita->toArray());

            // Send notification to all users
            $allUsers = \App\Models\User::all();
            foreach ($allUsers as $user) {
                $user->notify(new \App\Notifications\BeritaCreated($berita, $penulis));
            }

            notify()->success('Berita berhasil ditambahkan!', 'Berhasil');
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error('Error creating berita:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            notify()->error('Gagal menambahkan berita: ' . $e->getMessage(), 'Error');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        // Check if user has role 'penulis'
        if (auth()->user()->role !== 'penulis') {
            return redirect()->back()->with('error', 'Akses ditolak. Halaman ini hanya untuk penulis.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori__berita,id_kategori',
            'isi_berita' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $berita = Berita::findOrFail($id);

        $thumbnailPath = $berita->thumbnail;
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($thumbnailPath && \Storage::disk('public')->exists($thumbnailPath)) {
                \Storage::disk('public')->delete($thumbnailPath);
            }
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $berita->update([
            'Judul' => $request->judul,
            'slug' => $request->slug ?: Str::slug($request->judul),
            'id_kategori' => $request->kategori_id,
            'Isi_Berita' => $request->isi_berita,
            'Thumbnail' => $thumbnailPath,
        ]);

        notify()->success('Berita berhasil diperbarui!', 'Berhasil');
        return redirect()->back();
    }

    public function show($id)
    {
        // Check if user has role 'penulis'
        if (!auth()->check() || auth()->user()->role !== 'penulis') {
            return response()->json(['success' => false, 'message' => 'Akses ditolak.'], 403);
        }

        try {
            $berita = Berita::with('kategoriBerita', 'penulis')->findOrFail($id);

            // Check if the berita belongs to the authenticated penulis
            $penulis = \App\Models\Penulis::where('nama_penulis', auth()->user()->name)->first();
            if (!$penulis || $berita->id_penulis !== $penulis->id_penulis) {
                return response()->json(['success' => false, 'message' => 'Berita tidak ditemukan.'], 404);
            }

            return response()->json([
                'success' => true,
                'berita' => [
                    'id' => $berita->id_berita,
                    'judul' => $berita->Judul,
                    'slug' => $berita->slug,
                    'isi_berita' => $berita->Isi_Berita,
                    'thumbnail' => $berita->Thumbnail,
                    'kategori_berita' => $berita->kategoriBerita,
                    'penulis' => $berita->penulis,
                    'created_at' => $berita->created_at,
                    'updated_at' => $berita->updated_at,
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching berita:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Berita tidak ditemukan.'], 404);
        }
    }

    public function destroy($id)
    {
        // Check if user has role 'penulis'
        if (auth()->user()->role !== 'penulis') {
            return redirect()->back()->with('error', 'Akses ditolak. Halaman ini hanya untuk penulis.');
        }

        $berita = Berita::findOrFail($id);

        // Delete thumbnail if exists
        if ($berita->thumbnail && \Storage::disk('public')->exists($berita->thumbnail)) {
            \Storage::disk('public')->delete($berita->thumbnail);
        }

        $berita->delete();
        notify()->success('Berita berhasil dihapus!', 'Berhasil');
        return redirect()->back();
    }
}
