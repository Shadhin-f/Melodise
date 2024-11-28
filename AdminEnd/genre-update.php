<?php 
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Genres Management</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    
    body {
        background: radial-gradient(circle, rgba(232,247,244,1) 0%, rgba(211,231,228,1) 100%);
        font-family: Arial, sans-serif;
        color: #333;
    }

    .container {
        max-width: 800px;
        margin-top: 30px;
    }

    .container#blur.active {
        filter: blur(10px);
        pointer-events: none;
    }

    .table-wrapper {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .table-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #1B8673;
        background-color: #e6f2e6;
        padding: 15px;
        border-radius: 10px 10px 0 0;
        border-bottom: 2px solid #1B8673;
    }

    .btn-primary {
        background-color: #1B8673 !important;
        color: white;
    }

    .btn-primary:hover {
        background-color: #145a50;
    }

    table.table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    table.table th, table.table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    table.table tbody tr:hover {
        background-color: #f0f8f4;
    }

    table.table td a {
        color: #1B8673;
        text-decoration: none;
    }

    /* Add Genre Form Styles */
    .genre-form {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .genre-form.active {
        display: flex;
    }

    .form-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        width: 400px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .form-header h4 {
        color: #1B8673;
        margin: 0;
        text-align: center;
    }

    .form-body input {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .form-footer {
        display: flex;
        justify-content: space-between;
        padding: 10px;
    }

    .close-form-btn {
        color: #1B8673;
        font-size: 20px;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
    }
</style>

</head>
<body>

<!-- Navigation bar -->

<?php 
    include('navbar.php')
?>


<?php
if(isset($_SESSION['adminname'])){
    echo "
    <div class='container' id='blur'>
        <div class='table-wrapper'>
            <div class='table-title'>
                <h2>Genres</h2>
                <a href='#' onclick='addForm_toggle()' class='btn btn-primary'>
                    <i class='fas fa-plus'></i> Add New Genre
                </a>

            </div>
            <table class='table'>
                <thead>
                    <tr>
                        <th>Genre ID</th>
                        <th>Genre Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";

    $select_genres = "SELECT * FROM genres";  // Query to fetch genres
    $result_genres = mysqli_query($conn, $select_genres);

    while ($row_data = mysqli_fetch_assoc($result_genres)) {
        $genre_id = $row_data['GenreID'];
        $title = $row_data['Title'];  

        echo "
            <tr>
                <td>$genre_id</td>
                <td>$title</td>
                <td>
                    <form action='adminaction.php' method='POST'>
                        <input type='hidden' name='GenreID' value='<?php echo $genre_id; ?>'>
                        <button type='button' class='btn btn-primary' onclick='editForm_toggle()'>
                           <i class='bi bi-pencil-square'></i>
                        </button>
                    </form>
                </td>
            </tr>";
    }

    echo "
                </tbody>
            </table>
        </div>
    </div>";
}
?>  

<!-- Add Genre Form -->
<div id="addGenre" class="genre-form">
    <div class="form-content">
        <div class="form-header">
            <h4>Add New Genre</h4>
        </div>
        <form action="adminaction.php" method="POST">
            <div class="form-body">
                <label for="genreTitle">Genre Title</label>
                <input type="text" id="genreTitle" name="genreTitle" class="form-control" required>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary" name='add_new_genre_btn'>Add Genre</button>
                <button type="button" class="btn btn-secondary close-form-btn">Cancel</button>
            </div>
        </form>
    </div>
    <a href='#' onclick='closeForm()' class="close-form-btn"></a>
</div>

<div id="editGenre" class="genre-form">
    <div class="form-content">
        <div class="form-header">
            <h4>Edit Genre</h4>
        </div>
        <form action="adminaction.php" method="POST">
            <input type="hidden" name="GenreID" value="<?php echo $genre_id; ?>">
            
            <div class="form-body">
                <label for="genreTitle">Genre Title</label>
                <input type="text" id="genreTitle" name="genreTitle" class="form-control" placeholder="Title" required>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary" name="save_button">Save Genre Title</button>
                <button type="button" class="btn btn-secondary close-form-btn">Cancel</button>
            </div>
        </form>
    </div>
    <a href="#" onclick="closeForm()" class="close-form-btn"></a>
</div>


<script type="text/javascript">
    function addForm_toggle() {
        var blur = document.getElementById('blur');
        blur.classList.toggle('active');
        var addForm = document.getElementById('addGenre');
        addForm.classList.toggle('active');
    }

    function editForm_toggle() {
        var blur = document.getElementById('blur');
        blur.classList.toggle('active');
        var editForm = document.getElementById('editGenre');
        editForm.classList.toggle('active');  // Corrected: toggling the edit form
    }

    function closeForm() {
        var blur = document.getElementById('blur');
        blur.classList.remove('active');
        var addForm = document.getElementById('addGenre');
        var editForm = document.getElementById('editGenre');
        addForm.classList.remove('active');
        editForm.classList.remove('active');
    }

    // Close the form when the cancel button or close 'X' is clicked
    document.querySelectorAll('.close-form-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            closeForm();
        });
    });




</script>

<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
