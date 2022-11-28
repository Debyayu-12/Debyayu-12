
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title?></h1>


    <div class="row">
        <div class="col-lg">
        <!-- pesan error -->
        <!-- form_error -->
        <?php if (validation_errors()) : ?>
            <div class="alert alert-success" role="alert">
                <?php validation_errors(); ?>
            </div>
        <?php endif; ?>
        <?= $this->session->flashdata('message'); ?>
        <!-- akhir pesan error -->

        <!-- tombol tambah -->
        
        <!-- tabel -->
        <div class ="card shadow mb-4">
            <div class="card-header py-3 bg-gradient-info">
                <h6 class="m-0 font-waight-bold text-white"><?= $title; ?></h6>
                </div>
            <div class="card-body">
                <div clas="col-md-6">
            <a href="" class="btn btn-primary mb-3" class="btn btn-primary btn-sm rounded" 
            data-toggle="modal" data-target="#logoutModal"><span class="fas fa-fw fa-plus"></span>Add Sub Menu</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Url</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Active</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($SubMenu as $sm) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $sm['title']; ?></td>                        
                        <td><?= $sm['menu']; ?></td>                        
                        <td><?= $sm['url']; ?></td>                        
                        <td><?= $sm['icon']; ?></td>                        
                        <td><?= $sm['is_active']; ?></td>                        
                        <td>
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown1"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"></i></button>
                            <div class="dropdown-menu">
                            <a href="<?= base_url('menu/submenuedit');?>" class="dropdown-item has-icon" data-toggle="modal" 
                            data-target="#examplemodalsubedit<?= $sm['id']; ?>">
                            <span class="fas fa-fw fa-edit"></span>Edit</span></a>
                            <button onclick="hapusSubmenu('<?= base_url('menu/hapus/') . $sm['id']; ?>')"class="dropdown-item has-icon">
                            <span class="fas fa-fw fa-trash-alt"></span>Delete</span></button>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- akhir tabel -->
            </div>
        </div>
    </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End kof Main Content -->
    <!-- modal -->
    <div class="modal fade" id="logoutModal" tebindex="-1"
    aria-labelledby="newMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newMenuModalLabel">Add new Menu</h5>
                    <button type="button" class="btn-close"
                    date-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('menu/submenu'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                        <input type="text" class="form-control" id="title"
                        name="title" placeholder="SubMenu title">
                    </div>
                <div class="form-group">
                    <select name="menu_id" id="menu_id" class="form-control">
                        <option value="" class="value">Select Menu</option>
                        <?php foreach ($menu as $m) :?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1"
                        name="is_active" id="is_active" aria-label="checkbox for following text input" checked>
                        <label for="is_active" class="form_check_label">Active?</label>

                    </div>
                </div>
            </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal edit -->
<?php foreach ($SubMenu as $sm) : ?>

    <div class="modal fade" id="examplemodalsubedit<?= $sm['id']; ?>" 
    tebindex="-1" role="dialog"
        aria-labelledby="exampleModalLabelsubedit" aria-hidden="true">
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelsubedit">Edit subMenu</h5>
                        <button type="button" class="btn-close"
                        date-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('menu/submenuedit/'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                            <input type="text" value="<?= $sm['title'] ?>" 
                            class="form-control" id="title"
                            name="title" placeholder="Submenu title">
                        </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id" name="id"
                        readenly value="<?= $sm['id'] ?>">
                        </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu-id" class="form-control">
                            <option value="<?= $sm['menu_id']; ?>"><?= $sm['menu']; ?></option>
                            <?php foreach ($menu as $m) :?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text"  value="<?= $sm['url'] ?>" class="form-control" 
                        id="url" name="url" placeholder="Submenu url">
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?= $sm['icon'] ?>"class="form-control" 
                        id="icon" name="icon" placeholder="Submenu icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1"
                            id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">
                            Active?
                            </label>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="edit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>