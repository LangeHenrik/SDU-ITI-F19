document.addEventListener("DOMContentLoaded", function (event) {


    function addSearchUserEventListener() {

        console.log('Add event listener')

        if(document.getElementById('btnSearchUsers') != null) {
            btnSearchUsers = document.getElementById('btnSearchUsers');
            btnSearchUsers.addEventListener('click', searchUsers, false);
        }
    }

    addSearchUserEventListener();

    function searchUsers() {
        searchParam = document.getElementById('inputSearchUsers').value;
        console.log(searchParam)
        fetch('searchUsers.php')
            .then(response =>{ return response.json()})
            .then(response => buildUserSearchResults(response))
            .catch(e => console.log(e));

    }

    function buildUserSearchResults(response) {
        console.log(response)
        clearResultList()

        counter = 0;


        for(user of response) {
            resultList = document.getElementById('users-container');
            result = document.createElement('div');
            if(counter == 0 || counter%2 == 0) {
                result.className = 'user-search-result-even'
            } else {
                result.className = 'user-search-result-odd'
            }
           // result.className = 'user-search-result';
            usernameHeader = document.createElement('H1');
            resultUsername = document.createTextNode(user.username);
            nameElement = document.createElement('span');
            nameText = document.createTextNode(user.firstname + ' ' + user.lastname);
            usernameHeader.appendChild(resultUsername);
            nameElement.appendChild(nameText)
            result.appendChild(usernameHeader)
            result.appendChild(nameElement)
            resultList.append(result);
            counter++;
        }
    }

    function clearResultList() {
        list = document.getElementById('users-container');
        list.innerHTML = '';
        /*
        while(list.firstChild) {
            list.removeChild(list.firstChild);
        }

        */


    }

});