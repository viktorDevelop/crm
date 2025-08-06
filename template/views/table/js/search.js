<input type="text" className="form-control" placeholder="search">
    <table className="table"">
    <thead>

            <?foreach ($postData as $key=>$val):?>
                <th><?=$key?></th>
            <?endforeach;?>

    </thead>
        <tr >
            <?foreach ($postData as $item):?>
                <td><?=$item?></td>
            <?endforeach;?>
        </tr>

    </table>