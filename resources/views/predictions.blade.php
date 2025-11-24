@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Prediction for: {{ $prediction['product'] ?? 'Product' }}</h2>

    <div class="row mb-4">
        {{-- Forecasted Values --}}
        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-primary text-white">Forecasted Sales & Cost</div>
                <div class="card-body">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <th>Units Sold</th>
                            <td>{{ $prediction['forecast_units_sold'] }}</td>
                        </tr>
                        <tr>
                            <th>Unit Cost</th>
                            <td>${{ number_format($prediction['forecast_unit_cost'], 2) }}</td>
                        </tr>
                        <tr>
                            <th>Selling Price</th>
                            <td>${{ number_format($prediction['forecast_selling_price'], 2) }}</td>
                        </tr>
                        <tr>
                            <th>Total Revenue</th>
                            <td>${{ number_format($prediction['forecast_revenue'], 2) }}</td>
                        </tr>
                        <tr>
                            <th>Forecast Profit</th>
                            <td>${{ number_format($prediction['forecast_profit'], 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Metrics --}}
        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-success text-white">Calculated Metrics</div>
                <div class="card-body">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <th>Cost %</th>
                            <td>{{ number_format($prediction['cost_percentage'], 2) }}%</td>
                        </tr>
                        <tr>
                            <th>Profit Margin</th>
                            <td>{{ number_format($prediction['profit_margin'], 2) }}%</td>
                        </tr>
                        <tr>
                            <th>Ideal Selling Price</th>
                            <td>${{ number_format($prediction['ideal_selling_price'], 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- AI Suggestions --}}
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">AI Suggestions</div>
        <div class="card-body">
            <p><strong>Menu Description:</strong> {{ $prediction['ai_generated_text'] }}</p>
            <p><strong>Cost Saving Suggestion:</strong> {{ $prediction['cost_saving_suggestion'] }}</p>
        </div>
    </div>

    {{-- Back Button --}}
    <div class="mt-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
