<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My page</title>
    <link rel="stylesheet" type="text/css" href="General.css">
</head>
<body>
<div class="container">
    <div id="navbar"></div>
    <div class="ajax_button" onclick="letsDoAjaxWithFetch()"> Click me for free Ajax!</div>
    <div id="ajax_container" class="ajax_container">
    </div>
</div>


<script src="navbar.js"></script>
<script>
    function letsDoAjaxWithFetch() {
        fetch(
            "https://simple.wikipedia.org/w/api.php?action=query&generator=random&grnnamespace=0&prop=extracts&exsentences=10&origin=*&format=json",
            {
                method: "GET"
            }
        )
            .then(response => response.json())
            .then(json => {
                addWikiArticle(json)
            })
            .catch(error => {
                console.log(error.message);
            });
    }


    function addWikiArticle(json) {
        let key = Object.keys(json.query.pages)[0];
        let article = json.query.pages[key];
        let title = article.title;
        let content = article.extract;


        let node = document.createElement("div");
        node.innerHTML = "<h1>"+ title + "</h1><br/>" + content + "<br/><br/><br/><br/><br/>"

        let container = document.getElementById('ajax_container');
        container.append(node);



        console.log(title, "\n", content);
    }


</script>
</body>
</html>