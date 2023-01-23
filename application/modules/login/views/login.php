<body>
    <div class="wrapper">
        <form class="p-3 mt-3" method="post" action="<?php echo base_url('login/loginuser'); ?>">
            <div class="logo">
                <img src="<?= base_url('assets/img/admin/logoPN.ico') ?>" alt="">
            </div>
            <div class="text-center mt-4 name">
                <p><span style="font-weight:bold;">SICULI</span>
                    <span style="font-weight:lighter;">Pengadilan Negeri Semarang</span>
                </p>
            </div>
            <?php if ($this->session->flashdata('message')) {
                echo '<p class="warning mt-2 mb-2">' . $this->session->flashdata('message') . '</p>';
            } ?>
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="email" name="email" id="email" value="<?php if (isset($_COOKIE['email'])) {
                                                                        echo $_COOKIE['email'];
                                                                    } ?>" placeholder="Email" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="password" value="<?php if (isset($_COOKIE['password'])) {
                                                                                echo $_COOKIE['password'];
                                                                            } ?>" placeholder="Password" required>
            </div>
            <?php echo $this->session->flashdata('msg'); ?>
            <input type="hidden" name="role" value="user">
            <button type="submit" class="btn mt-3" name="login" id="login"><span class="text-light" style="font-weight: bold;">Login</span></button>
            <?php echo form_close() ?>
        </form>
    </div>
</body>
