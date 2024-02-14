<x-app-layout>
    <style>
        /* Add these styles to your external CSS file or within a <style> tag in your HTML */

        /* Style for DataTables container */
        #postTable_wrapper {
            margin-top: 20px; /* Add some top margin to the DataTables container */
        }

        /* Style for DataTables pagination */
        .dataTables_paginate {
            display: flex;
            justify-content: space-between; /* Align next and previous buttons at each end */
            align-items: center; /* Center vertically */
        }

        /* Style for DataTables next and previous buttons */
        .dataTables_paginate a {
            padding: 8px 16px; /* Add padding to buttons */
            margin: 0 5px; /* Add some margin for spacing */
            background-color: blue; /* Set the background color to blue */
            color: white; /* Set text color to white */
            border-radius: 4px; /* Add rounded corners */
            text-decoration: none; /* Remove underline from the links */
        }

        /* Hover effect for buttons */
        .dataTables_paginate a:hover {
            background-color: darkblue; /* Darker shade on hover */
        }
    </style>

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        <h2 style="font-size: 1.5em; margin-bottom: 10px;">{{ __('Posts') }}</h2>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <table id="postTable" class="text-black">
        <thead class="table-header">
            <th>SN</th>
            <th>Title</th>
            <th>Description</th>
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
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>

<!-- Include external styles and scripts -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#postTable').DataTable({
            "dom": '<"top"lf>t<"bottom"ip>',
            "paging": true,
            "lengthMenu": [5, 10, 25],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/<LANGUAGE>.json"
            }
        });

        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Saved",
            showConfirmButton: false,
            timer: 1500
        });
    });
</script>
