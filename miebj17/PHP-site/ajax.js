$("#showUsers").click(function(){
    $("#usersDiv").empty()
    $.ajax({
            url: "ajax.php",
            type: "POST",
            dataType: "json",
                success: function (data) {
                    $("#usersDiv").append(`
                    <table class="greyGridTable">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Created at</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Zip</th>
                        <th>City</th>
                        <th>Email</th>
                        <th>Phonenumber</th>
                    </tr>
                    </thead>
                    <tbody id="usersTbody">
                
                    </tbody>
                </table>
                    `)
                    $.each(data, function(index, item) {
                        if(item.id == undefined){}else{
                    $("#usersTbody").append(`
                    <tr id="${item.id}">
                        <td>${item.username}</td>
                        <td>${item.created_at}</td>
                        <td>${item.firstname}</td>
                        <td>${item.lastname}</td>
                        <td>${item.zip}</td>
                        <td>${item.city}</td>
                        <td>${item.email}</td>
                        <td>${item.phonenumber}</td>
                    </tr>`);}
                    });
                        }
                , error: function (data) {
                        }
                    });
});