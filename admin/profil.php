
<h2>HALAMAN PROFIL</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Lengkap</th>
            <td><?= $_SESSION["admin"]["nama_lengkap"] ?></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><?= $_SESSION["admin"]["username"] ?></td>
        </tr>
        <tr>
            <th>foto profile</th>
            <td>
                <img style="width: 100px;height:auto" class="img-responsive" src="../profile_admin/<?= $_SESSION["admin"]["foto_profil"] ?>" alt="">
            </td>
        </tr>
    </thead>
</table>