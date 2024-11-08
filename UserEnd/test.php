<div class='page-container'>
    <!-- Header Section -->
    <section id='section-header' class='d-flex align-items-center justify-content-between mb-4'>
        <!-- Left Section: Back Button and Playlist Name -->
        <div class='d-flex align-items-center'>
            <!-- Back Button -->
            <form action='user-actions.php' method='get' class='d-inline-block'>
                <button type='submit' class='header-btn bg-transparent border-0 me-3' name='back-to-home-btn'>
                    <i class='fa-solid fa-arrow-left h1'></i>
                </button>
            </form>
            <!-- Playlist Name -->
            <h1 class='d-inline-block mb-0'>Playlist Name</h1>
        </div>

        <!-- Right Section: Delete Playlist Button -->
        <form action='delete-playlist.php' method='post' class='d-inline-block'>
            <input type='hidden' name='playlistID' value='<!-- Your playlist ID here -->'>
            <button type='submit' class='header-btn bg-transparent border-0 text-danger'>
                <i class='fa-solid fa-trash h1'></i>
            </button>
        </form>
    </section>

    <!-- Songs Table -->
    <div class='container-fluid'>
        <table class='table bg-white shadow-sm'>
            <thead class='thead-light'>
                <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Song</th>
                    <th scope='col'>Artist</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Rows -->
                <tr class='song-row'>
                    <td>1</td>
                    <td>
                        <button class='play-btn me-2'>
                            <i class='fa-solid fa-play'></i>
                        </button> Song Name 1
                    </td>
                    <td>Artist Name 1</td>
                </tr>
                <tr class='song-row'>
                    <td>2</td>
                    <td>
                        <button class='play-btn me-2'>
                            <i class='fa-solid fa-play'></i>
                        </button> Song Name 2
                    </td>
                    <td>Artist Name 2</td>
                </tr>
                <!-- Add more song rows dynamically with PHP -->
            </tbody>
        </table>
    </div>
</div>