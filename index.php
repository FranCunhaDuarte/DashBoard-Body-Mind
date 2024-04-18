<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require_once './app/Model/members.api.model.php';

    $model = new MembersApiModel();

    $members = $model->getMembers();

    echo $members;
    ?>
</body>
</html>
