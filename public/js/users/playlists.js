$(document).ready(function () {
    $('.compartilhar-btn').on('click', function () {
        let row = $(this).closest('tr');
        let spotifyId = row.find('a.btn-success').attr('href').split('/').pop();
        let name = row.find('td:nth-child(3)').text();
        let coverUrl = row.find('img').attr('src') || null;

        $.ajax({
            url: '/playlists/store',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                spotify_id: spotifyId,
                name: name,
                cover_url: coverUrl
            },
            success: function (response) {
                alert(response.message);
            },
            error: function (xhr) {
                alert('Erro ao compartilhar a playlist: ' + xhr.responseJSON.message);
            }
        });
    });
});
