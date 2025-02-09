<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function updateData() {
        // Memuat konten dari URL tertentu ke dalam div dengan ID "myDiv"
        $("#myDiv").load("/skripsi/webmonitoring/application/config/koneksi.php #content", function(response, status, xhr) {
            if (status == "error") {
                console.log(xhr.statusText);
            }
        });
        $("#myDivv").load("/skripsi/webmonitoring/application/config/koneksi.php #contentt", function(responsee, status, xhr) {
            if (status == "error") {
                console.log(xhr.statusText);
            }
        });
    }
    // Panggil fungsi updateData() setiap detik (1000 milidetik)
    setInterval(updateData, 1000);
</script>
<div class="col-lg-8">
</div>
<div class="card mt-5">
            <div class="card-body">
                <div class="alert-items">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-lg-0">
                            <div class="card">
                                <div class="seo-fact sbg3">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <h2>
                                            <div class="seofct-icon">Transaksi Sale Hari ini </div>
                                        </h2>
                                        <h2>
                                            <div id="myDiv"></div>
                                        </h2>
                                        <canvas id="seolinechart3" height="60" width="1000"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 mb-lg-0">
                            <div class="card">
                                <div class="seo-fact sbg3">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <h2>
                                            <div class="seofct-icon">Transaksi Sale Bulan <?php $hariIni = new DateTime();
                                                                                            echo $hariIni->format('F');?></div>
                                        </h2>
                                        <h2>
                                            <div id="myDivv"></div>
                                        </h2>
                                        <canvas id="seolinechart4" height="60" width="2000"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
</div>
</div>
</div>
</div>