@php echo '<?xml version="1.0" encoding="utf-8" ?>' @endphp
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>Datos meteorológicos de Monte Buey</title>
        <description>{{ $description }}</description>
        <link></link>



            <item>
                <wind_dir>{{$wind_dir}}</wind_dir>
                <humidity>{{$humidity}}</humidity>
                <rain>{{$rain}}</rain>
                <dew_point>{{$wind_dir}}</dew_point>
                <temperature>{{$temperature}}</temperature>
                <temperature_max>{{$temperature_max}}</temperature_max>
                <temperature_min>{{$temperature_min}}</temperature_min>
                <wind_speed>{{$wind_speed}}</wind_speed>
                <wind_speed_max>{{$wind_speed_max}}</wind_speed_max>
                <wind_speed_avg>{{$wind_speed_avg}}</wind_speed_avg>
                <pressure>{{$pressure}}</pressure>
            </item>
    </channel>
</rss>


