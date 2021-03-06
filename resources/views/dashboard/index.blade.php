@extends('layouts.app')
@section('title', 'Usuários')

@section('css')

<link href="{{ asset('plugins/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" crossorigin="anonymous" />
<link href="{{ asset('plugins/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet" crossorigin="anonymous" />

@endsection

@section('main')
    @if ($company == null && $provider == null)

    <div class="alert alert-warning m-auto p-5" role="alert">
        <i class="fas fa-exclamation-circle"></i>
        Esta página é somente para proprietário de Empresa e Prestador de Serviço!
    </div>

    @else
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-chart-pie text-primary"></i> Relatórios</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Relatórios</li>
                </ol>
                
                <div class="row">
                    {{-- Chart One --}}
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-clock"></i>
                                Agendamentos
                            </div>
                            <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                        </div>
                    </div>
                    {{-- Chart Two --}}
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-star"></i>
                                Satisfação
                            </div>
                            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                        </div>
                    </div>
                </div>

                {{-- DataTables --}}

                @if (isset($company))
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-store mr-1"></i>
                            {{ $company->trade_name }}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="companyTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Data do agendamento</th>
                                            <th>Status do agendamento</th>
                                            <th>Cliente</th>
                                            <th>CPF</th>
                                            <th>Data de criação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($company_schedules) > 0)
                                            @foreach($company_schedules as $schedule)
                                                <tr>
                                                    <td>{{ date_format(new DateTime($schedule->date_time), 'd/m/Y H:i') }}</td>
                                                    <td>{{ $schedule->status->status}}</td>
                                                    <td>{{ ucwords(strtolower($schedule->customer->name)) }}</td>
                                                    <td>{{ $schedule->customer->cpf }}</td>
                                                    <td>{{ $schedule->created_at->format('d/m/Y') }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr><td colspan="5">Não possui agendamentos</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                @if (isset($provider))
                    <h4><i class="fas fa-filter"></i> Filtros</h4>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="scheduleStatus">Status do Agendamento</label>
                            <input type="text" id="scheduleStatus" class="form-control" placeholder="Status do Agendamento">
                        </div>
                        <div class="col">
                            <label for="scheduleStatus">Cliente</label>
                            <input id="scheduleCustomer" list="scheduleCustomerList" class="js-example-basic-single form-control" placeholder="Selecione...">
                            <datalist id="scheduleCustomerList">
                                @if (count($provider_schedules) > 0)
                                    @foreach ($provider_schedules as $schedule)
                                        <option value="{{ $schedule->customer->name }}">
                                    @endforeach
                                @else
                                @endif
                            </datalist>
                        </div>
                        <div class="col">
                            <label for="scheduleCPF">CPF</label>
                            <input type="text" id="scheduleStatus" class="form-control" placeholder="CPF">
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-male mr-1"></i>
                            {{ $provider->nickname }}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="providerTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Data do agendamento</th>
                                            <th>Status do agendamento</th>
                                            <th>Cliente</th>
                                            <th>CPF</th>
                                            <th>Data de criação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($provider_schedules) > 0)
                                            @foreach($provider_schedules as $schedule)
                                                <tr>
                                                    <td>{{ date_format(new DateTime($schedule->date_time), 'd/m/Y H:i') }}</td>
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
    <script src="{{ asset('plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dashboard-datatables.js') }}"></script>
@endsection