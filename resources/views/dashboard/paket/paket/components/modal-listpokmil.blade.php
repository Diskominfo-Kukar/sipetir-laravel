@if (isset($paket->pokmil->pokmil_id))
<div class="modal fade" id="pokmilModal" tabindex="-1" aria-labelledby="pokmilModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pokmilModalLabel">Daftar Pokmil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <br>{{  $paket->pokmil->nama }}<br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="padding: 8px;">Nama</th>
                            <th style="padding: 8px;">Jabatan</th>
                            <th style="padding: 8px;">Telepon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paket->pokmil->panitia as $panitia)
                            <tr>
                                <td style="padding: 8px;">{{ $panitia->nama }}</td>
                                <td style="padding: 8px;">{{ $panitia->jabatan->nama }}</td>
                                <td style="padding: 8px;">{{ $panitia->telepon }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif
