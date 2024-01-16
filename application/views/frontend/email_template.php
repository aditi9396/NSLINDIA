<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <form>
        <table>
            <thead>
                <tr>
                    <th nowrap>Lr No</th>
                    <th nowrap>Date</th>
                    <th nowrap>Contact Person</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reports as $row): ?>
                    <tr>
                        <td nowrap><?= $row['LRNO'] ?></td>
                        <td nowrap><?= $row['Date'] ?></td>
                        <td nowrap><?= $row['PersonName'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</body>
</html>
