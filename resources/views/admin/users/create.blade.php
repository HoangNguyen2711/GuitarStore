@extends('admin.layouts.app')
@section('title', 'Create Users')
@section('content')

    <div class="card">
        <h1>Create User</h1>
        <div>
            <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="input-group-static col-5 mb-4">
                        <label>Image</label>
                        <input type="file" accept="image/*" name="image" id="image-input" class="form-control" />

                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-5 gallery"></div>
                </div>

                <div class="input-group input-group-static mb-4">
                    <label class="form-label">Name</label>
                    <input type="text" value="{{ old('name') }}" name="name" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label class="form-label">Email</label>
                    <input type="text" value="{{ old('email') }}" name="email" class="form-control">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label class="form-label">Phone</label>
                    <input type="text" value="{{ old('phone') }}" name="phone" class="form-control">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label class="ms-0">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="male">Male</option>
                        <option value="fe-male">FeMale</option>
                    </select>
                    @error('group')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label>Address</label>
                    <textarea name="address" class="form-control"> {{ old('address') }}</textarea>
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Roles</label>
                    <div class="row">
                        @foreach ($roles as $groupName => $role)
                            <div class="col-5">
                                {{-- <h4>{{ $groupName }}</h4> --}}

                                <div>
                                    @foreach ($role as $item)
                                        <div class="form-check">
                                            <input class="form-check-input" name="role_ids[]" type="checkbox"
                                                value="{{ $item->id }}">
                                            <label class="custom-control-label"
                                                for="customCheck1">{{ $item->display_name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <button type="submit" class="btn btn-submit btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        var fileName = input.files[i].name;
                        var fileExtension = fileName.split('.').pop().toLowerCase();
                        reader.onload = function(event) {
                            console.log(event.target.result);
                            $($.parseHTML('<img class="img-thumbnail mr-1 mb-1">')).attr('src', event.target
                                .result).appendTo(placeToInsertImagePreview);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $(document).on('change', '#image-input', function() {
                console.log(1);
                $('.gallery').empty();
                imagesPreview(this, $('.gallery'));
            });
        });
    </script>
@endsection
