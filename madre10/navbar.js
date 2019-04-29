function createNavigationBar() {

    let html =
        '<div class="navigation_bar__wrapper">' +
        '        <div class="navigation_bar__button" onclick="location.href=\'index.php\'">  Feed </div>' +
        '        <div class="navigation_bar__button" onclick="location.href=\'my_images.php\'"> My Images</div>' +
        '        <div class="navigation_bar__button" onclick="location.href=\'my_page.php\'"> My page </div>' +
        '        <div class="navigation_bar__button" onclick="location.href=\'users.php\'"> Users </div>' +
        '        <div class="navigation_bar__button" onclick="location.href=\'ajax.php\'"> Ajax!</div>' +
        '    </div>';

    document.getElementById("navbar").innerHTML = html;

}

createNavigationBar();