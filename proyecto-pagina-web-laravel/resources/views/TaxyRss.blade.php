@php echo '<?xml version="1.0" encoding="utf-8" ?>' @endphp
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{ $title }}</title>
        <description>{{ $description }}</description>
        <link>{{ $link }}</link>

        @foreach ($Taxy as $tax)
            <item>
                <image>{{ $tax }}</image>
            </item>
        @endforeach
    </channel>
</rss>