<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Table</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Table container styling */
        .table-container {
            background: rgba(255, 255, 255, 0.85);
            border: 2px solid #1B8673;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
        }
        /* Table header styling */
        .table-custom th {
            background-color: #1B8673;
            color: white;
        }
        /* Alternate row colors */
        .table-custom tbody tr:nth-child(odd) {
            background-color: rgba(27, 134, 115, 0.1); /* Light shade of theme color */
        }
        .table-custom tbody tr:nth-child(even) {
            background-color: rgba(27, 134, 115, 0.2); /* Slightly darker shade */
        }
        /* Header and Title Styling */
        .text-primary-custom {
            color: #1B8673;
        }
    </style>
</head>
<body>

<div class="container my-5 table-container">
    <h2 class="text-center mb-4 text-primary-custom">Subscription Details</h2>
    <table class="table table-bordered table-hover table-custom">
        <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Transaction ID</th>
                <th scope="col">Package Name</th>
                <th scope="col">Subscription Ends</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>john_doe</td>
                <td>TX12345</td>
                <td>Premium</td>
                <td>2024-11-05</td>
            </tr>
            <tr>
                <td>jane_smith</td>
                <td>TX12346</td>
                <td>Basic</td>
                <td>2024-10-30</td>
            </tr>
            <tr>
                <td>alex_jones</td>
                <td>TX12347</td>
                <td>Standard</td>
                <td>2024-12-15</td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</div>

</body>
</html>
