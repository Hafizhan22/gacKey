<?php
$stt = $_GET["stt"];
?>

<?php
if ($stt == "") {
    ?>
    <div class="card mt-5">
        <div class="card-body">
            <a href="media.php?module=keydata&stt=tambah" class="menu"><button type="button"
                    class="btn btn-primary mb-3">Tambah Data</button></a>
            <a href="media.php?module=keydata&stt=cari" class="menu"><button type="button" class="btn btn-warning mb-3">Cari
                    Data</button></a>
            <div class="table-responsive">
                <table class="table text-center">
                    <thead class="text-uppercase bg-primary">
                        <tr class="text-white">
                            <th scope="col">no</th>
                            <th scope="col">RFID</th>
                            <th scope="col">Type Key</th>
                            <th scope="col">Name Key</th>
                            <th scope="col">Room</th>
                            <th scope="col">Quantity </th>
                            <th scope="col">Location Key</th>
                            <th scope="col">Status Key</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM key_data");
                        if (mysqli_num_rows($query) == 0) {
                            echo "
	<tr style='text-align:center'>
  <td colspan='9'>Tidak Ada Data Yang Tersedia</td>
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
                            $q2 = mysqli_query($koneksi, "SELECT * FROM key_data LIMIT $posawal,$batas");
                            $no = $posawal + 1;
                            //--------------------------------------------------------------------------------------------   
                    


                            while ($r = mysqli_fetch_array($q2)): ?>

                                <tr class="odd gradeX">
                                    <td align="center"><?php echo $no . "." ?></td>
                                    <td align="center"><?php echo $r['RFID'] ?></td>
                                    <td align="center"><?php echo $r['type'] ?></td>
                                    <td align="center"><?php echo $r['name'] ?></td>
                                    <td align="center"><?php echo $r['room'] ?></td>
                                    <td align="center"><?php echo $r['quantity'] ?></td>
                                    <td align="center"><?php echo $r['location'] ?></td>
                                    <td align="center"><?php echo $r['status'] ?></td>
                                    <td align="center">
                                        <a href="<?php echo "$_SERVER[PHP_SELF]?module=keydata&stt=edit&id=" . $r['RFID'] ?>"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="<?php echo "$_SERVER[PHP_SELF]?module=keydata&stt=hapus&id=" . $r['RFID'] ?>"
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
                    echo "<li class=prevnext><a href='$_SERVER[PHP_SELF]?module=keydata&page=$prev'><i class='fa fa-chevron-left'></i></a></li> ";
                } else {
                    echo "<li class='page-item disabled'><i class='fa fa-chevron-left'></i></li> ";
                }

                // status_galerikan link page 1,2,3 ...
                for ($i = 1; $i <= $jmlhal; $i++)
                    if ($i != $page) {
                        echo "<li><a href='$_SERVER[PHP_SELF]?module=keydata&page=$i'>$i</a></li> ";
                    } else {
                        echo " <li class='active'>$i</li> ";
                    }

                // Link kepage berikutnya (Next)
                if ($page < $jmlhal) {
                    $next = $page + 1;
                    echo "<li class=prevnext><a href='?module=keydata&page=$next'><i class='fa fa-chevron-right'></i></a></li>";
                } else {
                    echo "<li class='page-item disabled'><i class='fa fa-chevron-right'></i></li>";
                }
                echo "</ul></div>";
            } //if jmldata
            else {
                //$s2 = mysqli_query($query);
                $jmldata = mysqli_num_rows($query);
            }


            echo "<br>Jumlah : $jmldata key data";
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
                        <h4>Form Input Key</h4>
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
                                        <input class="form-control" placeholder="Use Reader RFID" type="text" name="RFID"
                                            id="RFID" />
                                        <button type="button" class="btn btn-primary mb-3" id="buttonRFID"
                                            onclick="buttonRfid()">Turn on RFID</button>
                                    </div>

                                    <div class="form-group">
                                        <label>Type Key</label>
                                        <input class="form-control" value="Main" required type="text" name="type" readOnly />
                                    </div>

                                    <div class="form-group">
                                        <label>Name Key</label>
                                        <input class="form-control" required type="text" name="name" />
                                    </div>

                                    <div class="form-group">
                                        <label>Room</label>
                                        <input class="form-control" required type="text" name="room" />
                                    </div>

                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input class="form-control" required type="number" name="quantity" />
                                    </div>

                                    <div class="form-group">
                                        <label>Location Key</label>
                                        <input class="form-control" required type="text" name="location" />
                                    </div>

                                    <div class="form-group">
                                        <label>Status Key</label>
                                        <input class="form-control" value="Available" required type="text" name="status"
                                            readOnly />
                                    </div>


                                    <button type="submit" class="btn btn-primary mb-3" name="Simpan">Save</button>
                                    <button type="reset" class="btn btn-primary mb-3">Cancel</button>
                                    <a href="media.php?module=keydata"><button type="button"
                                            class="btn btn-primary mb-3">Kembali</button></a>
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
            $type = $_POST['type'];
            $name = $_POST['name'];
            $room = $_POST['room'];
            $quantity = $_POST['quantity'];
            $location = $_POST['location'];
            $status = $_POST['status'];


            $querytambah = mysqli_query($koneksi, "INSERT INTO key_data VALUES('$RFID', '$type', '$name', '$room', '$quantity', '$location', '$status')");
            if ($querytambah) {
                // header('location: menu.php');   
                echo "<script>alert('Complete');location.href='$_SERVER[PHP_SELF]?module=keydata';</script>";
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
        $id = $_GET['id'];
        $queryhapus = mysqli_query($koneksi, "DELETE FROM key_data WHERE `RFID` ='$id'");

        if ($queryhapus) {
            # header('location: menu.php');
            echo "<script>alert('Complete delete $id');location.href='$_SERVER[PHP_SELF]?module=keydata';</script>";
        } else {
            # echo "Upss Something wrong..";
            echo "<script>alert('BAD REQUEST');location.href='$_SERVER[PHP_SELF]?module=keydata';</script>";
        }

        ?>


<?php } else if ($stt == "edit") {
    ?>

        <?php
        $RFID = $_GET["id"];
        $query = mysqli_query($koneksi, "SELECT * FROM account where RFID='$RFID'");
        $d = mysqli_fetch_array($query);
        $RFIDB = $d['RFID'];
        $type = $d['type'];
        $name = $d['name'];
        $room = $d['room'];
        $quantity = $d['quantity'];
        $location = $d['location'];
        $status = $d['status'];
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
                                                    <label>Type Key</label>
                                                    <input class="form-control" required type="text" name="type"
                                                        value="<?php echo $type; ?>" />
                                                </div>

                                                <div class="form-group">
                                                    <label>Name Key</label>
                                                    <input class="form-control" required type="text" name="name"
                                                        value="<?php echo $name; ?>" />
                                                </div>

                                                <div class="form-group">
                                                    <label>Room</label>
                                                    <input class="form-control" required type="text" name="room"
                                                        value="<?php echo $room; ?>" />
                                                </div>

                                                <div class="form-group">
                                                    <label>Quantity</label>
                                                    <input class="form-control" required type="number" name="quantity"
                                                        value="<?php echo $quality; ?>" />
                                                </div>

                                                <div class="form-group">
                                                    <label>Location Key</label>
                                                    <input class="form-control" required type="text" name="location"
                                                        value="<?php echo $location; ?>" />
                                                </div>

                                                <div class="form-group">
                                                    <label>Status Key</label>
                                                    <input class="form-control" required type="text" name="status"
                                                        value="<?php echo $status; ?>" />
                                                </div>

                                                <button type="submit" class="btn btn-primary mb-3" name="Update">Save</button>
                                                <a href="<?php echo "$_SERVER[PHP_SELF]?module=keydata"; ?>"><button type="button"
                                                        class="btn btn-primary mb-3">Cancel</button></a>
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
            $type = $_POST['type'];
            $name = $_POST['name'];
            $room = $_POST['room'];
            $quantity = $_POST['quantity'];
            $location = $_POST['location'];
            $status = $_POST['status'];

            $queryupdate = mysqli_query($koneksi, "UPDATE key_data SET 
                           RFID='$RFIDB',
                           type='$type',
                           name='$name',
						   room='$room',
						   quantity='$quantity',
						   location='$location',
						   status='$status',
						   WHERE RFID = '$RFID'");
            if ($queryupdate) {
                // header('location: menu.php');
    
                echo "<script>alert('Complete update $RFIDB');location.href='$_SERVER[PHP_SELF]?module=keydata';</script>";
            } else {
                echo "<script>alert('BAD REQUEST');location.href='$_SERVER[PHP_SELF]?module=keydata';</script>";
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
                                        <h4>Serch KEY</h4>
                                        <hr>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form role="form" name="form1" method="post" action="" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label>Serch by</label>
                                                        <select class="form-control" name="listcari">
                                                            <option value="">CHOOSE</option>
                                                            <option value="type">key type</option>
                                                            <option value="name">key name</option>
                                                            <option value="room">Room</option>
                                                            <option value="status">status</option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Input here</label>
                                                        <input class="form-control" type="text" name="txtcari" required />
                                                    </div>
                                                    <button type="submit" class="btn btn-default" name="Cari">Cari</button>
                                                    <a href="<?php echo "$_SERVER[PHP_SELF]?module=keydata"; ?>"><button type="button"
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
                                                                <th scope="col">no</th>
                                                                <th scope="col">RFID</th>
                                                                <th scope="col">Type Key</th>
                                                                <th scope="col">Name Key</th>
                                                                <th scope="col">Room</th>
                                                                <th scope="col">Quantity </th>
                                                                <th scope="col">Location Key</th>
                                                                <th scope="col">Status Key</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>



                                                <?php
                                                $query = mysqli_query($koneksi, "SELECT * FROM key_data WHERE `$listcari` like '%$txtcari%' order by `RFID` asc");
                                                if (mysqli_num_rows($query) == 0) {
                                                    echo "
	<tr style='text-align:center'>
  <td colspan='9'>Tidak Ada Data Yang Tersedia</td>
 </tr>
	
	
";
                                                } else {

                                                    $no = 1;
                                                    while ($r = mysqli_fetch_array($query)): ?>

                                                                    <tr class="odd gradeX">
                                                                        <td align="center"><?php echo $no . "." ?></td>
                                                                        <td align="center"><?php echo $r['RFID'] ?></td>
                                                                        <td align="center"><?php echo $r['type'] ?></td>
                                                                        <td align="center"><?php echo $r['name'] ?></td>
                                                                        <td align="center"><?php echo $r['room'] ?></td>
                                                                        <td align="center"><?php echo $r['quantity'] ?></td>
                                                                        <td align="center"><?php echo $r['location'] ?></td>
                                                                        <td align="center"><?php echo $r['status'] ?></td>
                                                                        <td align="center">
                                                                            <a
                                                                                href="<?php echo "$_SERVER[PHP_SELF]?module=keydata&stt=edit&id=" . $r['RFID'] ?>"><i
                                                                                    class="fa fa-edit"></i></a>
                                                                            <a href="<?php echo "$_SERVER[PHP_SELF]?module=keydata&stt=hapus&id=" . $r['RFID'] ?>"
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