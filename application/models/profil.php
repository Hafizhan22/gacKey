<?php
        $NIP = $_SESSION['nip_login'];
        $query = mysqli_query($koneksi, "SELECT * FROM account where NIP='$NIP'");
        $d = mysqli_fetch_array($query);
        $NIP = $d["NIP"];
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
                                                        value="<?php echo $NIP; ?>" />
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
                                                    <select class="form-control" name="level">
                                                <?php
                                                if ($role == "") {
                                                    echo "<option value=''>-- Choose --</option>";
                                                } else {

                                                    echo "<option value='$role'>$role</option>";
                                                }
                                                ?>
                                            
                                                        <option value="Security Operation System">SOC</option>
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary mb-3" name="Update">Save</button>
                                                <input type="hidden" name="image0" value="<?php echo "$image0"; ?>">
                                                <input type="hidden" name="NIP" value="<?php echo "$NIP"; ?>">
                                                <a href="<?php echo "$_SERVER[PHP_SELF]?module=home"; ?>"><button type="button"
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