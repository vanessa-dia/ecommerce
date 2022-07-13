        <tr class="d-flex flex-row itemCart" id=<?= $key ?>>
            <td class="col-sm-1"><? echo $count;
                                    $count += 1; ?></td>
            <td class="col itemCart-name"><?= $cart['idProduct'] ?></td>
            <td class="col"><?= $cart['amount'] ?></td>
            <td class="col itemCart-money"><?= $cart['money'] ?></td>
        </tr>