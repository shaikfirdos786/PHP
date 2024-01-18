<table>
    <tr>
        <td>Filter Name</td>
        <td>Filter ID</td>
    </tr>
    <?php
    foreach(filter_list() as $id => $filter) {
        echo '<tr><td>'.$filter.'</td><td>'.filter_id($filter).'</td></tr>';
    }
    ?>
</table>