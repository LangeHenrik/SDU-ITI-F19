<?php

namespace Resources\views\partials;


class FooterPartial
{
    public static function show()
    {
        echo <<<EOL
<footer class="main-footer">
<div class="column">
<p class="title">Contact:</p>
<p>admin@photowebsite.com</p>
</div>
<div class="column">
<p class="title">Adresse:</p>
<p>Nicevej 69, Odense 5000</p>
</div>
<div class="column">
Tredje kolonne
</div>
</footer>
</div>

<script src="/Resources/js/js.js"></script>
</body>
</html>
EOL;

    }
}