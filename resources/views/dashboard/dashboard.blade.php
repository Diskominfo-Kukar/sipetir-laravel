<x-app-layout :title=$pageTitle :sub-title=$subTitle :icon=$icon :crumbs=$crumbs>
    <div class="row">
        <div class="col-md-3 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Total Paket</h5>
                    <i class="bi bi-archive-fill block fs-3"></i> <!-- Ikon untuk Total Paket -->
                </div>
                <div class="card-body">
                    <h5>{{ $paketStatus['paketTotal'] }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Paket Progress</h5>
                    <i class="bi bi-hourglass-split block fs-3"></i> <!-- Ikon untuk Paket Progress -->
                </div>
                <div class="card-body">
                    <h5>{{ $paketStatus['paketProgress'] }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Paket Selesai</h5>
                    <i class="bi bi-check-circle-fill block fs-3"></i> <!-- Ikon untuk Paket Selesai -->
                </div>
                <div class="card-body">
                    <h5>{{ $paketStatus['paketSelesai'] }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Paket Tayang</h5>
                    <i class="bi bi-broadcast block fs-3"></i> <!-- Ikon untuk Paket Tayang -->
                </div>
                <div class="card-body">
                    <h5>{{ $paketStatus['paketTayang'] }}</h5>
                </div>
            </div>
        </div>
    </div>


    {{-- 
        <div class="card shadow-sm radius-10 border-0 mb-3">
            <div class="card-body">
                <h4>Info Paket Tayang</h4>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorem saepe eligendi harum voluptas iusto rerum obcaecati totam doloremque commodi magni.</p>
                <h4>Info Paket Selesai</h4>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorem saepe eligendi harum voluptas iusto rerum obcaecati totam doloremque commodi magni.</p>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorem saepe eligendi harum voluptas iusto rerum obcaecati totam doloremque commodi magni.</p>
            </div>
        </div> 
    --}}

    <div class="col-md-12 card">
        <div class="card-body">
            <div id="chart">
            </div>
        </div>
    </div>


    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script>
            var months = <?php echo json_encode($months); ?>;
            var paketTotal = <?php echo json_encode($paketTotal); ?>;
            var paketProgress = <?php echo json_encode($paketProgress); ?>;
            var paketSelesai = <?php echo json_encode($paketSelesai); ?>;
            var paketTayang = <?php echo json_encode($paketTayang); ?>;

            var options = {
                series: [{
                        name: 'Total Paket',
                        data: paketTotal
                    },
                    {
                        name: 'Paket dalam Progress',
                        data: paketProgress
                    },
                    {
                        name: 'Paket Selesai',
                        data: paketSelesai
                    },
                    {
                        name: 'Paket Tayang',
                        data: paketTayang
                    }
                ],
                chart: {
                    type: 'line',
                    height: 350
                },
                title: {
                    text: 'Status Paket Per Bulan',
                    align: 'center',
                    style: {
                        fontSize: '20px',
                        fontWeight: 'bold',
                        color: '#263238'
                    }
                },
                xaxis: {
                    categories: months,
                    title: {
                        text: 'Bulan'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Paket'
                    }
                },
                stroke: {
                    curve: 'smooth'
                },
                markers: {
                    size: 4
                },
                tooltip: {
                    shared: true,
                    intersect: false
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        </script>
    @endpush
</x-app-layout>
