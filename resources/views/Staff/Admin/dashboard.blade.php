@extends('layouts.admin')
@section('content')
    <div class="body-wrapper-inner">
        <div class="container-fluid">
          <!--  Row 1 -->
          <div class="row">
            <div class="col-lg-8">
              <div class="card w-100">
                <div class="card-body">
                  <div class="d-md-flex align-items-center">
                    <div>
                      <h4 class="card-title">Sales Overview</h4>
                      <p class="card-subtitle">
                        Transaction total
                      </p>
                    </div>
                    <div class="ms-auto">
                      <ul class="list-unstyled mb-0">
                        <li class="list-inline-item text-primary">
                          <span class="round-8 text-bg-primary rounded-circle me-1 d-inline-block"></span>
                          Total
                        </li>
                      </ul>
                      <div class="mt-3">
                        <select id="salesFilter" class="form-select w-auto">
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div id="sales-overview" class="mt-4 mx-n6"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card overflow-hidden">
                <div class="card-body pb-0">
                  <div class="d-flex align-items-start">
                    <div>
                      <h4 class="card-title">Total Stats</h4>
                      <p class="card-subtitle">Average sales</p>
                    </div>
                    <!-- <div class="ms-auto">
                      <div class="dropdown">
                        <a href="javascript:void(0)" class="text-muted" id="year1-dropdown" data-bs-toggle="dropdown"
                          aria-expanded="false">
                          <i class="ti ti-dots fs-7"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="year1-dropdown">
                          <li>
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                          </li>
                        </ul>
                      </div>
                    </div> -->
                  </div>
                  <div class="mt-4 pb-3 d-flex align-items-center">
                    <span class="btn btn-primary rounded-circle round-48 hstack justify-content-center">
                      <i class="ti ti-shopping-cart fs-6 text-black"></i>
                    </span>
                    <div class="ms-3">
                      <h5 class="mb-0 fw-bolder fs-4">Most Active Customer</h5>
                      <span class="text-muted fs-3">{{ $topUserByCount?->user?->name ?? '-' }} ( {{ $topUserByCount?->total ?? 0 }} )</span>
                    </div>
                    <div class="ms-auto">
                      @php
                        $totalTransactions = \App\Models\Transaction::count();
                        $percentage = $totalTransactions > 0 ? round(($topUserByCount?->total ?? 0) / $totalTransactions * 100, 1) : 0;
                      @endphp
                      <span class="badge bg-secondary-subtle text-muted">+{{ $percentage }}%</span>
                    </div>
                  </div>

                  <div class="py-3 d-flex align-items-center">
                    <span class="btn btn-warning rounded-circle round-48 hstack justify-content-center">
                      <i class="ti ti-car fs-6"></i>
                    </span>
                    <div class="ms-3">
                      <h5 class="mb-0 fw-bolder fs-4">Popular Car</h5>
                      <span class="text-muted fs-3">{{ $topCar?->name ?? '-' }} ( {{ $topCar?->total ?? 0 }} )</span>
                    </div>
                    <div class="ms-auto">
                      @php
                        $totalCarUsages = \App\Models\TransactionDetail::count();
                        $carPercentage = $totalCarUsages > 0 ? round(($topCar?->total ?? 0) / $totalCarUsages * 100, 1) : 0;
                      @endphp
                      <span class="badge bg-secondary-subtle text-muted">+{{ $carPercentage }}%</span>
                    </div>
                  </div>

                  <div class="py-3 d-flex align-items-center">
                    <span class="btn btn-secondary rounded-circle round-48 hstack justify-content-center">
                      <i class="ti ti-map-pin fs-6 text-black"></i>
                    </span>
                    <div class="ms-3">
                      <h5 class="mb-0 fw-bolder fs-4">Top Pick Up Location</h5>
                      <span class="text-muted fs-3">{{ $topLocation?->name ?? '-' }} ( {{ $topLocation?->total ?? 0 }} )</span>
                    </div>
                    <div class="ms-auto">
                      @php
                        $totalLocationUsage = \App\Models\TransactionDetail::join('car_tours', 'transaction_details.car_tours_id', '=', 'car_tours.id')->count();
                        $locPercentage = $totalLocationUsage > 0 ? round(($topLocation?->total ?? 0) / $totalLocationUsage * 100, 1) : 0;
                      @endphp
                      <span class="badge bg-secondary-subtle text-muted">+{{ $locPercentage }}%</span>
                    </div>
                  </div>

                  <div class="pt-3 mb-7 d-flex align-items-center">
                    <span class="btn btn-success rounded-circle round-48 hstack justify-content-center">
                      <i class="ti ti-currency-dollar fs-6 text-black"></i>
                    </span>
                    <div class="ms-3">
                      <h5 class="mb-0 fw-bolder fs-4">Top Spender</h5>
                      <span class="text-muted fs-3">{{ $topUserByTotal?->user?->name ?? '-' }} ( Rp{{ number_format($topUserByTotal?->total ?? 0, 0, ',', '.') }} )</span>
                    </div>
                    <div class="ms-auto">
                      @php
                        $totalIncome = \App\Models\Transaction::sum('total');
                        $userIncomePercentage = $totalIncome > 0 ? round(($topUserByTotal?->total ?? 0) / $totalIncome * 100, 1) : 0;
                      @endphp
                      <span class="badge bg-secondary-subtle text-muted">+{{ $userIncomePercentage }}%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-md-flex align-items-center">
                    <div>
                      <h4 class="card-title">Latest Completed Transaction</h4>
                    </div>
                    <!-- <div class="ms-auto mt-3 mt-md-0">
                      <select class="form-select theme-select border-0" aria-label="Default select example">
                        <option value="1">Weekly</option>
                        <option value="2">Monthly</option>
                        <option value="3">Yearly</option>
                      </select>
                    </div> -->
                  </div>
                  <div class="table-responsive mt-4">
                    <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                      <thead>
                        <tr>
                          <th scope="col" class="px-0 text-muted">
                            User
                          </th>
                          <th scope="col" class="px-0 text-muted">Tour</th>
                          <th scope="col" class="px-0 text-muted text-end">
                            Total
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($transactions as $transaction)
                          @php
                            $user = $transaction->user;
                            $carTour = $transaction->transactionDetails->first()->carTour ?? null;
                            $carName = $carTour?->car?->name ?? '-';
                            $total = number_format($transaction->total, 0, ',', '.');
                          @endphp
                          <tr>
                            <td class="px-0">
                              <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/profile/user-3.jpg') }}" class="rounded-circle" width="40" alt="user" />
                                <div class="ms-3">
                                  <h6 class="mb-0 fw-bolder">{{ $user->name }}</h6>
                                  <span class="text-muted">{{ $user->phone ?? '-' }}</span>
                                </div>
                              </div>
                            </td>
                            <td class="px-0">{{ $carName }}</td>
                            <td class="px-0 text-dark fw-medium text-end">
                              Rp {{ $total }}
                            </td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                              <strong>No transactions available.</strong>
                            </td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                  <div class="mt-3">
                      {{ $transactions->links() }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="py-6 px-6 text-center">
            <p class="mb-0 fs-4">Design and Developed by <a href="#"
                class="pe-1 text-primary text-decoration-underline">Wrappixel.com</a> Distributed by <a href="https://themewagon.com" target="_blank" >ThemeWagon</a></p>
          </div> -->
        </div>
      </div>
@endsection