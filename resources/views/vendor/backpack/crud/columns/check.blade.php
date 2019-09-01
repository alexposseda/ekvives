{{-- checkbox with loose false/null/0 checking --}}
<?php
$icon = "fas fa-check-square";

if (strip_tags($entry->{$column['name']}) == false) {
    $icon = "far fa-square";
}
?>

<td>
    <i class="fa {{ $icon }}"></i>
</td>
