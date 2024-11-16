<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Metode</th>
            <th>Lokasi</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $now = strtotime(date('Y-m-d'));
        foreach ($jadwals as $jadwal) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $jadwal->start_date; ?></td>
                <td><?= $jadwal->end_date; ?></td>
                <td><?= $jadwal->metode; ?></td>
                <td><?= $jadwal->location; ?></td>
                <td><?php if( strtotime($jadwal->end_date) > $now): ?>
                    <span class="badge badge-success">Aktif</span>
                <?php else: ?>
                    <span class="badge badge-danger">Tidak Aktif</span>
                <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>