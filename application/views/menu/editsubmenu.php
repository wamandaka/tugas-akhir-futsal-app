<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <?= $this->session->flashdata('message') ?>

    <div class="row">
        <div class="col-lg-6">
            <form action="<?= base_url('menu/edit/') . $submenu['id'] ?>" method="post">
                <input type="hidden" name="id" id="id" value="<?= $submenu['id'] ?>">
                <div class="form-group">
                    <label for="current_password">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $submenu['title'] ?>">
                    <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="new_password1">Url</label>
                    <input type="text" class="form-control" id="url" name="url" value="<?= $submenu['url'] ?>">
                    <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class=" form-group">
                    <label for="new_password2">Icon</label>
                    <input type="text" class="form-control" id="icon" name="icon" value="<?= $submenu['icon'] ?>">
                    <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Change</button>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->