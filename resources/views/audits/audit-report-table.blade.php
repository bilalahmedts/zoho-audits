<table class="table table-bordered">
    <thead>
        <tr>
            <th>ZOHO ID</th>
            <th>Agent Name</th>
            <th>Campaign</th>
            <th>Evaluation Status</th>
            <th>Comments</th>
            <th>Evaluated By</th>
            <th>Evaluation Date</th>
        </tr>
    </thead>
    <tbody>
        @if (count($audits) > 0)
            @foreach ($audits as $audit)
                <tr>
                    <tr>
                        <td>{{ $audit->zoho_id ?? '-' }}</td>
                        <td>{{ $audit->user->name ?? '-' }}</td>
                        <td>{{ $audit->user->campaign->name ?? '-' }}</td>
                        <td>{{ $audit->evaluationStatus ?? '-' }}</td>
                        <td>{{ $audit->comments ?? '-' }}</td>
                        <td>{{ $audit->evaluator->name ?? '-' }}</td>
                        <td>{{ $audit->created_at ?? '-'}}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-center">No record found!</td>
            </tr>
        @endif
    </tbody>
</table>