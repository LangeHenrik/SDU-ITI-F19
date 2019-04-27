<?php


namespace app\view\partials;


use app\model\User;

class UserPartial
{
    public static function show(User $user)
    {
        echo <<<EOL
<div class="card">
  <div class="card-image">
    <figure class="image is-4by3">
          <img src="https://robohash.org/$user->username" alt="">
    </figure>
  </div>
  <div class="card-content">
    <div class="media">
      <div class="media-left">
        <figure class="image is-48x48">
          <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
        </figure>
      </div>
      <div class="media-content">
        <p class="title is-4">$user->firstName $user->lastName</p>
        <p class="subtitle is-6">@$user->username</p>
      </div>
    </div>

   
  </div>
</div>
EOL;

    }
}