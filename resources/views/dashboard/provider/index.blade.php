@extends('layouts.app')
@section('title', $provider->nickname)

@section('main')
    @if ($provider == null)

    <div class="alert alert-warning m-auto p-5" role="alert">
        <i class="fas fa-exclamation-circle"></i>
        Esta página é somente para proprietário de Empresa e Prestador de Serviço!
    </div>

    @else
        <input type="hidden" id="starOne" value={{$stars[0]}}>
        <input type="hidden" id="starTwo" value={{$stars[1]}}>
        <input type="hidden" id="starThree" value={{$stars[2]}}>
        <input type="hidden" id="starFour" value={{$stars[3]}}>
        <input type="hidden" id="starFive" value={{$stars[4]}}>
        
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-chart-pie text-primary"></i> Relatórios</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Relatórios</li>
                </ol>
                
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar mr-1"></i>
                                Avaliações
                            </div>
                            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                        </div>
                    </div>
                </div>

                {{-- DataTables --}}
                @if (isset($provider))
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>
                                <i class="fas fa-male mr-1"></i>
                                {{ $provider->nickname }}
                            </h5>
                        </div>
                        <div class="card-body">

                            <p><i class="fas fa-filter"></i> Filtros</p>
                            <div class="row my-3">
                                <div class="col">
                                    <label for="status">Status do Agendamento</label>
                                    <select id="status" name="status" class="custom-select">
                                        <option disabled hidden selected>Selecione...</option>
                                        <option>Todos</option>
                                        @foreach($status as $item) 
                                            <option value="{{ $item->id }}">{{ $item->status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="client">Cliente</label>
                                    <input type="text" id="client" class="form-control" placeholder="Nome do cliente">
                                </div>
                                <div class="col">
                                    <label for="clientCPF">CPF</label>
                                    <input type="text" id="clientCPF" class="form-control cpf" placeholder="000.000.000-00">
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="datatable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Hora</th>
                                            <th>Status</th>
                                            <th>Cliente</th>
                                            <th>CPF</th>
                                            <th>Data de criação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($provider_schedules) > 0)
                                            @foreach($provider_schedules as $schedule)
                                                <tr>
                                                    <td>{{ date_format(new DateTime($schedule->date_time), 'd/m/Y') }}</td>
                                                    <td>{{ date_format(new DateTime($schedule->date_time), 'H:i') }}</td>
                                                    <td>{{ $schedule->status->status}}</td>
                                                    <td>{{ ucwords(strtolower($schedule->customer->name)) }}</td>
                                                    <td>{{ $schedule->customer->cpf }}</td>
                                                    <td>{{ $schedule->created_at->format('d/m/Y') }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">Não possui agendamentos</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </main>
    @endif

@endsection

@section('js')
    <script src="{{ asset('plugins/jquery-mask/jquery.mask.min.js')}}"></script>
    <script src="{{ asset('js/mask-format.js') }}"></script>
    <script src="{{ asset('js/dashboard-datatables.js') }}"></script>
    <script src="{{ asset('plugins/charts/chart.min.js') }}"></script>
    <script src="{{ asset('js/chart-bar-dashboard.js') }}"></script>
@endsection