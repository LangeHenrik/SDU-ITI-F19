function onOpinion(source, opinion) {
    let imageId = source.getAttribute("data-id");
    let url = './opinion/' + imageId + '/' + opinion;

    fetch(url, { method: 'post' })
        .then(function(response) {
            if(response.status !== 200) {
                console.log('Error: ' + response.status);
            }

            return response.text();
        })
        .then(function(data) {
            if(data != '') {
                data = JSON.parse(data);

                let likes = document.getElementById('likes' + imageId);
                let dislikes = document.getElementById('dislikes' + imageId);
    
                likes.innerHTML = data['LIKES'];
                dislikes.innerHTML = data['DISLIKES'];
            }
        })
        .catch(function(err) {
            console.log('Fetch error: ', err);
        });
}