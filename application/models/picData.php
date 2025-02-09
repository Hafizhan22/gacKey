<?php
$stt = $_GET["stt"];
?>

<?php
if ($stt == "") {
    ?>
    <div class="card mt-5">
        <div class="card-body">
            <a href="media.php?module=pic_data&stt=tambah" class="menu"><button type="button"
                    class="btn btn-primary mb-3">Tambah Data</button></a>
            <a href="media.php?module=pic_data&stt=cari" class="menu"><button type="button" class="btn btn-warning mb-3">Cari
                    Data</button></a>
            <div class="table-responsive">
                <table class="table text-center">
                    <thead class="text-uppercase bg-primary">
                        <tr class="text-white">
                            <th scope="col">No</th>
                            <th scope="col">RFID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Initial</th>
                            <th scope="col">team</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM pic_data");
                        if (mysqli_num_rows($query) == 0) {
                            echo "
	<tr style='text-align:center'>
  <td colspan='5'>Tidak Ada Data Yang Tersedia</td>
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
                            $q2 = mysqli_query($koneksi, "SELECT * FROM pic_data LIMIT $posawal,$batas");
                            $no = $posawal + 1;
                            //--------------------------------------------------------------------------------------------   
                    


                            while ($r = mysqli_fetch_array($q2)): ?>

                                <tr class="odd gradeX">
                                    <td align="center"><?php echo $no . "." ?></td>
                                    <td align="center"><?php echo $r['RFID'] ?></td>
                                    <td align="center"><?php echo $r['name'] ?></td>
                                    <td align="center"><?php echo $r['initial'] ?></td>
                                    <td align="center"><?php echo $r['team'] ?></td>
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
                    echo "<li class=prevnext><a href='$_SERVER[PHP_SELF]?module=pic_data&page=$prev'><i class='fa fa-chevron-left'></i></a></li> ";
                } else {
                    echo "<li class='page-item disabled'><i class='fa fa-chevron-left'></i></li> ";
                }

                // status_galerikan link page 1,2,3 ...
                for ($i = 1; $i <= $jmlhal; $i++)
                    if ($i != $page) {
                        echo "<li><a href='$_SERVER[PHP_SELF]?module=pic_data&page=$i'>$i</a></li> ";
                    } else {
                        echo " <li class='active'>$i</li> ";
                    }

                // Link kepage berikutnya (Next)
                if ($page < $jmlhal) {
                    $next = $page + 1;
                    echo "<li class=prevnext><a href='?module=pic_data&page=$next'><i class='fa fa-chevron-right'></i></a></li>";
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
                        <h4>Form Create pic_data</h4>
                    </div>
                    <hr>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">

                                <form role="form" name="form1" method="post" action="" enctype="multipart/form-data">
                                <script type="text/javascript">
                                        let isKeyboardDisabled = true;

                                        function buttonRfid() {
                                            const rfidInput = document.getElementById('RFID');

                                            if (isKeyboardDisabled) {
                                                rfidInput.onkeydown = function (e) {
                                                    if (e.key === 'Enter') {
                                                        dissRfid();
                                                    }
                                                    return true;
                                                }
                                                isKeyboardDisabled = false;
                                                document.getElementById('buttonRFID').innerText = 'Turn off RFID';
                                                rfidInput.readOnly = false;
                                                rfidInput.value = ''; // Mengosongkan nilai form RFID
                                                rfidInput.focus();
                                            } else {
                                                dissRfid();
                                            }
                                        }

                                        function dissRfid() {
                                            const rfidInput = document.getElementById('RFID');
                                            rfidInput.onkeydown = function (e) {
                                                return false;
                                            }
                                            isKeyboardDisabled = true;
                                            document.getElementById('buttonRFID').innerText = 'Turn on RFID';
                                            rfidInput.readOnly = true;
                                        }

                                        window.onload = function () {
                                            dissRfid(); // Disable keyboard input on load
                                        }

                                    </script>
                                    <div class="form-group">
                                        <label>RFID</label>
                                        <input class="form-control" placeholder="Use Reader RFID" type="text" name="RFID" id="RFID"/>
                                        <button type="button" class="btn btn-primary mb-3" id="buttonRFID"
                                        onclick="buttonRfid()">Turn on RFID</button>
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
                                        <label>team</label>
                                        <input class="form-control" required type="team" name="team" id="team" />
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-3" name="Simpan">Save</button>
                                    <button type="reset" class="btn btn-primary mb-3">Cancel</button>
                                    <a href="media.php?module=pic_data"><button type="button"
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
            $RFID = $_POST['RFID'];
            $name = $_POST['name'];
            $initial = $_POST['initial'];
            $team = $_POST['team'];
            $querytambah = mysqli_query($koneksi, "INSERT INTO pic_data VALUES('$RFID', '$name', '$initial', '$team')");
            if ($querytambah) {
                // header('location: menu.php');   
                echo "<script>alert('Complete');location.href='$_SERVER[PHP_SELF]?module=pic_data';</script>";
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
        $RFID = $_GET['id'];
        $queryhapus = mysqli_query($koneksi, "DELETE FROM pic_data WHERE `RFID` ='$RFID'");

        if ($queryhapus) {
            # header('location: menu.php');
            echo "<script>alert('Complete delete $RFID');location.href='$_SERVER[PHP_SELF]?module=pic_data';</script>";
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
        $RFID = $_GET["id"];
        $query = mysqli_query($koneksi, "SELECT * FROM pic_data where RFID='$RFID'");
        $d = mysqli_fetch_array($query);
        $RFIDB = $d["RFID"];
        $name = $d["name"];
        $initial = $d["initial"];
        $team = $d["team"];

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
                                                    <label>RFID</label>
                                                    <input class="form-control" placeholder="Use Reader RFID" type="text" name="RFID"
                                                        value="<?php echo $RFIDB; ?>" />
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
                                                    <label>team</label>
                                                    <input class="form-control" required type="team" name="team"
                                                        value="<?php echo $team; ?>" />
                                                </div>


                                                <button type="submit" class="btn btn-primary mb-3" name="Update">Save</button>
                                                
                                                <a href="<?php echo "$_SERVER[PHP_SELF]?module=pic_data"; ?>"><button type="button"
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
            $RFIDB = $_POST['RFID'];
            $name = $_POST['name'];
            $initial = $_POST['initial'];
            # $team=md5($_POST['team']);
            $team = $_POST['team'];


            if ($_FILES["gambar"] != "") {
                @copy($_FILES["gambar"]["tmp_name"], "application/gambar/" . $_FILES["gambar"]["name"]);
                $image = $_FILES["gambar"]["name"];
            } else {
                $image = $image0;
            }
            if (strlen($image) < 1) {
                $image = $image0;
            }


            $queryupdate = mysqli_query($koneksi, "UPDATE pic_data SET 
                           RFID='$RFIDB',
                           name='$name',
						   initial='$initial',
						   team='$team'
						   WHERE RFID = '$RFID'");
            if ($queryupdate) {
                // header('location: menu.php');
    
                echo "<script>alert('Complete update $RFIDB');location.href='$_SERVER[PHP_SELF]?module=pic_data';</script>";
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
                                        <h4>Serch pic_data</h4>
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
                                                            <option value="RFID">RFID</option>
                                                            <option value="name">Name</option>
                                                            <option value="initial">Initial</option>
                                                            <option value="team">Team</option>


                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Input here</label>
                                                        <input class="form-control" type="text" name="txtcari" required />
                                                    </div>
                                                    <button type="submit" class="btn btn-default" name="Cari">Cari</button>
                                                    <a href="<?php echo "$_SERVER[PHP_SELF]?module=pic_data"; ?>"><button type="button"
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
                                                                <th scope="col">RFID</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Initial</th>
                                                                <th scope="col">team</th>
                                                                <th scope="col">Role</th>
                                                                <th scope="col">Image</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>



                                                <?php
                                                $query = mysqli_query($koneksi, "SELECT * FROM pic_data WHERE `$listcari` like '%$txtcari%' order by `RFID` asc");
                                                if (mysqli_num_rows($query) == 0) {
                                                    echo "
	<tr style='text-align:center'>
  <td colspan='5'>Tidak Ada Data Yang Tersedia</td>
 </tr>
	
	
";
                                                } else {

                                                    $no = 1;
                                                    while ($r = mysqli_fetch_array($query)): ?>

                                                                    <tr class="odd gradeX">
                                                                        <td align="center"><?php echo $no . "." ?></td>
                                                                        <td align="center"><?php echo $r['RFID'] ?></td>
                                                                        <td align="center"><?php echo $r['name'] ?></td>
                                                                        <td align="center"><?php echo $r['initial'] ?></td>
                                                                        <td align="center"><?php echo $r['team'] ?></td>
                                                                            <a
                                                                                href="<?php echo "$_SERVER[PHP_SELF]?module=pic_data&stt=edit&id=" . $r['RFID'] ?>"><i
                                                                                    class="fa fa-edit"></i></a>
                                                                            <a href="<?php echo "$_SERVER[PHP_SELF]?module=pic_data&stt=hapus&id=" . $r['RFID'] ?>"
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