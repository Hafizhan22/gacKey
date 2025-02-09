<?php
$stt = $_GET["stt"];
?>

<?php
if ($stt == "") {
?>
    <div class="card mt-5">
        <div class="card-body">
            <a href="media.php?module=sale&stt=cari" class="menu"><button type="button" class="btn btn-warning mb-3">Cari Data</button></a>
            <div class="table-responsive">
                <table class="table text-center">
                    <thead class="text-uppercase bg-primary">
                        <tr class="text-white">
                            <th scope="col">MERCHANT</th>
                            <th scope="col">IP EDC</th>
                            <th scope="col">TIME</th>
                            <th scope="col">DATE</th>
                            <th scope="col">Startof Text</th>
                            <th scope="col">Message Length</th>
                            <th scope="col">ECR Version</th>
                            <th scope="col">Transaction Type</th>
                            <th scope="col">Transaction Amount</th>
                            <th scope="col">Other Amount</th>
                            <th scope="col">PAN</th>
                            <th scope="col">Expire Date</th>
                            <th scope="col">Cancel Reason</th>
                            <th scope="col">Invoice Number</th>
                            <th scope="col">Auth Code</th>
                            <th scope="col">Installment Flag</th>
                            <th scope="col">Reedem Flag</th>
                            <th scope="col">DCC Flag</th>
                            <th scope="col">Installment Plan</th>
                            <th scope="col">Installment Tenor</th>
                            <th scope="col">Generic Data</th>
                            <th scope="col">Reff Number</th>
                            <th scope="col">Merchant Filler</th>
                            <th scope="col">endOf Text</th>
                            <th scope="col">crc</th>
                            <th scope="col">Response</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM sale");
                        if (mysqli_num_rows($query) == 0) {
                            echo "
	<tr style='text-align:center'>
  <td colspan='13'>Tidak Ada Data Yang Tersedia</td>
 </tr>
	
	
";
                        } else {

                            //--------------------------------------------------------------------------------------------
                            $batas   = 5;
                            $page = $_GET['page'];
                            if (empty($page)) {
                                $posawal  = 0;
                                $page = 1;
                            } else {
                                $posawal = ($page - 1) * $batas;
                            }
                            //$s2 = $query." LIMIT $posawal,$batas";
                            $q2  = mysqli_query($koneksi, "SELECT * FROM sale ORDER BY id DESC LIMIT $posawal,$batas");
                            $no = $posawal + 1;
                            //--------------------------------------------------------------------------------------------   
                            while ($r = mysqli_fetch_array($q2)) :     ?>
                                <tr class="odd gradeX">
                                    <td align="center"><?php echo $r['merchant'] ?></td>
                                    <td align="center"><?php echo $r['ip_edc'] ?></td>
                                    <td align="center"><?php echo $r['time']; ?></td>
                                    <td align="center"><?php echo $r['date']; ?></td>
                                    <td align="center"><?php echo $r['start_of_text']; ?></td>
                                    <td align="center"><?php echo $r['message_length']; ?></td>
                                    <td align="center"><?php echo $r['ecr_version']; ?></td>
                                    <td align="center"><?php echo $r['transaction_type']; ?></td>
                                    <td align="center"><?php echo $r['transaction_amount']; ?></td>
                                    <td align="center"><?php echo $r['other_amount']; ?></td>
                                    <td align="center"><?php echo $r['pan']; ?></td>
                                    <td align="center"><?php echo $r['expire_date']; ?></td>
                                    <td align="center"><?php echo $r['cancel_reason']; ?></td>
                                    <td align="center"><?php echo $r['invoice_number']; ?></td>
                                    <td align="center"><?php echo $r['auth_code']; ?></td>
                                    <td align="center"><?php echo $r['installment_flag']; ?></td>
                                    <td align="center"><?php echo $r['redeem_flag']; ?></td>
                                    <td align="center"><?php echo $r['dcc_flag']; ?></td>
                                    <td align="center"><?php echo $r['installment_plan']; ?></td>
                                    <td align="center"><?php echo $r['installment_tenor']; ?></td>
                                    <td align="center"><?php echo $r['generic_data']; ?></td>
                                    <td align="center"><?php echo $r['reff_number']; ?></td>
                                    <td align="center"><?php echo $r['merchant_filler']; ?></td>
                                    <td align="center"><?php echo $r['end_of_text']; ?></td>
                                    <td align="center"><?php echo $r['crc']; ?></td>
                                    <td align="center"><?php $a = str_split($r['response'], 120);
                                                        foreach ($a as $aa) :
                                                            echo $aa; ?><br><?php endforeach; ?></td>
                                </tr>
                        <?php
                            endwhile;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            //settin geser
            //$s2 = mysqli_query($query);
            $jmldata = mysqli_num_rows($query);
            if ($jmldata > 0) {
                if ($batas < 1) {
                    $batas = 1;
                }
                $jmlhal  = ceil($jmldata / $batas);
                echo "<div class='pagination_area pull-right mt-5'><ul>";
                if ($page > 1) {
                    $prev = $page - 1;
                    echo "<a href='$_SERVER[PHP_SELF]?module=sale&page=$prev'><i class='fa fa-chevron-left'></i></a> ";
                } else {
                    echo "<li class='page-item disabled'><i class='fa fa-chevron-left'></i></li> ";
                }
                // status_galerikan link page 1,2,3 ...
                for ($i = 1; $i <= $jmlhal; $i++)
                    if ($i != $page) {
                        echo "<li><a href='$_SERVER[PHP_SELF]?module=sale&page=$i'>$i</a></li> ";
                    } else {
                        echo " <li class='active'><font size=4>$i</font></li> ";
                    }
                // Link kepage berikutnya (Next)
                if ($page < $jmlhal) {
                    $next = $page + 1;
                    echo "<a href='?module=sale&page=$next'><i class='fa fa-chevron-right'></i></a>";
                } else {
                    echo "<li class='page-item disabled'><i class='fa fa-chevron-right'></i></li>";
                }
                echo "</ul></div>";
            } //if jmldata
            else {
                //$s2 = mysqli_query($query);
                $jmldata = mysqli_num_rows($query);
            }
            echo "<br>Jumlah : $jmldata Data";
            ?>
        </div>
    </div>

<?php
} else if ($stt == "cari") {
?>
    <div class="card mt-5">
        <div class="card-body">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Pencarian Data Sale</h4>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form role="form" name="form1" method="post" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Kategori data</label>
                                        <select class="form-control" name="listcari">
                                            <option value="">Pilih disini</option>
                                            <option value="merchant">Merchant</option>
                                            <option value="pan">Nomor Kartu</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ketik disini</label>
                                        <input class="form-control" type="text" name="txtcari" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu</label>
                                        <input class="form-control" type="text" name="time" placeholder="01:55:00 (jika semua data isi 00:00:00 & rentang jam isi jamnya saja cnth: 12)" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input class="form-control" type="text" name="date" placeholder="01/01/2023 (jika semua data isi 00/00/0000)" required />
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-3" name="Cari">Cari</button>
                                    <a href="<?php echo "$_SERVER[PHP_SELF]?module=sale"; ?>"><button type="button" class="btn btn-primary mb-3">Batal Cari</button></a>
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
                $time = $_POST['time'];
                $date = $_POST['date'];
                if ($listcari == "") {
                    echo '<script>alert("Pilih dahulu");</script>';
                } else {

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
                                                    <th scope="col">MERCHANT</th>
                                                    <th scope="col">IP EDC</th>
                                                    <th scope="col">TIME</th>
                                                    <th scope="col">DATE</th>
                                                    <th scope="col">StartofText</th>
                                                    <th scope="col">MessageLength</th>
                                                    <th scope="col">ECRVersion</th>
                                                    <th scope="col">Transaction Type</th>
                                                    <th scope="col">Transaction Amount</th>
                                                    <th scope="col">Other Amount</th>
                                                    <th scope="col">PAN</th>
                                                    <th scope="col">Expire Date</th>
                                                    <th scope="col">Cancel Reason</th>
                                                    <th scope="col">Invoice Number</th>
                                                    <th scope="col">Auth Code</th>
                                                    <th scope="col">Installment Flag</th>
                                                    <th scope="col">Reedem Flag</th>
                                                    <th scope="col">DCC Flag</th>
                                                    <th scope="col">Installment Plan</th>
                                                    <th scope="col">Installment Tenor</th>
                                                    <th scope="col">Generic Data</th>
                                                    <th scope="col">Reff Number</th>
                                                    <th scope="col">Merchant Filler</th>
                                                    <th scope="col">end Of Text</th>
                                                    <th scope="col">crc</th>
                                                    <th scope="col">Response</th>
                                                </tr>
                                            </thead>
                                            <tbody>



                                                <?php
                                                if ($date == "00/00/0000" && $time == "00:00:00") {
                                                    $query = mysqli_query($koneksi, "SELECT * FROM sale WHERE `$listcari` like '%$txtcari%' order by `id` DESC");
                                                } 
                                                else if ($date == "00/00/0000") {
                                                    $query = mysqli_query($koneksi, "SELECT * FROM sale WHERE `$listcari` like '%$txtcari%' AND time like '%$time%' order by `id` DESC");
                                                }
                                                else if ($time == "00:00:00") {
                                                    $query = mysqli_query($koneksi, "SELECT * FROM sale WHERE `$listcari` like '%$txtcari%' AND date like '%$date%' order by `id` DESC");
                                                }else {
                                                    $query = mysqli_query($koneksi, "SELECT * FROM sale WHERE `$listcari` like '%$txtcari%' AND date like '%$date%' AND time like '%$time%' order by `id` DESC");
                                                }
                                                if (mysqli_num_rows($query) == 0) {
                                                    echo "
	<tr style='text-align:center'>
  <td colspan='7'>Tidak Ada Data Yang Tersedia</td>
 </tr>
	
	
";
                                                } else {
                                                    while ($r = mysqli_fetch_array($query)) :     ?>

                                                        <tr class="odd gradeX">
                                                            <td align="center"><?php echo $r['merchant'] ?></td>
                                                            <td align="center"><?php echo $r['ip_edc'] ?></td>
                                                            <td align="center"><?php echo $r['time']; ?></td>
                                                            <td align="center"><?php echo $r['date']; ?></td>
                                                            <td align="center"><?php echo $r['start_of_text']; ?></td>
                                                            <td align="center"><?php echo $r['message_length']; ?></td>
                                                            <td align="center"><?php echo $r['ecr_version']; ?></td>
                                                            <td align="center"><?php echo $r['transaction_type']; ?></td>
                                                            <td align="center"><?php echo $r['transaction_amount']; ?></td>
                                                            <td align="center"><?php echo $r['other_amount']; ?></td>
                                                            <td align="center"><?php echo $r['pan']; ?></td>
                                                            <td align="center"><?php echo $r['expire_date']; ?></td>
                                                            <td align="center"><?php echo $r['cancel_reason']; ?></td>
                                                            <td align="center"><?php echo $r['invoice_number']; ?></td>
                                                            <td align="center"><?php echo $r['auth_code']; ?></td>
                                                            <td align="center"><?php echo $r['installment_flag']; ?></td>
                                                            <td align="center"><?php echo $r['redeem_flag']; ?></td>
                                                            <td align="center"><?php echo $r['dcc_flag']; ?></td>
                                                            <td align="center"><?php echo $r['installment_plan']; ?></td>
                                                            <td align="center"><?php echo $r['installment_tenor']; ?></td>
                                                            <td align="center"><?php echo $r['generic_data']; ?></td>
                                                            <td align="center"><?php echo $r['reff_number']; ?></td>
                                                            <td align="center"><?php echo $r['merchant_filler']; ?></td>
                                                            <td align="center"><?php echo $r['end_of_text']; ?></td>
                                                            <td align="center"><?php echo $r['crc']; ?></td>
                                                            <td align="center"><?php echo $r['response']; ?></td>
                                                        </tr>
                                            <?php

                                                    endwhile;
                                                }
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