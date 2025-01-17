
@extends('front.layouts.app')
@section('main')

<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Register</h1>
                    <!-- Registration Form -->
                    <form id="registrationForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="mb-2">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name">
                            <div class="invalid-feedback"></div>
                        </div> 
                        <div class="mb-3">
                            <label for="email" class="mb-2">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                            <div class="invalid-feedback"></div>
                        </div> 
                        <div class="mb-3">
                            <label for="password" class="mb-2">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password">
                            <div class="invalid-feedback"></div>
                        </div> 
                        <div class="mb-3">
                            <label for="confirm_password" class="mb-2">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Rewrite Your Password">
                            <div class="invalid-feedback"></div>
                        </div> 
                        <button class="btn btn-primary mt-2">Register</button>
                    </form>                    
                </div>
                   <div class="mt-4 text-center">
                    <p>Have an account? <a href="{{ route('account.login')}}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('customjs')
<script>

$("#registrationForm").submit(function(e) {
    e.preventDefault(); 
    var $submitBtn = $("button[type='submit']");
    $submitBtn.prop("disabled", true);

    $.ajax({
        url: '{{ route("account.processRegistration") }}',
        type: 'POST',
        data: $("#registrationForm").serialize(), 


        
        success: function(response) {
            var errors = response.errors;

            $(".is-invalid").removeClass("is-invalid");
            $(".invalid-feedback").text("");

            if (response.status === false) {
                if (errors.name) {
                    $("#name").addClass('is-invalid')
                        .siblings('.invalid-feedback')
                        .text(errors.name);
                }
                if (errors.email) {
                    $("#email").addClass('is-invalid')
                        .siblings('.invalid-feedback')
                        .text(errors.email);
                }
                if (errors.password) {
                    $("#password").addClass('is-invalid')
                        .siblings('.invalid-feedback')
                        .text(errors.password);
                }
                if (errors.confirm_password) {
                    $("#confirm_password").addClass('is-invalid')
                        .siblings('.invalid-feedback')
                        .text(errors.confirm_password);
                }
            } else {
                // Success: Redirect or show a success message
                alert("Registration successful!");
                window.location.href = "{{ route('account.login') }}";
            }
        },
        error: function(xhr) {
            // Handle unexpected errors
            alert("An error occurred. Please try again.");
        },
        complete: function() {
            $submitBtn.prop("disabled", false); // Re-enable the submit button
        }
    });
});
</script>
@endsection