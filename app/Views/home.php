<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>CRUD CI4</title>
</head>

<body>
    <div class="container">
        <button class="btn btn-primary mt-3" onclick="window.location.href='<?php echo base_url(); ?>/add'">Add Student</button>
        <?php
        session()->get('add');
        if (session()->get('add')){
            echo '<script language="javascript">';
            echo 'alert("Succesfully Added!")';
            echo '</script>';
        }elseif(session()->get('update')){
            echo '<script language="javascript">';
            echo 'alert("Succesfully Updated!")';
            echo '</script>';
        }
        ?>

        <div class="card mt-3">
            <div class="card-body">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $s) : ?>
    
                            <tr>
                                <td><?= $s['id'] ?></td>
                                <td><?= $s['first_name'] ?></td>
                                <td><?= $s['last_name'] ?></td>
                                <td><?= $s['address'] ?></td>
                                <td><?= $s['email'] ?></td>
                                <td><?= $s['mobile'] ?></td>
                                <td class="">
                                    <button class="btn btn-primary" onclick="window.location.href='<?php echo base_url(); ?>/edit/<?= $s['id'] ?>'">Edit</button>
                                    <button class="btn btn-danger" id="delete" data-id="<?= $s['id'] ?>" onclick="">Delete</button>
                                </td>
    
                            </tr>
    
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        $('#delete').on('click', function() {
            let id= $(this).data("id");

            $.ajax({
                url:"/deleteStudent/",
                method:"post", 
                data: {id:id},
                success:function(result){
                    result = JSON.parse(result)
                    alert(result);

                    
                }
            })
        })

    </script>

</body>

</html>