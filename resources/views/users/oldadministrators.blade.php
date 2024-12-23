<!-- Modal Template -->

<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="updateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateUserModalLabel">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateUserForm">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <input type="text" id="user_id" name="user_id" value="">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>









$(document).on('click', '.deleteUser', function() {
                const userId = $(this).val();

                    $.ajax({
                        url: `/admin/user/${userId}`, // Make sure this matches your route,
                        type: 'GET',
                        success: function(response) {
                            if (response.status === 200) {
                                // Populate the modal fields with user data
                                $('#userId').val(userId);
                                // Show the modal
                                $('#deleteUserModal').modal('show');
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function() {
                            alert('Failed to fetch user data.');
                        }
                    });
            });





            
        $('#deleteUserForm').on('submit', function(e) {
            e.preventDefault();

            const userId = $('#userId').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: `admin/delete/user/${userId}`,
                type: 'PUT',
                
                success: function(response) {
                    if (response.status === 200) {
                        //alert('User updated successfully.');


                        // Hide the modal
                        $('#deleteUserModal').modal('hide');
                        displaySuccessMessage('User Deleted Successfully');

                        // Refresh the user table
                        fetchUsers();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Failed to update user.');
                }
            });
        });



        
<div class="modal fade" id="deleteUserModal2" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Are you sure you want to delete this user ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deleteUserForm">
                    <input type="text" id="userId" hidden="true">
                   
                    
                    <button type="submit" class="btn btn-primary">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>