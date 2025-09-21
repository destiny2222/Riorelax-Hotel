@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>
            Room Facilities List
            <small class="float-right">
                <button type="button" class="btn btn-primary btn-md"  data-target="#add0" data-toggle="modal">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Add Facility Type
                </button>
            </small>
        </h4>
    </div>
    <div id="add0" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <strong>Add Facility Type</strong>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <form action=""  method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="facility_name" class="col-sm-12">Facility Name <span class="text-danger">*</span></label>
                                            <div class="col-sm-12">
                                                <input name="" class="form-control" type="text"  placeholder="Facility Name" id="facility_name" value="" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="facility_name" class="col-sm-12">Facility Name <span class="text-danger">*</span></label>
                                            <div class="col-sm-12">
                                                <input name="" class="form-control" type="text"  placeholder="Facility Name" id="facility_name" value="" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-success w-md m-b-5">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <strong>Update</strong>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body editinfo">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!--  table area -->
        <div class="col-sm-12">
            <div class="card-body">
                <div class="table-responsive">
                    <div id="exdatatable_wrapper" class="dataTables_wrapper no-footer">
                        <table width="100%" id="exdatatable" class="datatable table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr>
                                    <th >SL </th>
                                    <th >Facility Name</th>
                                    <th > Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td >1</td>
                                    <td>Air conditioner</td>
                                    <td class="center">
                                        <a onclick="editinfo('5')" class="btn btn-info btn-sm" ><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a>
                                        <a href="" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm"><i class="ti-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection