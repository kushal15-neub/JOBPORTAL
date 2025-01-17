@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <div class="card border-0 shadow">
                    <div class="card-header bg-white">
                        <h3 class="mb-0">My Job Applications</h3>
                    </div>
                    <div class="card-body">
                        @if($applications->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Job Title</th>
                                            <th>Applied Date</th>
                                            <th>Company</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($applications as $application)
                                            <tr>
                                                <td>
                                                    <a href="/jobs/{{ $application->job->id }}">
                                                        {{ $application->job->title }}
                                                    </a>
                                                </td>
                                                <td>{{ $application->created_at->format('d M, Y') }}</td>
                                                <td>{{ $application->job->company_name ?? 'N/A' }}</td>
                                                <td>
                                                    <div class="badge bg-{{ $application->status == 'approved' ? 'success' : ($application->status == 'pending' || $application->status == 'applied' ? 'warning' : 'danger') }}">
                                                        {{ ucfirst($application->status ?? 'pending') }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $applications->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <h4>You haven't applied for any jobs yet.</h4>
                                <a href="/" class="btn btn-primary mt-3">Browse Jobs</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 