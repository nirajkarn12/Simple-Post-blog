<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog</title>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <x-app-layout>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Posts') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="container" style="padding: 30px; ">
            <input type="text" id="success" value="{{ session('success')}}" readonly hidden>
            <input type="text" id="error" value="{{ session('error')}}" readonly hidden>
            <a href="{{ route('post.create') }}" class="btn btn-primary mb-4">Create Post</a>

            <table id="postTable" class="table table-striped" style="width:100%">
                <thead>
                    <th>SN</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @php
                    $serialNumber = 1;
                    @endphp
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $serialNumber++ }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->description }}</td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <!-- Edit Button -->
                                <div style="background-color: #3498db; padding: 6px; border-radius: 4px; height: 40px;">
                                    <button type="button" onclick="window.location='{{ route('post.edit',['postid' => $post->id]) }}'" class="btn btn-primary mb-4" style="color: #fff; padding: 1px; border-radius: 4px; width: 70px;">Edit</button>
                                </div>

                                <!-- Delete Button -->
                                <form action="{{ route('post.destroy',['postid' => $post->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mb-4" style="background-color: #900c0c; padding: 6px; border-radius: 4px; color: #fff; width: 70px;">Delete</button>
                                </form>

                                <!-- Comment Button -->
                                <div style="background-color: #900c0c; padding: 6px; border-radius: 4px; height: 40px;">
                                    <button type="button" onclick="window.location='{{ route('post.comment',['postid' => $post->id]) }}'" class="btn btn-danger mb-4" style="color: #fff; padding: 1px; border-radius: 4px; width: 70px;">Comment</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-app-layout>

    <script>
        $(document).ready(function() {
            // Initialize DataTable with search bar
            var table = new DataTable('#postTable', {
                "dom": '<"top"lf>rt<"bottom"ip><"clear">', // Adding search bar to the top
            });

            // Show success/error messages using SweetAlert
            if ($('#success').val() != '') {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: $('#success').val(),
                    showConfirmButton: false,
                    timer: 1500
                });
            }

            if ($('#error').val() != '') {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: $('#error').val(),
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    </script>
</body>
</html>