<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-lg-7">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Forgot Your Password</h1>
                            </div>

                            <?php $this->session->flashdata('mesage') ?>

                            <form class="user" method="post" action="<?= base_url('auth/forgotpassword') ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." value="<?=set_value('email'); ?>">
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                
        
                                <button href="<?= base_url('auth') ?>" class="btn btn-primary btn-user btn-block">
                                    Reset Password
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Back to Login</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>