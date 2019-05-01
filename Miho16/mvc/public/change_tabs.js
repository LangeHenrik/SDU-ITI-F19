function changeTab(evt, targetTab, tabcontent, tablinks) {
    let i;

    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(targetTab).style.display = "block";
    evt.currentTarget.className += " active";
}
