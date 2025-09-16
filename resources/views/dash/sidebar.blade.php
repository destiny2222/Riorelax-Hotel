<form id="avatar-upload-form" enctype="multipart/form-data" action="{{ route('dashboard.profile-picture-change', Auth::user()->id) }}">
    @csrf
    @method('PUT')
    <div class="avatar-upload-container">
        <div class="form-group mb-3">
            <div id="account-avatar">
                <div class="profile-image custom-avatar-master">
                    <div class="avatar-view mt-card-avatar">
                        <img class="br2" src="{{ asset('images/profile/'.Auth::user()->profile_image) }}" alt="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                    </div>
                    <i class="fa fa-pencil avatar-view" id="edit-avatar"></i>
                </div>
            </div>
        </div>
        <input type="file" name="profile_image" id="profile_image" hidden accept="image/*">
    </div>
</form>

<div class="text-center">
    <div class="profile-usertitle-name">
        <strong>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</strong>
    </div>
</div>
<div class="profile-user menu">
    <ul class="list-group">
        <li class="list-group-item">
            <a href="{{ route('dashboard.home') }}" class="d-inline-block w-100 collection-item active ">Overview</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('dashboard.profile') }}" class="d-inline-block w-100 collection-item ">Profile</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('dashboard.change.password') }}" class="d-inline-block w-100 collection-item ">Change password</a>
        </li>
        <li class="list-group-item">
            <a href="" class="d-inline-block w-100 collection-item ">My Bookings</a>
        </li>
        <li class="list-group-item">
            <a href="" class="d-inline-block w-100 collection-item ">My Reviews</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="d-inline-block w-100 collection-item">Logout</a>
        </li>
        <form action="{{ route('logout') }}" id="logout-form" class="d-none" method="get">
            @csrf
        </form>
    </ul>
</div>
<script>
    document.getElementById('edit-avatar').addEventListener('click', function() {
        document.getElementById('profile_image').click();
    });

    document.getElementById('profile_image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            // Show preview immediately
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('#account-avatar img').src = e.target.result;
            };
            reader.readAsDataURL(file);

            // Upload with AJAX
            let formData = new FormData(document.getElementById('avatar-upload-form'));
            formData.append('_method', 'PUT');

            // Get CSRF token correctly
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                            document.querySelector('input[name="_token"]')?.value;

            fetch(document.getElementById('avatar-upload-form').action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // console.log('Profile updated successfully');
                    swal('Profile updated successfully', '', 'success');
                    // Update the image src to the new uploaded image
                    document.querySelector('#account-avatar img').src = data.profile_image;
                } else {
                    console.error('Upload failed', data.message);
                    alert('Upload failed: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error uploading file:', error);
                alert('Error uploading file. Please try again.');
            });
        }
    });
</script>
