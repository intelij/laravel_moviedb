$(document).ready(function () {
    var vidId;
    $.ajax({
        url: "https://www.googleapis.com/youtube/v3/search?part=snippet" +
        "&type=video" +
        "&q="+$('#title').text() +" " + $('#year').text() + " trailer" +
        "&maxResults=1" +
        "&key=AIzaSyDlprtuZ3JC6UD5C8vnzRosF2XIRnQ5d8E",
        type: "GET",
        async: false,
        success : function (response) {
            vidId = response['items'][0]['id'].videoId;

            $('#player').attr('src','http://www.youtube.com/embed/'+vidId);

        },
        error : function (error) {
            console.log(error);
        }
    });


    set_votes($('.rate_widget'));

    $('.ratings_stars').hover(
        function () {
            $(this).prevAll().addBack().addClass('ratings_vote');
            $(this).nextAll().removeClass('rating_vote');
        },
        function () {
            $(this).nextAll().addBack().removeClass('ratings_vote');
        }
    );

    $('.ratings_stars').click(function () {
        var mid = location.pathname.split("/");

        axios.post('/user/rate',{
            'mid':mid[2],
            'rating':$(this).attr('id')
        })
            .then(function (response) {
                window.location.reload();
            })
            .catch(function (error) {
                console.log(error)
            });
    });
});

function set_votes(widget) {

    var mid = location.pathname.split("/");

    axios.post('/user/rating',{
        'mid':mid[2]
    })
        .then(function (response) {
            $(widget).find('#'+response.data).prevAll().addBack().addClass('ratings_vote');
            $(widget).find('#'+response.data).nextAll().removeClass('rating_vote');
        })
        .catch(function (error) {
            console.log(error)
        });
}