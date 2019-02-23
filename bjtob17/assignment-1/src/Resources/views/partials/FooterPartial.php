<?php

namespace Resources\views\partials;


class FooterPartial
{
    public static function show()
    {
        echo <<<EOL
<footer class="main-footer">The footer</footer>
</div>

<script src="/Resources/js/js.js"></script>
</body>
</html>
EOL;

    }
}