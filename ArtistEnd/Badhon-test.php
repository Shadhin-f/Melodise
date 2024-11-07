<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Release Form - MELODISE</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styling -->
    <style>
        /* Background image for the whole page */
        body {
            background-image: url('../Resources/DesignElements/ProfileEditBack.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* Centered form card style */
        .form-card {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 10px;
            padding: 2rem;
            max-width: 500px;
            width: 100%;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Logo and title styling */
        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #1B8673;
        }

        /* Input field styling */
        .form-control, .form-select {
            border: none;
            border-bottom: 2px solid #1B8673;
            border-radius: 0;
            box-shadow: none;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: none;
            border-color: #1B8673;
        }

        /* Button styling */
        .btn-custom {
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
        }

        .btn-submit {
            background-color: #1B8673;
            color: white;
        }

        .btn-submit:hover {
            background-color: #145a50;
        }
    </style>
</head>

<body>

    <div class="form-card text-center">
        <div class="logo mb-3">MELODISE</div>
        <h2 class="mb-4">Music Release Form</h2>

        <!-- Music Release Form -->
        <form>
            <div class="mb-3">
                <input type="text" class="form-control" id="songTitle" placeholder="Enter song title" required>
            </div>
            <div class="mb-3">
                <input type="date" class="form-control" id="releaseDate" placeholder="Select release date" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" id="duration" placeholder="Enter duration (e.g., 3:45)" required>
            </div>
            <div class="mb-3">
                <select id="album" class="form-select" required>
                    <option selected disabled>Select album</option>
                    <option value="Album 1">Album 1</option>
                    <option value="Album 2">Album 2</option>
                    <option value="Album 3">Album 3</option>
                </select>
            </div>
            <div class="mb-3">
                <select id="genre" class="form-select" required>
                    <option selected disabled>Select genre</option>
                    <option value="Pop">Pop</option>
                    <option value="Rock">Rock</option>
                    <option value="Jazz">Jazz</option>
                    <option value="Classical">Classical</option>
                    <option value="Hip-Hop">Hip-Hop</option>
                </select>
            </div>
            <div class="mb-3">
                    <label for="mp3File" class="form-label">Upload MP3 File</label>
                    <input type="file" class="form-control" id="mp3File" accept=".mp3" required>
            </div>
            <div class="mb-3 text-start">
                <label for="colorCode" class="form-label">Color Code</label>
                <input type="color" class="form-control form-control-color" id="colorCode" value="#1B8673" required>
                <input type="text" id="colorHex" class="form-control mt-2" readonly>
            </div>

            <button type="submit" class="btn btn-custom btn-submit w-100 mt-3">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for showing hex code -->
    <script>
        const colorCodeInput = document.getElementById('colorCode');
        const colorHexInput = document.getElementById('colorHex');

        // Set initial color hex value
        colorHexInput.value = colorCodeInput.value;

        // Update hex code display when color is changed
        colorCodeInput.addEventListener('input', () => {
            colorHexInput.value = colorCodeInput.value;
        });
    </script>
</body>

</html>
