@php echo '<?xml version="1.0" encoding="utf-8" ?>' @endphp
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{ $title }}</title>
        <description>{{ $description }}</description>
        <link>{{ $link }}</link>

        @foreach ($SocialServices as $item)
            <item>
                <id>{{ $item['id']}}</id>
                <gender>{{ $item['gender']}}</gender>
                <name>{{ $item['name']}}</name>
                <nickname>{{ $item['nickname']}}</nickname>
                <age>{{ $item['age']}}</age>
                <response>{{ $item['response']}}</response>
                <burial>{{ $item['burial']}}</burial>

            </item>
        @endforeach
    </channel>
</rss>
