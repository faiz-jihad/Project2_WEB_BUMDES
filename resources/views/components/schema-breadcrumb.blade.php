@props(['breadcrumbs' => []])

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    @foreach($breadcrumbs as $index => $breadcrumb)
    {
      "@type": "ListItem",
      "position": {{ $index + 1 }},
      "name": "{{ $breadcrumb['name'] }}",
      "item": "{{ $breadcrumb['url'] }}"
    }{{ !$loop->last ? ',' : '' }}
    @endforeach
  ]
}
</script>
