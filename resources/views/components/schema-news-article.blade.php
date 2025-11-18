@props(['berita'])

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "headline": "{{ $berita->Judul }}",
  "image": [
    "{{ $berita->thumbnailUrl ?? asset('images/default-news.jpg') }}"
  ],
  "datePublished": "{{ $berita->publish_at?->toISOString() ?? $berita->created_at->toISOString() }}",
  "dateModified": "{{ $berita->updated_at->toISOString() }}",
  "author": {
    "@type": "Person",
    "name": "{{ $berita->penulis->nama_penulis ?? $berita->user->name ?? 'Admin' }}",
    "url": "{{ $berita->penulis ? route('penulis.show', $berita->penulis->id_penulis) : '#' }}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Your Website Name",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('images/logo.jpg') }}"
    }
  },
  "description": "{{ Str::limit(strip_tags($berita->Isi_Berita), 160) }}",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ url()->current() }}"
  },
  "articleSection": "{{ $berita->kategoriBerita->nama_kategori ?? 'Berita' }}",
  "keywords": "{{ $berita->kategoriBerita->nama_kategori ?? 'berita' }}",
  "speakable": {
    "@type": "SpeakableSpecification",
    "cssSelector": [".article-headline", ".article-summary"]
  }
}
</script>
