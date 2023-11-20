<?php
include 'template.php'; // Include the template file
require_once 'connect.php';

// Check if the "Add" button is clicked
if (isset($_POST['addButton'])) {
    $name = $_POST['name'];
    $loaisanpham = $_POST['loaisanpham'];
    $donvitinh = $_POST['donvitinh'];


    // Insert data into the 'sanpham' table
    $sql = "INSERT INTO sanpham (ten,id_loaisanpham,id_donvitinh) VALUES ('$name','$loaisanpham', '$donvitinh')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the same page after adding the role
        header("Location: sanpham.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if the search form is submitted
if (isset($_POST['searchButton'])) {
    $searchTerm = $_POST['searchBox'];
    // Modify your SQL query to include the search term
    $sql = "SELECT * FROM sanpham WHERE name LIKE '%$searchTerm%'";
} else {
    // Default query to retrieve all roles
    $sql = "SELECT sanpham.id, sanpham.ten, loaisanpham.ten as loaisanpham, donvitinh.ten as donvitinh FROM sanpham inner join loaisanpham on sanpham.id_loaisanpham = loaisanpham.id inner join donvitinh on sanpham.id_donvitinh = donvitinh.id";
}

// Execute the query and fetch data
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
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

        .input-field,
        select {
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
            <label for="name">Tên sản phẩm</label>
            <input type="text" class="input-field" id="name" placeholder="Tên sản phẩm">
        </div>
        <div class="input-row">
            <label for="loaisanphamInput">Loại sản phẩm</label>
            <select required name="loaisanphamInput" id="loaisanpham" class="form-control text-light">
                <?php

                // Retrieve data from the database and populate the table
                $sql = "SELECT * FROM loaisanpham"; // Replace 'users' with your actual table name
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["id"] . '">' . $row["ten"] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="input-row">
            <label for="donvitinhInput">Đơn vị tính</label>
            <select required name="donvitinhInput" id="donvitinh" class="form-control text-light">
                <?php

                // Retrieve data from the database and populate the table
                $sql = "SELECT * FROM donvitinh"; // Replace 'users' with your actual table name
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["id"] . '">' . $row["ten"] . '</option>';
                    }
                }
                ?>
            </select>
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
            <th>Tên sản phẩm</th>
            <th>Loại sản phẩm</th>
            <th>Đơn vị tính</th>
            <th>Thao tác</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["ten"] . "</td>";
                echo "<td>" . $row["loaisanpham"] . "</td>";
                echo "<td>" . $row["donvitinh"] . "</td>";
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
        var loaisanpham = document.getElementById('loaisanpham').value;
        var donvitinh = document.getElementById('donvitinh').value;

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

        var loaisanphamInput = document.createElement('input');
        nameInput.type = 'hidden';
        nameInput.name = 'loaisanpham';
        nameInput.value = loaisanpham;

        var donvitinhInput = document.createElement('input');
        nameInput.type = 'hidden';
        nameInput.name = 'donvitinh';
        nameInput.value = donvitinh;


        form.appendChild(addButtonInput);
        form.appendChild(nameInput);
        form.appendChild(loaisanphamInput);
        form.appendChild(donvitinhInput);

        console.log(loaisanphamInput)
        console.log(donvitinhInput)

        document.body.appendChild(form);
        form.submit();
    });
</script>

<?php
include 'footer.php'; // Include the template file
?>