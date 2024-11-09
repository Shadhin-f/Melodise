<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Page - MELODISE</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* General styling for a minimal and professional look */
        body {
            background-color: #f9f9f9;
            padding: 40px;
        }

        /* Top section */
        .artist-section {
            display: flex;
            gap: 40px;
            padding: 40px;
            align-items: flex-start;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 60px;
        }

        .artist-image {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            background-image: url('../Resources/DesignElements/ProfileEditBack.jpg');
            background-size: cover;
            background-position: center;
        }

        .artist-info {
            flex: 1;
        }

        .artist-name {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .artist-bio {
            margin-bottom: 20px;
            font-size: 0.9rem;
            color: #666;
        }

        .follow-button {
            border: 1px solid #1B8673;
            color: #1B8673;
            border-radius: 20px;
            font-size: 0.8rem;
            padding: 4px 10px;
            background-color: transparent;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .follow-button:hover {
            background-color: #1B8673;
            color: white;
        }

        .info-buttons {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .info-button {
            font-size: 0.9rem;
            border: 1px solid #ddd;
            padding: 6px 12px;
            border-radius: 20px;
            background-color: #f2f2f2;
            cursor: pointer;
        }

        /* Songs table */
        .songs-table-container {
            margin-top: 40px;
        }

        .songs-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .songs-table th,
        .songs-table td {
            padding: 12px 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .songs-table th {
            background-color: #1B8673;
            color: white;
        }

        .songs-table tr {
            transition: background-color 0.3s;
        }

        .songs-table tr:hover {
            background-color: #f1f1f1;
        }

        .add-to-playlist {
            color: #1B8673;
            cursor: pointer;
            transition: color 0.3s;
        }

        .add-to-playlist:hover {
            color: #0f5a42;
        }

        /* Albums section */
        .albums-section {
            margin-top: 60px;
        }

        .album-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .album-card {
            width: 180px;
            height: 180px;
            border-radius: 8px;
            overflow: hidden;
            background-image: url('../Resources/DesignElements/ProfileEditBack.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .album-card:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .album-name {
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
            text-align: center;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
    </style>
</head>

<body>

    <!-- Artist Section -->
    <div class="artist-section">
        <img class="artist-image" alt="Artist Image">
        <div class="artist-info">
            <div class="artist-name">Artist Name</div>
            <p class="artist-bio">Short bio about the artist. This section provides a brief introduction to the artist's background and achievements.</p>
            <button class="follow-button">Follow</button>
            <div class="info-buttons">
                <div class="info-button">Total Songs: 20</div>
                <div class="info-button">Albums Released: 5</div>
                <div class="info-button">Ranked #1</div>
            </div>
        </div>
    </div>

    <!-- Songs Table -->
    <div class="songs-table-container">
        <h3 class="mb-4">Songs</h3>
        <table class="songs-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Duration</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Song Title 1</td>
                    <td>3:45</td>
                    <td><i class="fas fa-plus add-to-playlist"></i></td>
                </tr>
                <tr>
                    <td>Song Title 2</td>
                    <td>4:20</td>
                    <td><i class="fas fa-plus add-to-playlist"></i></td>
                </tr>
                <!-- More song rows -->
            </tbody>
        </table>
    </div>

    <!-- Albums Section -->
    <div class="albums-section">
        <h3 class="mb-4">Albums</h3>
        <div class="album-cards">
            <div class="album-card">
                <div class="album-name">Album Title</div>
            </div>
            <div class="album-card">
                <div class="album-name">Another Album Title</div>
            </div>
            <!-- More album cards -->
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>