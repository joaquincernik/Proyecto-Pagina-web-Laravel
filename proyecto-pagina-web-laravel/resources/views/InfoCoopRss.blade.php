@php echo '<?xml version="1.0" encoding="utf-8" ?>' @endphp
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{ $title }}</title>
        <description>{{ $description }}</description>
        <link>{{ $link }}</link>

        @foreach ($InfoCoop as $info)
            <item>
                <title>{{ $info['title']}}</title>
                <content>{{ $info['content']}}</content>
                <image>{{ $info['image']}}</image>
            </item>
        @endforeach
    </channel>
</rss>
