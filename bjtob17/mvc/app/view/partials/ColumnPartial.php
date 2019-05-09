<?php


namespace app\view\partials;


class ColumnPartial
{
    public static function show(callable $showFunction, array $items, int $columns = 3)
    {
        $colWidth = 12 / $columns;
        $arrayChunks = array_chunk($items, $columns);

        foreach ($arrayChunks as $items) {
            echo '<div class="columns">';
            foreach ($items as $item) {
                echo '<div class="column is-' . $colWidth . '">';
                $showFunction($item);
                echo '</div>';
            }
            echo '</div>';
        }
    }
}