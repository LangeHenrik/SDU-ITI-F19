<?php


namespace app\view\partials;


class FooterPartial
{
    public static function show(array $viewBag)
    {
        echo <<<EOL
</div>
</body>
</html>
EOL;

    }
}