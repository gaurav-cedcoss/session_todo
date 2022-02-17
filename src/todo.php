<?php
session_start();
if (!isset($_SESSION["todo"])) {
    $_SESSION["todo"] = array();
}
// print_r($_SESSION);
?>
<html>

<head>
    <title>TODO List</title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>TODO LIST</h2>
        <h3>Add Item</h3>
        <p>
            <?php if (isset($_SESSION["add"])) {
                $val = $_SESSION["add"];
                $action = "todoAction.php?name=$val&action=update";
                $btn = "Update";
            } else {
                $action = "todoAction.php?action=add";
                $btn = "Add";
            } ?>
        <form action="<?php echo $action; ?>" method="post"><input id="new-task" name="new-task" type="text" value="<?php echo $_SESSION["add"]; ?>"><button><?php echo $btn; ?></button></form>
        </p>

        <h3>Todo</h3>
        <ul id="incomplete-tasks">
            <?php foreach ($_SESSION["todo"] as $key => $val) {
                if ($_SESSION["todo"][$key]["status"] == 0) {
            ?>
                    <li>
                        <form action="todoAction.php?status=1&name=<?php echo $_SESSION["todo"][$key]["name"]; ?>&action=updateStatus" method="post">
                            <input type="checkbox" onclick="form.submit()">
                        </form>
                        <label><?php echo $_SESSION["todo"][$key]["name"]; ?></label>
                        <input type="text" value="Go Shopping">
                        <button class="edit"><a href="todoAction.php?name=<?php echo $_SESSION["todo"][$key]["name"]; ?>&action=edit">Edit</a></button>
                        <button class="delete"> <a href="todoAction.php?name=<?php echo $_SESSION["todo"][$key]["name"]; ?>&action=delete">Delete</a></button>

                    </li>
            <?php }
            } ?>
        </ul>

        <h3>Completed</h3>
        <ul id="completed-tasks">
            <?php foreach ($_SESSION["todo"] as $key => $val) {
                if ($_SESSION["todo"][$key]["status"] == 1) {
            ?>
                    <li>
                        <form action="todoAction.php?status=0&name=<?php echo $_SESSION["todo"][$key]["name"]; ?>&action=updateStatus" method="post">
                            <input type="checkbox" onclick="form.submit()" checked>
                        </form>
                        <label><?php echo $_SESSION["todo"][$key]["name"]; ?></label>
                        <input type="text">
                        <button class="edit"><a href="todoAction.php?name=<?php echo $_SESSION["todo"][$key]["name"]; ?>&action=edit">Edit</a></button>
                        <button class="delete"> <a href="todoAction.php?name=<?php echo $_SESSION["todo"][$key]["name"]; ?>&action=delete">Delete</a></button>

                    </li>
            <?php }
            } ?>
        </ul>
    </div>

</body>

</html>