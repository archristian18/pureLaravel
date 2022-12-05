@extends('layout.layout')
@section ('content')

    <div class="col-md-12= col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Settings</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="demo-form2" action="{{ route('account.create') }}" data-parsley-validate class="form-horizontal form-label-left" method="post">
                   @csrf

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">EMAIL<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="email" id="email" name="email" class="form-control" required>
                            @error('gcash')
                                <span class="text-danger">{{$message}}</span>
                            @enderror   
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">PASSWORD<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="password" id="password" name="password" class="form-control" required>
                            @error('wallet')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                  
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{  route('home.page') }}" >
                            <button class="btn btn-primary" type="button">Cancel</button>
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection