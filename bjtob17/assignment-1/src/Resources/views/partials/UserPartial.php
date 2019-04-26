<?php
/**
 * Created by IntelliJ IDEA.
 * User: bt
 * Date: 02/03/19
 * Time: 15:01
 */

namespace Resources\views\partials;


use Models\User;

class UserPartial
{
    public static function show(User $user)
    {
        echo <<<EOL
<div class="card">
    <article>
        <div class="author">
            <p>$user->username</p>
        </div>
        <div class="image">
            <img src="https://robohash.org/$user->username" alt="">
        </div>
        <div class="text">
            <p>$user->firstName $user->lastName</p> 
            <p><a href="mailto:$user->email">$user->email</a></p>
        </div>
    </article>
</div>
EOL;

    }
}