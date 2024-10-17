@extends('layouts.admin.admin-master')

@section('title')
View Contact
@endsection

@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header mb-3">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="container d-flex justify-content-between align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">View Contact</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.all_contact') }}">All Contacts</a>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h5>Contact Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <p>{{ $contact->name }}</p>
                            </div>

                            <div class="form-group">

                                <strong>Email:</strong>

                                <p>{{ $contact->email }}</p>
                            </div>

                            <div class="form-group">

                                <strong>Phone:</strong>
                                <p>{{ $contact->phone }}</p>
                            </div>

                            <div class="form-group">
                                <strong>Subject:</strong>
                                <p>{{ $contact->subject }}</p>
                            </div>

                            <div class="form-group">
                                <strong>Message:</strong>
                                <p>{{ $contact->message }}</p>
                            </div>


                            <div class="mt-4">
                                <a href="{{ route('admin.delete_contact', $contact->id) }}"
                                    class="btn btn-danger">Delete
                                    Contact</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
@endsection