<!DOCTYPE html>

<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Starter</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?=assets('plugins/fontawesome-free/css/all.min.css')?>">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?=assets('css/adminlte.min.css')?>">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">


        <?=$data["navbar"]?>

        <?=$data["sidebar"]?>




        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Projeler</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Projeler</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
             

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Proje</th>
                                        <th>Müşteri</th>
                                        <th>Durum</th>
                                        <th>İlerleyiş</th>
                                        <th style="width: 40px">Eylem</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach($data['projects'] as $project){
                                          ?>

                                    <tr id="<?=$project->id?>">
                                        <td><?=$project->title?></td>
                                        <td><a href="<?=requestLink("customer/".$project->customer_id)?>"><?=$project->customer_name." ".$project->customer_surname?></a></td>
                                        <td><?=$project->status=="a" ? "Aktif" : "Pasif"?></td>
                                      
                                        <td>
                                            <?=$project->progress?> %
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-danger" style="width: <?=$project->progress?>%">
                                                </div>
                                            </div>
                                            <br>

                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button onclick="removeproject(<?=$project->id?>)"
                                                    class="btn btn-sm btn-danger">Sil</button>
                                                <a href="<?=requestLink('project/update/'.$project->id)?>"
                                                    class="btn btn-sm btn-info">Güncelle</a>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php } ?>



                        </tr>
                        </tbody>
                        </table>
                    </div>


                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
        reserved.
    </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?=assets('plugins/jquery/jquery.min.js')?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=assets('plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <!-- AdminLTE App -->
    <script src="<?=assets('js/adminlte.min.js')?>"></script>
    <script src="<?=assets("plugins/sweetalert2/sweetalert2.all.min.js")?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.6/axios.min.js"
        integrity="sha512-RUkwGPgBmjCwqXpCRzpPPmGl0LSFp9v5wXtmG41+OS8vnmXybQX5qiG5adrIhtO03irWCXl+z0Jrst6qeaLDtQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
    function removeproject(id) {

        Swal.fire({
            title: 'Silmek istediğinize emin misiniz?',
            text: "Bu işlemi geri alamazsınız.",
            icon: 'warning',
            showCancelButton: true,
            reverseButtons:true,
            confirmButtonColor: ' #d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sil!',
            cancelButtonText:'Vazgeç',
        }).then((result) => {
            if (result.isConfirmed) {

                let formData = new FormData();
                formData.append("project_id",id);

                axios.post('<?=requestLink('project/delete')?>',formData)
                .then(res=>{

                    if(res.data.status=="success"){
                        Swal.fire(res.data.title,res.data.msg,res.data.status)
                        .then(()=>{
                           document.getElementById(id).remove();
                        })
                    }
                    else{
                        Swal.fire(res.data.title,res.data.msg,res.data.status);
                    }
                   
                })
                .catch(error=>{
                    console.log(error);
                })
            }
        })
    }
    </script>
</body>

</html>