<?php
include 'template.php'; // Include the template file
?>
<?php
require_once 'connect.php';
if (isset($_POST['addButton'])) {
    // Retrieve data from input fields
    $ten = $_POST['ten'];
    $cmnd = $_POST['cmnd'];
    $ngaysinh = $_POST['ngaysinh'];
    $dienthoai = $_POST['dienthoai'];
    $diachi = $_POST['diachi'];

    // Insert data into the database
    $sql = "INSERT INTO khachhang (ten, cmnd, ngaysinh,dienthoai,diachi) VALUES ('$ten', '$cmnd', '$ngaysinh', '$dienthoai', '$diachi')";

    if ($conn->query($sql) === TRUE) {
        // echo "Record added successfully";
        echo '<script>window.location.href = window.location.href;</script>'; // Reload the page
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if the "Delete" button is clicked
if (isset($_POST['deleteButton'])) {
    $userIdToDelete = $_POST['userIdToDelete'];

    // Perform the delete operation
    $sqlDelete = "DELETE FROM khachhang WHERE id = $userIdToDelete"; // Replace 'users' with your actual table name

    if ($conn->query($sqlDelete) === TRUE) {
        echo '<script>window.location.href = window.location.href;</script>'; // Reload the page
    } else {
        echo '<script>alert("Error deleting user: ' . $conn->error . '");</script>';
    }
}

if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchQuery'];
    // Modify your SQL query to include the search term
    $sql = "SELECT * FROM khachhang WHERE ten LIKE '%$searchTerm%'";
} else {
    // Default query to retrieve all records
    $sql = "SELECT * FROM khachhang";
}

// Execute the query and fetch data as before
$result = $conn->query($sql);

?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khách hàng</title>
    <style>
        body {
            color: white;
        }

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

<!-- <body> -->

<!-- Search Section -->
<div id="searchSection">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="searchQuery">Nhập tên khách hàng:</label>
        <input type="text" name="searchQuery" id="searchQuery" required>
        <button type="submit" name='search'>Tìm kiếm</button>
    </form>
</div>

<!-- Input Section -->
<div id="inputSection">
    <div class="input-container">
        <div class="input-row">
            <input type="text" class="input-field" id="ten" placeholder="Tên khách hàng">
            <input type="text" class="input-field" id="cmnd" placeholder="CCCD">
        </div>
        <div class="input-row">
            <input type="text" class="input-field" id="ngaysinh" placeholder="Ngày sinh">
            <input type="text" class="input-field" id="dienthoai" placeholder="Số điện thoại">
        </div>
        <div class="input-row">
            <input type="text" class="input-field" id="diachi" placeholder="Địa chỉ">
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
            <th>Tên khách hàng</th>
            <th>CCCD</th>
            <th>Ngày sinh</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Thao tác</th>
        </tr>
        <?php
        // Include the database connection settings from connect.php
        include 'connect.php';

        // Retrieve data from the database and populate the table
        $sql = "SELECT * FROM khachhang"; // Replace 'users' with your actual table name
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["ten"] . "</td>";
                echo "<td>" . $row["cmnd"] . "</td>";
                echo "<td>" . $row["ngaysinh"] . "</td>";
                echo "<td>" . $row["dienthoai"] . "</td>";
                echo "<td>" . $row["diachi"] . "</td>";
                echo '<td><form method="post"><input type="hidden" name="userIdToDelete" value="' . $row["id"] . '"><button class="delete-button" type="submit" name="deleteButton">Delete</button></form></td>';
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
        var ten = document.getElementById('ten').value;
        var cmnd = document.getElementById('cmnd').value;
        var ngaysinh = document.getElementById('ngaysinh').value;
        var dienthoai = document.getElementById('dienthoai').value;
        var diachi = document.getElementById('diachi').value;

        // Create a form and submit it to trigger the PHP code
        var form = document.createElement('form');
        form.method = 'post';
        form.action = '';

        var addButtonInput = document.createElement('input');
        addButtonInput.type = 'hidden';
        addButtonInput.name = 'addButton';
        addButtonInput.value = '1';

        var tenInput = document.createElement('input');
        tenInput.type = 'hidden';
        tenInput.name = 'ten';
        tenInput.value = ten;

        var cmndInput = document.createElement('input');
        cmndInput.type = 'hidden';
        cmndInput.name = 'cmnd';
        cmndInput.value = cmnd;

        var ngaysinhInput = document.createElement('input');
        ngaysinhInput.type = 'hidden';
        ngaysinhInput.name = 'ngaysinh';
        ngaysinhInput.value = ngaysinh;

        var dienthoaiInput = document.createElement('input');
        dienthoaiInput.type = 'hidden';
        dienthoaiInput.name = 'dienthoai';
        dienthoaiInput.value = dienthoai;

        var diachiInput = document.createElement('input');
        diachiInput.type = 'hidden';
        diachiInput.name = 'diachi';
        diachiInput.value = diachi;

        form.appendChild(addButtonInput);
        form.appendChild(tenInput);
        form.appendChild(cmndInput);
        form.appendChild(ngaysinhInput);
        form.appendChild(dienthoaiInput);
        form.appendChild(diachiInput);

        document.body.appendChild(form);
        form.submit();
    });
</script>
<?php
include 'footer.php'; // Include the template file
?>