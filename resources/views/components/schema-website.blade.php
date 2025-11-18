@props(['title' => null, 'description' => null])

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "{{ $title ?? 'Your Website Name' }}",
  "url": "{{ url('/') }}",
  "description": "{{ $description ?? 'Your website description' }}",
  "publisher": {
    "@type": "Organization",
    "name": "Your Website Name",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('images/logo.jpg') }}"
    }
  },
  "potentialAction": {
    "@type": "SearchAction",
    "target": "{{ url('/search?q={search_term_string}') }}",
    "query-input": "required name=search_term_string"
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Your Website Name",
  "url": "{{ url('/') }}",
  "logo": "{{ asset('images/logo.jpg') }}",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+62-XXX-XXXXXXX",
    "contactType": "customer service",
    "availableLanguage": "Indonesian"
  },
  "sameAs": [
    "https://facebook.com/yourpage",
    "https://twitter.com/youraccount",
    "https://instagram.com/youraccount"
  ]
}
</script>
