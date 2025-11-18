@props(['produk'])

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "{{ $produk->nama }}",
  "image": "{{ $produk->gambar ? asset('storage/' . $produk->gambar) : asset('images/default-product.jpg') }}",
  "description": "{{ Str::limit(strip_tags($produk->deskripsi), 160) }}",
  "sku": "{{ $produk->id }}",
  "brand": {
    "@type": "Brand",
    "name": "Your Brand Name"
  },
  "category": "{{ $produk->kategoriProduk->nama_kategori ?? 'Produk' }}",
  "offers": {
    "@type": "Offer",
    "url": "{{ url()->current() }}",
    "priceCurrency": "IDR",
    "price": "{{ $produk->harga }}",
    "availability": "{{ $produk->stok > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
    "seller": {
      "@type": "Organization",
      "name": "Your Website Name"
    }
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.5",
    "reviewCount": "12"
  }
}
</script>
