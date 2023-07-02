<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')) : ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashData('failed')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


<!-- Table with stripped rows -->
<table class="table datatable">
    <thead>
        <tr>
            <th scope="col">Username</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $index => $user) : ?>
            <?php if ($user['role'] == 'user') { ?>
                <tr>
                        <td><?php echo $user['username'] ?></td>
                        <td><?php echo $user['is_aktif'] ? 'Aktif' : 'Non-Aktif' ?></td>
                        <td>                          
                            <?php if ($user['is_aktif']) : ?>
                                <a href="<?= base_url('user/deactivate/' . $user['id']) ?>" class="btn btn-warning" onclick="return confirm('Disable This Account?')">
                                Disable
                                </a>
                            <?php else : ?>
                                <a href="<?= base_url('user/activate/' . $user['id']) ?>" class="btn btn-success" onclick="return confirm('Activate This Account ?')">
                                Activate                           
                                </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php } ?>
        <?php endforeach ?>
    </tbody>
</table>

<?= $this->endSection() ?>