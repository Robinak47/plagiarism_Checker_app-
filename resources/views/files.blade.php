<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Upload File</h1>

        <!-- Upload Form -->
        <form action="{{ url('/upload-file') }}" method="POST" enctype="multipart/form-data">
            @csrf  <!-- Laravel CSRF protection -->
            
            <div class="mb-3">
                <label for="file" class="form-label">Choose File</label>
                <input class="form-control" type="file" id="file" name="file" required>
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</body>
</html>
