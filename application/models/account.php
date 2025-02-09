<?php
$stt = $_GET["stt"];
?>

<?php
if ($stt == "") {
    ?>
    <div class="card mt-5">
        <div class="card-body">
            <a href="media.php?module=account&stt=tambah" class="menu"><button type="button"
                    class="btn btn-primary mb-3">Tambah Data</button></a>
            <a href="media.php?module=account&stt=cari" class="menu"><button type="button" class="btn btn-warning mb-3">Cari
                    Data</button></a>
            <div class="table-responsive">
                <table class="table text-center">
                    <thead class="text-uppercase bg-primary">
                        <tr class="text-white">
                            <th scope="col">No</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Name</th>
                            <th scope="col">Initial</th>
                            <th scope="col">Password</th>
                            <th scope="col">Role</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM account");
                        if (mysqli_num_rows($query) == 0) {
                            echo "
	<tr style='text-align:center'>
  <td colspan='8'>Tidak Ada Data Yang Tersedia</td>
 </tr>
	
	
";
                        } else {

                            //--------------------------------------------------------------------------------------------
                            $batas = 10;
                            $page = $_GET['page'];
                            if (empty($page)) {
                                $posawal = 0;
                                $page = 1;
                            } else {
                                $posawal = ($page - 1) * $batas;
                            }

                            //$s2 = $query." LIMIT $posawal,$batas";
                            $q2 = mysqli_query($koneksi, "SELECT * FROM account LIMIT $posawal,$batas");
                            $no = $posawal + 1;
                            //--------------------------------------------------------------------------------------------   
                    


                            while ($r = mysqli_fetch_array($q2)): ?>

                                <tr class="odd gradeX">
                                    <td align="center"><?php echo $no . "." ?></td>
                                    <td align="center"><?php echo $r['NIP'] ?></td>
                                    <td align="center"><?php echo $r['name'] ?></td>
                                    <td align="center"><?php echo $r['initial'] ?></td>
                                    <td align="center"><?php echo $r['password'] ?></td>
                                    <td align="center"><?php echo $r['role'] ?></td>
                                    <td align="center"><img src="<?php echo "application/gambar/" . $r['image']; ?>"
                                            class="avatar user-thumb" alt="avatar" width='36' height='36' /></td>
                                    <td align="center">
                                        <a href="<?php echo "$_SERVER[PHP_SELF]?module=account&stt=edit&id=" . $r['NIP'] ?>"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="<?php echo "$_SERVER[PHP_SELF]?module=account&stt=hapus&id=" . $r['NIP'] ?>"
                                            onClick='return confirm("are you sure???")'><i class="ti-trash"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                            endwhile;
                        }
                        ?>

                    </tbody>

                </table>
            </div>


            <?php
            //$s2 = mysqli_query($query);
            $jmldata = mysqli_num_rows($query);
            if ($jmldata > 0) {
                if ($batas < 1) {
                    $batas = 1;
                }
                $jmlhal = ceil($jmldata / $batas);
                echo "<div class='pagination_area pull-right mt-5'><ul>";
                if ($page > 1) {
                    $prev = $page - 1;
                    echo "<li class=prevnext><a href='$_SERVER[PHP_SELF]?module=account&page=$prev'><i class='fa fa-chevron-left'></i></a></li> ";
                } else {
                    echo "<li class='page-item disabled'><i class='fa fa-chevron-left'></i></li> ";
                }

                // status_galerikan link page 1,2,3 ...
                for ($i = 1; $i <= $jmlhal; $i++)
                    if ($i != $page) {
                        echo "<li><a href='$_SERVER[PHP_SELF]?module=account&page=$i'>$i</a></li> ";
                    } else {
                        echo " <li class='active'>$i</li> ";
                    }

                // Link kepage berikutnya (Next)
                if ($page < $jmlhal) {
                    $next = $page + 1;
                    echo "<li class=prevnext><a href='?module=account&page=$next'><i class='fa fa-chevron-right'></i></a></li>";
                } else {
                    echo "<li class='page-item disabled'><i class='fa fa-chevron-right'></i></li>";
                }
                echo "</ul></div>";
            } //if jmldata
            else {
                //$s2 = mysqli_query($query);
                $jmldata = mysqli_num_rows($query);
            }


            echo "<br>Jumlah : $jmldata User";
            ?>

        </div>
    </div>





    <?php
} else if ($stt == "tambah") {
    ?>


        <div class="card mt-5">
            <div class="card-body">

                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Form Create Account</h4>
                    </div>
                    <hr>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">

                                <form role="form" name="form1" method="post" action="" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input class="form-control" placeholder="Input Udomain" type="text" name="NIP" />
                                    </div>

                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control" required type="text" name="name" />
                                    </div>


                                    <div class="form-group">
                                        <label>Initial</label>
                                        <input class="form-control" required type="text" name="initial" />
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" required type="password" name="password" id="password" />
                                        
                                    </div>

                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control" name="role" required>
                                            <option value="">Choose</option>
                                            <option value="Security Operation System">SOC</option>

                                        </select>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary mb-3" name="Simpan">Save</button>
                                    <button type="reset" class="btn btn-primary mb-3">Cancel</button>
                                    <a href="media.php?module=account"><button type="button"
                                            class="btn btn-primary mb-3">Back</button></a>
                                </form>

                            </div>


                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>

        </div>
        </div>


        <?php
        if (isset($_POST['Simpan'])) {
            $NIP = $_POST['NIP'];
            $name = $_POST['name'];
            $initial = $_POST['initial'];
            # $password=md5($_POST['password']);
            $password = $_POST['password'];
            $role = $_POST['role'];
            $image = $_POST['image'];



            // if ($_FILES["image"] != "") {
    
            //     @copy($_FILES["foto"]["tmp_name"], "application/gambar/" . $_FILES["foto"]["name"]);
            //     $foto = $_FILES["foto"]["name"];
            // } else {
    

            //     $foto = "noimages.jpg";
            // }
            // if (strlen($foto) < 1) {
            //     $foto = "noimages.jpg";
            // }
    
            $querytambah = mysqli_query($koneksi, "INSERT INTO account VALUES('$NIP', '$name', '$initial', '$password', '$role', '$image')");
            if ($querytambah) {
                // header('location: menu.php');   
                echo "<script>alert('Complete');location.href='$_SERVER[PHP_SELF]?module=account';</script>";
            } else {
                $error = mysqli_error($koneksi);
                $cleaned_error = str_replace(["'", '"'], '', $error);
                echo "<script>alert('BAD REQUEST $cleaned_error');location.href='$_SERVER[PHP_SELF]?module=keydata';</script>";
            }
        }
        ?>


<?php } else if ($stt == "hapus") {
    ?>

        <?php
        $NIP = $_GET['id'];
        $queryhapus = mysqli_query($koneksi, "DELETE FROM account WHERE `NIP` ='$NIP'");

        if ($queryhapus) {
            # header('location: menu.php');
            echo "<script>alert('Complete delete $NIP');location.href='$_SERVER[PHP_SELF]?module=account';</script>";
        } else {
            # echo "Upss Something wrong..";
            $error = mysqli_error($koneksi);
                $cleaned_error = str_replace(["'", '"'], '', $error);
                echo "<script>alert('BAD REQUEST $cleaned_error');location.href='$_SERVER[PHP_SELF]?module=keydata';</script>";
        }

        ?>


<?php } else if ($stt == "edit") {
    ?>

        <?php
        $NIP = $_GET["id"];
        $query = mysqli_query($koneksi, "SELECT * FROM account where NIP='$NIP'");
        $d = mysqli_fetch_array($query);
        $NIPB = $d["NIP"];
        $name = $d["name"];
        $initial = $d["initial"];
        $password = $d["password"];
        $role = $d["role"];
        $image = $d["image"];
        $image0 = $d["image"];

        ?>

                <div class="card mt-5">
                    <div class="card-body">
                        <div class="col-md-12">
                            <!-- Form Elements -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Form Edit User</h4>
                                    <hr>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <form role="form" name="form1" method="post" action="" enctype="multipart/form-data">

                                                <div class="form-group">
                                                    <label>NIP</label>
                                                    <input class="form-control" placeholder="Input Udomain" type="text" name="NIP"
                                                        value="<?php echo $NIPB; ?>" />
                                                </div>

                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input class="form-control" required type="text" name="name"
                                                        value="<?php echo $name; ?>" />
                                                </div>


                                                <div class=" form-group">
                                                    <label>Initial</label>
                                                    <input class="form-control" required type="text" name="initial"
                                                        value="<?php echo $initial; ?>" />
                                                </div>

                                                <div class=" form-group">
                                                    <label>Password</label>
                                                    <input class="form-control" required type="password" name="password"
                                                        value="<?php echo $password; ?>" />
                                                </div>

                                                <div class=" form-group">
                                                    <label>Image</label>
                                                    <input type="file" name="image" id="image" class="input" />

                                                    <a href="<?php echo "application/gambar/$image"; ?>" title="Click to zoom image "
                                                        target="_blank"><?php echo "<img src='application/gambar/$image' height='100' width='100'>"; ?></a>

                                                </div>



                                                <div class="form-group">
                                                    <label>Role</label>
                                                    <select class="form-control" name="role">
                                                <?php
                                                if ($role == "") {
                                                    echo "<option value=''>-- Choose --</option>";
                                                } else {

                                                    echo "<option value='$role'>$role</option>";
                                                }
                                                ?>

                                                
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary mb-3" name="Update">Save</button>
                                                <input type="hidden" name="image0" value="<?php echo "$image0"; ?>">
                                                
                                                <a href="<?php echo "$_SERVER[PHP_SELF]?module=account"; ?>"><button type="button"
                                                        class="btn btn-primary mb-3">Batal</button></a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Form Elements -->
                        </div>

                    </div>
                </div>




        <?php
        if (isset($_POST['Update'])) {
            $NIPB = $_POST['NIP'];
            $name = $_POST['name'];
            $initial = $_POST['initial'];
            # $password=md5($_POST['password']);
            $password = $_POST['password'];
            $role = $_POST['role'];
            $image = $_POST['image'];
            $image0 = $_POST['image0'];


            if ($_FILES["gambar"] != "") {
                @copy($_FILES["gambar"]["tmp_name"], "application/gambar/" . $_FILES["gambar"]["name"]);
                $image = $_FILES["gambar"]["name"];
            } else {
                $image = $image0;
            }
            if (strlen($image) < 1) {
                $image = $image0;
            }


            $queryupdate = mysqli_query($koneksi, "UPDATE account SET 
                           NIP='$NIPB',
                           name='$name',
						   initial='$initial',
						   password='$password',
						   role='$role',
                           image='$image'
						   WHERE NIP = '$NIP'");
            if ($queryupdate) {
                // header('location: menu.php');
    
                echo "<script>alert('Complete update $NIPB');location.href='$_SERVER[PHP_SELF]?module=account';</script>";
            } else {
                $error = mysqli_error($koneksi);
                $cleaned_error = str_replace(["'", '"'], '', $error);
                echo "<script>alert('BAD REQUEST $cleaned_error');location.href='$_SERVER[PHP_SELF]?module=keydata';</script>";
            }
        }
        ?>



    <?php
} else if ($stt == "cari") {

    ?>
                    <div class="card mt-5">
                        <div class="card-body">
                            <div class="col-md-12">
                                <!-- Form Elements -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>Serch Account</h4>
                                        <hr>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form role="form" name="form1" method="post" action="" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label>Serch by</label>
                                                        <select class="form-control" name="listcari">
                                                            <option value="">Pilih disini</option>
                                                            <option value="NIP">NIP</option>
                                                            <option value="name">Name</option>
                                                            <option value="initial">Initial</option>


                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Input here</label>
                                                        <input class="form-control" type="text" name="txtcari" required />
                                                    </div>
                                                    <button type="submit" class="btn btn-default" name="Cari">Cari</button>
                                                    <a href="<?php echo "$_SERVER[PHP_SELF]?module=account"; ?>"><button type="button"
                                                            class="btn btn-primary">Cancel</button></a>
                                                </form>





                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form Elements -->
                            </div>

                            <hr>
                <?php
                if (isset($_POST['Cari'])) {

                    $listcari = $_POST['listcari'];
                    $txtcari = $_POST['txtcari'];


                    ?>

                                <div class="col-md-12">
                                    <!-- Advanced Tables -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <form action="" method="POST">
                                                    <table class="table text-center">
                                                        <thead class="text-uppercase bg-primary">
                                                            <tr class="text-white">
                                                                <th scope="col">No</th>
                                                                <th scope="col">NIP</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Initial</th>
                                                                <th scope="col">Password</th>
                                                                <th scope="col">Role</th>
                                                                <th scope="col">Image</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>



                                                <?php
                                                $query = mysqli_query($koneksi, "SELECT * FROM account WHERE `$listcari` like '%$txtcari%' order by `NIP` asc");
                                                if (mysqli_num_rows($query) == 0) {
                                                    echo "
	<tr style='text-align:center'>
  <td colspan='8'>Tidak Ada Data Yang Tersedia</td>
 </tr>
	
	
";
                                                } else {

                                                    $no = 1;
                                                    while ($r = mysqli_fetch_array($query)): ?>

                                                                    <tr class="odd gradeX">
                                                                        <td align="center"><?php echo $no . "." ?></td>
                                                                        <td align="center"><?php echo $r['NIP'] ?></td>
                                                                        <td align="center"><?php echo $r['name'] ?></td>
                                                                        <td align="center"><?php echo $r['initial'] ?></td>
                                                                        <td align="center"><?php echo $r['password'] ?></td>
                                                                        <td align="center"><?php echo $r['role'] ?></td>
                                                                        <td align="center"><img src="<?php echo "application/gambar/" . $r['image']; ?>"
                                                                                class="avatar user-thumb" alt="avatar" width='36' height='36' /></td>
                                                                        <td align="center">
                                                                            <a
                                                                                href="<?php echo "$_SERVER[PHP_SELF]?module=account&stt=edit&id=" . $r['NIP'] ?>"><i
                                                                                    class="fa fa-edit"></i></a>
                                                                            <a href="<?php echo "$_SERVER[PHP_SELF]?module=account&stt=hapus&id=" . $r['NIP'] ?>"
                                                                                onClick='return confirm("are you sure???")'><i class="ti-trash"></i></a>
                                                                        </td>
                                                                    </tr>
                                                        <?php
                                                        $no++;
                                                    endwhile;
                                                }
                                                ?>

                                                        </tbody>
                                                    </table>
                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                    <!--End Advanced Tables -->
                                </div>


                            </div>

                        </div>

        <?php




                }

                ?>

    <?php
}
?>