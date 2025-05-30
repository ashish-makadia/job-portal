<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post a Job</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-2xl bg-white p-8 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6 text-center text-indigo-700">Post a New Job</h1>

        <!-- Success/Error messages -->
        <div id="alertSuccess" class="hidden mb-4 p-3 rounded bg-green-100 text-green-700"></div>
        <div id="alertError" class="hidden mb-4 p-3 rounded bg-red-100 text-red-700"></div>

        <!-- Job Post Form -->
        <form id="jobPostForm">
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Job Title</label>
                <input type="text" name="title" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Company</label>
                <input type="text" name="company" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Location</label>
                <input type="text" name="location" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Salary (in USD)</label>
                <input type="number" step="0.01" name="salary" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Description</label>
                <textarea name="description" rows="5" class="w-full border border-gray-300 p-2 rounded" required></textarea>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded">
                Submit Job Post
            </button>
        </form>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            }
        });

        $('#jobPostForm').on('submit', function (e) {
            e.preventDefault();

            $('#alertSuccess').hide();
            $('#alertError').hide();

            const formData = $(this).serialize();

            $.ajax({
                url: '/api/jobs',
                type: 'POST',
                data: formData,
                success: function (response) {
                    $('#alertSuccess').text("Job posted successfully!").show();
                    $('#jobPostForm')[0].reset();
                },
                error: function (xhr) {
                    console.error('Error loading jobs:', xhr.responseText);
                    let errorText = "Something went wrong.";
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        errorText = Object.values(xhr.responseJSON.errors).join(" ");
                    }
                    $('#alertError').text(errorText).show();
                }
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\wamp64\www\job-board\resources\views/jobpost_page.blade.php ENDPATH**/ ?>