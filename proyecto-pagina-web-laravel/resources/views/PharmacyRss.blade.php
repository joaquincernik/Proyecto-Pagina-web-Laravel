@php echo '<?xml version="1.0" encoding="utf-8" ?>' @endphp
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{ $title }}</title>
        <description>{{ $description }}</description>
        <link>{{ $link }}</link>



        @foreach ($pharmacies as $pharmacy)

            <item>
                <name>{{ $pharmacy['name'] }} </name>
                <address>{{ $pharmacy['address'] }} </address>
                <phone>{{ $pharmacy['phone'] }} </phone>
            </item>
        @endforeach
    </channel>
</rss>