

<div class="container">
    <h1 class="text-center">Add User</h1>
    <hr>

    <form class="w-75" method="POST" action="/admin/users/store">
        <div class="mb-3">
            <label for="usersUsername" class="form-label">Username:</label>
            <input type="text" name="username" class="form-control" id="usersUsername">
        </div>
        <div class="mb-3">
            <label for="usersEmail" class="form-label">Email:</label>
            <input type="text" name="email" class="form-control" id="usersEmail">
        </div>
        <div class="mb-3">
            <label for="usersPassword" class="form-label">Password:</label>
            <input type="password" name="password" class="form-control" id="usersPassword">
        </div>
        <div class="mb-3">
            <label for="usersDisplayName" class="form-label">Display Name:</label>
            <input type="text" name="display_name" class="form-control" id="usersDisplayName">
        </div>
        <div class="mb-3">
            <label for="roles" class="form-label">Roles:</label>
            <select class="form-select" aria-label="Default select example" name="roles">
                <option >Open this select menu</option>
                <option value="admin">Admin</option>
                <option value="Seller">Seller</option>
                <option value="Procurement">Procurement</option>
                <option value="Accountant">Accountant</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <a href="/admin/users" class="btn btn-danger my-3">Cancel</a>

</div>
<?php
	include('resources/views/partials/footer-admin.php');
?>