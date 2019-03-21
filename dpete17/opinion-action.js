function onOpinion(source, opinion) {
    let imageId = source.getAttribute("data-id");

    fetch('../action/opinion.php?iid=' + imageId + '&opinion=' + opinion, { method: 'post' })
    .then(function(response) {
        if(response.status != 200) {
            console.log('Error: ' + response.status);
            return;
        }

        response.json().then(function(data) {
            if(data != '') {
                let likes = document.getElementById('likes' + imageId);
                let dislikes = document.getElementById('dislikes' + imageId);

                likes.innerHTML = data['LIKES'];
                dislikes.innerHTML = data['DISLIKES'];
            }
        })
    });
}