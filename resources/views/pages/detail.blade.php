 @extends('layouts.master')

 @section('title', $berita->Judul ?? 'Detail Berita')

 @section('content')
     <div class="container mx-auto px-4 py-8">
         @if (isset($berita))
             <!-- Breadcrumb -->
             <nav class="mb-6" aria-label="Breadcrumb">
                 <ol class="flex items-center space-x-2 text-sm text-gray-600">
                     <li><a href="{{ route('beranda') }}" class="hover:text-blue-600">Beranda</a></li>
                     <li><span class="text-gray-400">/</span></li>
                     <li><a href="{{ route('berita.index') }}" class="hover:text-blue-600">Berita</a></li>
                     <li><span class="text-gray-400">/</span></li>
                     <li class="text-gray-900 font-medium">{{ Str::limit($berita->Judul, 60) }}</li>
                 </ol>
             </nav>

             <!-- Article Header -->
             <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                 <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">{{ $berita->Judul }}</h1>

                 <!-- Article Meta -->
                 <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-4">
                     <div class="flex items-center">
                         <i class="fas fa-user mr-2"></i>
                         <span>{{ $berita->penulis ? $berita->penulis->nama : 'Administrator' }}</span>
                     </div>
                     <div class="flex items-center">
                         <i class="fas fa-calendar mr-2"></i>
                         <span>{{ $berita->created_at->format('d M Y') }}</span>
                     </div>
                     <div class="flex items-center">
                         <i class="fas fa-clock mr-2"></i>
                         <span>{{ $berita->created_at->format('H:i') }}</span>
                     </div>
                     <div class="flex items-center">
                         <i class="fas fa-tag mr-2"></i>
                         <span>{{ $berita->kategoriBerita ? $berita->kategoriBerita->Judul : 'Berita' }}</span>
                     </div>
                 </div>

                 <!-- Share Button -->
                 <div class="border-t pt-4">
                     <button onclick="navigator.share({title: '{{ $berita->Judul }}', url: '{{ url()->current() }}'})"
                         class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-medium">
                         <i class="fas fa-share mr-2"></i>
                         Bagikan
                     </button>
                 </div>
             </div>

             <!-- Featured Image -->
             @if ($berita->Thumbnail)
                 <div class="mb-6">
                     <img src="{{ asset('storage/' . $berita->Thumbnail) }}" alt="{{ $berita->Judul }}"
                         class="w-full max-h-96 object-cover rounded-lg shadow-md">
                 </div>
             @endif

             <!-- Article Content -->
             <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                 <div class="prose max-w-none">
                     {!! nl2br(e($berita->Isi_Berita)) !!}
                 </div>
             </div>

             <!-- Article Info -->
             <div class="bg-gray-50 rounded-lg p-6 mb-6">
                 <h3 class="text-lg font-semibold mb-4">Informasi Artikel</h3>
                 <div class="grid md:grid-cols-2 gap-4">
                     <div>
                         <p class="text-sm text-gray-600">Kategori</p>
                         <p class="font-medium">{{ $berita->kategoriBerita ? $berita->kategoriBerita->Judul : 'Umum' }}</p>
                     </div>
                     <div>
                         <p class="text-sm text-gray-600">Penulis</p>
                         <p class="font-medium">{{ $berita->penulis ? $berita->penulis->nama_penulis : 'Administrator' }}
                         </p>
                     </div>
                     <div>
                         <p class="text-sm text-gray-600">Diterbitkan</p>
                         <p class="font-medium">{{ $berita->created_at->format('d M Y H:i') }}</p>
                     </div>
                     @if ($berita->updated_at != $berita->created_at)
                         <div>
                             <p class="text-sm text-gray-600">Diperbarui</p>
                             <p class="font-medium">{{ $berita->updated_at->format('d M Y H:i') }}</p>
                         </div>
                     @endif
                 </div>
             </div>

             <!-- Navigation -->
             <div class="text-center">
                 <a href="{{ route('berita.index') }}"
                     class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded font-medium">
                     <i class="fas fa-arrow-left mr-2"></i>
                     Kembali ke Berita
                 </a>
             </div>
         @else
             <!-- 404 State -->
             <div class="text-center py-12">
                 <div class="mb-6">
                     <i class="fas fa-newspaper text-6xl text-gray-400"></i>
                 </div>
                 <h1 class="text-3xl font-bold text-gray-900 mb-4">Berita Tidak Ditemukan</h1>
                 <p class="text-gray-600 mb-6">Maaf, berita yang Anda cari tidak tersedia.</p>
                 <a href="{{ route('berita.index') }}"
                     class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded font-medium">
                     <i class="fas fa-list mr-2"></i>
                     Lihat Semua Berita
                 </a>
             </div>
         @endif
     </div>

     <!-- Font Awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

     <style>
         .prose {
             color: #374151;
             line-height: 1.7;
         }

         .prose p {
             margin-bottom: 1rem;
         }

         .prose h2,
         .prose h3,
         .prose h4 {
             color: #111827;
             font-weight: 600;
             margin-top: 2rem;
             margin-bottom: 1rem;
         }

         .prose img {
             max-width: 100%;
             height: auto;
             border-radius: 0.5rem;
             margin: 1rem 0;
         }

         .prose blockquote {
             border-left: 4px solid #3b82f6;
             padding-left: 1rem;
             font-style: italic;
             color: #4b5563;
             background: #f8fafc;
             padding: 1rem;
             border-radius: 0.25rem;
             margin: 1rem 0;
         }

         .prose ul,
         .prose ol {
             padding-left: 1.5rem;
             margin: 1rem 0;
         }

         .prose li {
             margin-bottom: 0.5rem;
         }
     </style>
 @endsection
