function createNavigationBar() {

    let html =
        '<div class="navigation_bar__wrapper">' +
        '        <div class="navigation_bar__button" onclick="location.href=\'index.html\'">  Feed </div>' +
        '        <div class="navigation_bar__button" onclick="location.href=\'my_images.html\'"> My Images</div>' +
        '        <div class="navigation_bar__button" onclick="location.href=\'login.html\'"> Login </div>' +
        '    </div>';

    document.getElementById("navbar").innerHTML = html;

}

createNavigationBar();