<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Search Users</title>
    <!-- Bootstrap CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <!-- FontAwesome Icons -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css' rel='stylesheet'>
    <style>
        .container-custom {
            background-color: white;
            border: 2px solid #1B8673;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
            max-width: 700px;
            margin-top: 2rem;
        }

        .text-primary-custom {
            color: #1B8673;
        }

        .btn-custom {
            background-color: #1B8673;
            color: white;
            border-radius: 50px;
            padding: 0.4rem 1.2rem;
        }

        .btn-custom:hover {
            background-color: #145a50;
        }
    </style>
</head>

<body>
    <!-- Main Search Section -->
    <section class='container container-custom'>
        <h2 class='text-primary-custom mb-4'>Search Users</h2>
        
        <!-- Search Form -->
        <form action='' method='GET'>
            <div class='input-group mb-4'>
                <input type='text' class='form-control' name='query' placeholder='Enter username or email' aria-label='Search' required>
                <button class='btn btn-custom' type='submit'>
                    <i class='fas fa-search'></i> Search
                </button>
            </div>
        </form>

        <!-- User List Table -->
        <div class='table-responsive'>
            <table class='table table-bordered align-middle'>
                <thead class='table-light'>
                    <tr>
                        <th scope='col'>User ID</th>
                        <th scope='col'>User Name</th>
                        <th scope='col'>User Email</th>
                        <th scope='col'>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>john.doe@example.com</td>
                        <td><a href='edit_user.html?id=1' class='btn btn-custom'>Edit</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>jane.smith@example.com</td>
                        <td><a href='edit_user.html?id=2' class='btn btn-custom'>Edit</a></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Alice Johnson</td>
                        <td>alice.johnson@example.com</td>
                        <td><a href='edit_user.html?id=3' class='btn btn-custom'>Edit</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- FontAwesome & Bootstrap JS -->
    <script src='https://kit.fontawesome.com/1621a0cc57.js' crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
</body>
</html>
