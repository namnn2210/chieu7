<?php
include 'template.php'; // Include the template file
require_once 'connect.php';

// Check if the "Add" button is clicked
if (isset($_POST['addButton'])) {
    $name = $_POST['name'];

    // Insert data into the 'phongban' table
    $sql = "INSERT INTO phongban (ten) VALUES ('$name')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the same page after adding the role
        header("Location: phongban.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if the search form is submitted
if (isset($_POST['searchButton'])) {
    $searchTerm = $_POST['searchBox'];
    // Modify your SQL query to include the search term
    $sql = "SELECT * FROM phongban WHERE name LIKE '%$searchTerm%'";
} else {
    // Default query to retrieve all roles
    $sql = "SELECT * FROM phongban";
}

// Execute the query and fetch data
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phòng ban</title>
    <style>
        /* Style for the search box section */
        #searchSection {
            float: right;
            padding: 20px;
        }

        #searchBox {
            width: 200px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #searchButton {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Style for the input section */
        #inputSection {
            padding: 20px;
        }

        .input-container {
            margin: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .input-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
        }

        .input-field {
            flex: 1;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #addButton {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Style for the table section */
        #tableSection {
            padding: 20px;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .delete-button {
            background-color: #ff0000;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<!-- Search Section -->
<div id="searchSection">
    <form method="POST">
        <input type="text" name="searchBox" id="searchBox" placeholder="Tìm kiếm theo tên">
        <button type="submit" name="searchButton" id="searchButton">Tìm kiếm</button>
    </form>
</div>

<!-- Input Section -->
<div id="inputSection">
    <div class="input-container">
        <div class="input-row">
            <input type="text" class="input-field" id="name" placeholder="Tên phòng ban">
        </div>
        <div class="input-row">
            <button id="addButton">Thêm</button>
        </div>
    </div>
</div>

<!-- Table Section -->
<div id="tableSection">
    <table>
        <tr>
            <th>ID</th>
            <th>Tên phòng ban</th>
            <th>Thao tác</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["ten"] . "</td>";
                echo '<td><form method="post"><input type="hidden" name="roleIdToDelete" value="' . $row["id"] . '"><button class="delete-button" type="submit" name="deleteButton">Xóa</button></form></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Không có dữ liệu</td></tr>";
        }
        ?>
    </table>
</div>

<script>
    // JavaScript to handle the Add button click
    document.getElementById('addButton').addEventListener('click', function() {
        var name = document.getElementById('name').value;

        // Create a form and submit it to trigger the PHP code
        var form = document.createElement('form');
        form.method = 'post';
        form.action = '';

        var addButtonInput = document.createElement('input');
        addButtonInput.type = 'hidden';
        addButtonInput.name = 'addButton';
        addButtonInput.value = '1';

        var nameInput = document.createElement('input');
        nameInput.type = 'hidden';
        nameInput.name = 'name';
        nameInput.value = name;

        form.appendChild(addButtonInput);
        form.appendChild(nameInput);

        document.body.appendChild(form);
        form.submit();
    });
</script>

<?php
include 'footer.php'; // Include the template file
?>