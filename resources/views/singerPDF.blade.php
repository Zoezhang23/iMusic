<div>
    <img src="{{'img/' . $singer->singer_pic_url}}" 
         style="width: 280px; border-radius: 20px"/>
    <div style="margin-bottom: 20px; font-size: 20px; color: #1b6d85; margin-top: 20px">{{ $singer->singer_name }}</div>
    <div style="font-size: 16px; line-height: 22px; word-spacing: 2px">{{ $singer->description }}</div>
</div>


@if(count($songs) != 0)
<table class="table table-striped" style="margin-top: 80px">
    <thead>
        <tr>
            <th style="width: 15%">name</th>
            <th style="width: 70%">description</th>
            <th style="width: 15%">author</th>
        </tr>
    </thead>
    <tbody>
        @foreach($songs as $song)
        <tr>
            <td style="width: 15%">{{ $song->song_name }}</td>
            <td style="width: 70%">{{ $song->description }}</td>
            <td style="width: 15%">{{ \App\User::find($song->user_id)->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
