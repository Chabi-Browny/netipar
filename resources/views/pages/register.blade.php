@extends('layout')

@section('content')
    <!-- her comes the form -->
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col space-y-8 items-center w-full max-w-md">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900 underline">{{ $title }}</h2>
            </div>
            <div class="">
                <form class="space-y-6" action="{{ route("subreg") }}" method="POST" enctype="multipart/form-data">

                    <div class=" shadow-sm">
                        <div class="flex items-center justify-between mb-2">
                            <label for="full-name" class="mr-3">Name:</label>
                            <input id="full-name" name="name" type="text" placeholder="Name" class="grow rounded-t-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="flex items-center mb-2">
                            <label for="email-address" class="mr-3">Email address:</label>
                            <input id="email-address" name="email" type="email" autocomplete="email" placeholder="Email address" required class="grow border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" >
                        </div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="phone" class="mr-3">Phone:</label>
                            <input id="phone" name="mphone" type="number" placeholder="Phonenumber: 01300253" class="grow rounded-b-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="flex items-center justify-between  mb-2">
                            <label for="profile-photo" class="mr-3">Profile Photo:</label>
                            <input id="profile-photo" name="photo" type="file" class="grow border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="ph-addresse" class="mr-3">Address:</label>
                            <input id="ph-addresse" name="address" type="text" placeholder="Address" class="relative block w-full rounded-t-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="mail-addresse" class="mr-3">Mail address:</label>
                            <input id="mail-addresse" name="mailAddress" type="text" placeholder="Mail Address" class="relative block w-full rounded-b-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="flex items-center justify-between">
                            <input id="same-addresse" name="sameAddress" type="checkbox" placeholder="Mail Address" class="relative h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="same-addresse" class="ml-3 min-w-0 flex-1">Is physical address equal with the mailing address?</label>
                        </div>
                    </div>
                    @csrf
                    <div>
                        <button type="submit" class="rounded-md bg-indigo-600 py-2 px-3
                            text-sm font-semibold text-white shadow-sm hover:bg-indigo-500
                            focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
                        >Save</button>
                    </div>
                </form>
            </div>
            <!--why???-->
            @if(!empty($regSucc))
                dump($regSucc)
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection()