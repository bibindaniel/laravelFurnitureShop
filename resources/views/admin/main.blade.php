@extends('adminLayouts.app')

@section('admin_body')
    <div class="container mt-4">
        <h1>Welcome to the Admin Panel</h1>

        <!-- Quick Stats Section -->
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Products</h5>
                        <p class="card-text">{{ $totalProducts }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text">{{ $totalOrders }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">New Customers</h5>
                        <p class="card-text">{{ $newCustomers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Monthly Revenue</h5>
                        <p class="card-text">25,000</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Quick Stats Section -->

<!-- Recent Orders Section -->
<div class="row mt-4">
    <div class="col-md-12">
        <h3>Recent Orders</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <!-- Add more columns if needed -->
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer }}</td>
                        <td>{{ $order->amount }}</td>
                         <td><span class="badge bg-success">Shipped</span></td>
                        <!-- Add more columns if needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- End Recent Orders Section -->


    </div>
@endsection
