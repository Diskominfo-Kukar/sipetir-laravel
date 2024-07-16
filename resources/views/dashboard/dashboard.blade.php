<x-app-layout
    :title=$pageTitle
    :sub-title=$subTitle
    :icon=$icon
    :crumbs=$crumbs
>
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Paket Tayang</h5>
                    <i class="bi bi-cart-check block fs-3"></i>
                </div>
                <div class="card-body">
                    <h5>60</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Paket Tayang</h5>
                    <i class="bi bi-cart-check block fs-3"></i>
                </div>
                <div class="card-body">
                    <h5>60</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Paket Tayang</h5>
                    <i class="bi bi-cart-check block fs-3"></i>
                </div>
                <div class="card-body">
                    <h5>60</h5>
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
            var options = {
            series: [
                {
                    name: "Paket Tayang",
                    data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                },
                {
                    name: "Paket Tayang",
                    data: [40, 61, 65, 70, 79, 52, 89, 41, 108]
                },
            ],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            title: {
                text: 'Chart Paket',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            },
            yaxis: {
                min: 0,
                max: 160
            }
            };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        </script>
    @endpush
</x-app-layout>
