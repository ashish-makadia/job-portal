// resources/views/emails/job_posted.blade.php

<!DOCTYPE html>
<html>
<head>
    <title>Job Posted</title>
</head>
<body>
    <h2>Your job "{{ $job->title }}" has been posted!</h2>
    <p>Company: {{ $job->company }}</p>
    <p>Location: {{ $job->location }}</p>
    <p>Description: {{ $job->description }}</p>
    <p>Status: {{ $job->status }}</p>
    <p>Thank you for using our job portal.</p>
</body>
</html>