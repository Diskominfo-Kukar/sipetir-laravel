<div class="row">
    <div class="col">
        <div class="timeline-steps">
            @foreach ($timelines as $key => $timeline)
            @php
                $isActive = $paket->status == $key;
                $isBeforeActive = $paket->status - 1 == $key;
            @endphp
            <div class="timeline-step {{$isActive ? 'active' : ''}} {{$isBeforeActive ? 'before-active' : ''}} {{$paket->status == 11 && $key == 1 ? 'active' : ''}}">
                <div class="timeline-content">
                    <div class="inner-circle {{$isActive ? 'active' : ''}}"></div>
                    <p class="mt-1 mb-1">{{$timeline}}</p>
                    {{-- <p class="h6 text-muted mb-0 mb-lg-0">Favland Founded</p> --}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('styles')
    <style>
        /* Timeline */
        .timeline-steps {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            font-size: 10pt;
        }

        .timeline-steps .timeline-step {
            align-items: center;
            display: flex;
            flex-direction: column;
            position: relative;
            margin: 0.1rem
        }

        @media (min-width:768px) {
            .timeline-steps .timeline-step:not(:last-child):after {
                content: "";
                display: block;
                border-top: .25rem dotted #3b82f6;
                width: 3.46rem;
                position: absolute;
                left: 7.5rem;
                top: .3125rem
            }
            .timeline-steps .timeline-step:not(:first-child):before {
                content: "";
                display: block;
                border-top: .25rem dotted #3b82f6;
                width: 3.8125rem;
                position: absolute;
                right: 7.5rem;
                top: .3125rem
            }

            .timeline-steps .timeline-step.active:before {
                border-top: .25rem dotted #2fc71a !important;
            }

            .timeline-steps .timeline-step.before-active:after {
                border-top: .25rem dotted #2fc71a !important;
            }
        }

        .timeline-steps .timeline-content {
            width: 10rem;
            text-align: center
        }

        .timeline-steps .timeline-content .inner-circle {
            border-radius: 1.5rem;
            height: 10px;
            width: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #3b82f6
        }

        .timeline-steps .timeline-content .inner-circle:before {
            content: "";
            background-color: #3b82f6;
            display: inline-block;
            height: 15px;
            width: 15px;
            min-width: 15px;
            border-radius: 6.25rem;
            opacity: .5
        }

        .timeline-steps .timeline-content .inner-circle.active,
        .timeline-steps .timeline-content .inner-circle.active:before {
            background-color: #2fc71a;
        }


    </style>
    @endpush
