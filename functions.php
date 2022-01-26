<?php
function readdata($result)
{
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function dd($data)
{
    var_dump($data);
    die;
}
