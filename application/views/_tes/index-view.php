<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ini Tes</title>
</head>

<body>
    <form method="POST" action="<?= base_url('tes/insert') ?>">
        <label for="nama">Nama</label>
        <input type="text" name="nama">
        <button type="submit">Submit</button>
        <?= form_error('nama', '<br><small class="text-danger">', '</small>') ?>
    </form>
</body>

</html>