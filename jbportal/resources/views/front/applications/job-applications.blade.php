@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/my-jobs"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back to My Jobs</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="card border-0 shadow">
                    <div class="card-header bg-white">
                        <h3 class="mb-0">Applications for: {{ $job->title }}</h3>
                    </div>
                    <div class="card-body">
                        @if($applications->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Applicant Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Applied Date</th>
                                            <th>Attachment</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($applications as $application)
                                            <tr>
                                                <td>{{ $application->name }}</td>
                                                <td>{{ $application->email }}</td>
                                                <td>{{ $application->phone ?? 'N/A' }}</td>
                                                <td>{{ $application->created_at->format('d M, Y') }}</td>
                                                <td>
                                                    @if($application->resume)
                                                            <a href="{{ Storage::url($application->resume) }}" 
                                                               class="btn btn-sm btn-primary" 
                                                               target="_blank">
                                                                <i class="fa fa-download"></i> Resume
                                                            </a>
                                                        @endif
                                                        @if($application->cover_letter)
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-info" 
                                                                    data-bs-toggle="modal" 
                                                                    data-bs-target="#coverLetter{{ $application->id }}">
                                                                <i class="fa fa-file-text"></i> Cover Letter
                                                            </button>
                                                        @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $application->status == 'approved' ? 'success' : ($application->status == 'rejected' ? 'danger' : 'warning') }}">
                                                        {{ ucfirst($application->status ?? 'pending') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        @if($application->status == 'pending' || $application->status == 'applied')
                                                            <form action="/job-applications/{{ $application->id }}/update-status" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" name="status" value="approved" class="btn btn-sm btn-success">
                                                                    <i class="fa fa-check"></i> Approve
                                                                </button>
                                                                <button type="submit" name="status" value="rejected" class="btn btn-sm btn-danger">
                                                                    <i class="fa fa-times"></i> Reject
                                                                </button>
                                                            </form>
                                                        @endif
                                                        
                                                    </div>
                                                </td>
                                            </tr>

                                            @if($application->cover_letter)
                                                <!-- Cover Letter Modal -->
                                                <div class="modal fade" id="coverLetter{{ $application->id }}" tabindex="-1">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Cover Letter - {{ $application->name }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! nl2br(e($application->cover_letter)) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $applications->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <h4>No applications received yet.</h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 