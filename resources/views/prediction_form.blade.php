@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <form action="{{ route('prediction.view') }}" method="POST">
        @csrf

        {{-- ===== Step 1: Choose Product ===== --}}
        <div class="card mb-4 p-3">
            <h5 class="mb-3">Select Product</h5>
            <div class="mb-3">
                <select name="product_id" id="product_id" class="form-select" required>
                    <option value="">-- Choose Product --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- ===== Step 2: Production Costs ===== --}}
        <div class="card mb-4 p-3">
            <h5 class="mb-3">Production Details</h5>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="units_produced" class="form-label">Units Produced</label>
                    <input type="number" class="form-control" name="units_produced" id="units_produced" min="0" required>
                </div>
                <div class="col-md-3">
                    <label for="production_cost_per_unit" class="form-label">Production Cost per Unit</label>
                    <input type="number" step="0.01" class="form-control" name="production_cost_per_unit" id="production_cost_per_unit" min="0" required>
                </div>
                <div class="col-md-3">
                    <label for="additional_cost" class="form-label">Additional Costs</label>
                    <input type="number" step="0.01" class="form-control" name="additional_cost" id="additional_cost" min="0" value="0">
                </div>
                <div class="col-md-3">
                    <label for="total_production_cost" class="form-label">Total Production Cost</label>
                    <input type="number" step="0.01" class="form-control" name="total_production_cost" id="total_production_cost" readonly>
                </div>
            </div>
        </div>

        {{-- ===== Step 3: Sales Data ===== --}}
        <div class="card mb-4 p-3">
            <h5 class="mb-3">Sales Details</h5>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="units_sold" class="form-label">Units Sold</label>
                    <input type="number" class="form-control" name="units_sold" id="units_sold" min="0" required>
                </div>
                <div class="col-md-4">
                    <label for="selling_price_per_unit" class="form-label">Selling Price per Unit</label>
                    <input type="number" step="0.01" class="form-control" name="selling_price_per_unit" id="selling_price_per_unit" min="0" required>
                </div>
                <div class="col-md-4">
                    <label for="total_revenue" class="form-label">Total Revenue</label>
                    <input type="number" step="0.01" class="form-control" name="total_revenue" id="total_revenue" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="gross_profit" class="form-label">Gross Profit</label>
                    <input type="number" step="0.01" class="form-control" name="gross_profit" id="gross_profit" readonly>
                </div>
                <div class="col-md-6">
                    <label for="net_profit" class="form-label">Net Profit</label>
                    <input type="number" step="0.01" class="form-control" name="net_profit" id="net_profit" readonly>
                </div>
            </div>
        </div>

        {{-- ===== Step 4: Predict for Date Range ===== --}}
        <div class="card p-3 bg-primary bg-opacity-10 mb-4">
            <h5 class="mb-3">Predict Sales</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" required>
                </div>
                <div class="col-md-6">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" name="end_date" id="end_date" required>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-bar-chart-line-fill me-2"></i> Predict
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    // Auto-calculate totals in Step 2
    const unitsProduced = document.getElementById('units_produced');
    const productionCostPerUnit = document.getElementById('production_cost_per_unit');
    const additionalCost = document.getElementById('additional_cost');
    const totalProductionCost = document.getElementById('total_production_cost');

    const unitsSold = document.getElementById('units_sold');
    const sellingPricePerUnit = document.getElementById('selling_price_per_unit');
    const totalRevenue = document.getElementById('total_revenue');

    const grossProfit = document.getElementById('gross_profit');
    const netProfit = document.getElementById('net_profit');

    function calculateTotals() {
        const prodCost = (unitsProduced.value || 0) * (productionCostPerUnit.value || 0);
        const addCost = parseFloat(additionalCost.value || 0);
        const totalCost = prodCost + addCost;
        totalProductionCost.value = totalCost.toFixed(2);

        const revenue = (unitsSold.value || 0) * (sellingPricePerUnit.value || 0);
        totalRevenue.value = revenue.toFixed(2);

        const gross = revenue - prodCost;
        grossProfit.value = gross.toFixed(2);

        const net = revenue - totalCost;
        netProfit.value = net.toFixed(2);
    }

    unitsProduced.addEventListener('input', calculateTotals);
    productionCostPerUnit.addEventListener('input', calculateTotals);
    additionalCost.addEventListener('input', calculateTotals);
    unitsSold.addEventListener('input', calculateTotals);
    sellingPricePerUnit.addEventListener('input', calculateTotals);
</script>
@endsection
