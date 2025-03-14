<?php
include '../config.php';
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);


?>
<?php include '../includes/header.php' ?>
<div class="container mt-4">
    <h2 class="mb-4">Daftar Customers</h2>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama customer</th>
                <th scope="col">Email</th>
            
            </tr>
        </thead>
        <tbody>
            <?php $no =1; while  ($row = mysqli_fetch_assoc($result)  ) : ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    
                </tr>

            <?php endwhile ?>
          

        </tbody>
    </table>

</div>

<?php include '../includes/footer.php' ?>